@extends('layouts.admin_template')

@section('content')
    <div class='row'>
    <div class="col-xs-12">
          <div class="box">
          <div class="box-header">
              <h3 class="box-title">@lang('sys.role_new')</h3>
            </div>
    <div class="box-body no-padding">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form class="form-horizontal" role="form" method="post">
    {{ csrf_field() }}
    @if(isset($role))
    <input type="hidden" name="role_id" value="{{$role->id}}" />
    @endif
                    <fieldset>
                       <div class="form-group">
                          <label class="col-sm-1 control-label" for="role_name">@lang('sys.role_name')</label>

                          <div class="col-sm-2">
                          @if(isset($role))
                            <input class="form-control" name="role_name" id="role_name" type="text" placeholder="admin" value="{{ $role->name }}" />
                          @else
                             <input class="form-control" name="role_name" id="role_name" type="text" placeholder="admin" value="{{ old('role_name') }}" />
                          @endif
                          </div>
                          <label class="col-sm-1 control-label" for="role_displayname">@lang('sys.role_displayname')</label>
                          <div class="col-sm-2">
                          @if(isset($role))
                            <input class="form-control" name="role_displayname" id="role_displayname" type="text" placeholder="admin" value="{{ $role->display_name }}" />
                          @else
                             <input class="form-control" id="role_displayname" name="role_displayname" type="text" placeholder="管理员" value="{{ old('role_displayname') }}" />
                          @endif
                          </div>

                          <label class="col-sm-1 control-label"  for="role_description">@lang('sys.role_description')</label>
                          <div class="col-sm-3">
                          @if(isset($role))
                            <input class="form-control" name="role_description" id="role_description" type="text" placeholder="admin" value="{{ $role->description }}" />
                          @else
                             <input class="form-control" name="role_description" id="role_description" type="text" placeholder="@lang('sys.role_description_example')" value="{{ old('role_description') }}" />
                          @endif
                          </div>
                          <div class="col-sm-2">
                          <button type="submit" class="btn btn-default">@lang('sys.save')</button>
                          </div>
                       </div>
                    </fieldset>     
        

                </form>
    </div></div></div></div><!-- /.row -->

    <!--list row begin-->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.role_list')</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @if($value = session('operation_success'))
              <div class="callout callout-success closeable">
                <p>{{$value}}</p>
              </div>
              @endif

              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>ID</th>
                  <th>@lang('sys.role_name')</th>
                  <th>@lang('sys.role_displayname')</th>
                  <th>@lang('sys.role_description')</th>
                  <th>@lang('sys.action')</th>
                </tr>
@foreach ($roles as $role)
                <tr>
                  <td>{{ $role->id }}</td>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->display_name }}</td>
                  <td>{{ $role->description }}</td>
                  <td><a class="btn btn-default btn-flat" href="{{ url('/admin/role/permission/'.$role->id) }}">@lang('sys.role_add_permission')</a> <a  class="btn btn-default btn-flat" href="{{ url('/admin/role/del/'.$role->id) }}">@lang('sys.delete')</a> <a  class="btn btn-default btn-flat" href="{{ url('/admin/roles/'.$role->id) }}">@lang('sys.update')</a></td>
                </tr>
@endforeach                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection