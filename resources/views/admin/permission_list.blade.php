@extends('layouts.admin_template')

@section('content')
    <div class='row'>
    <div class="col-xs-12">
          <div class="box">
          <div class="box-header">
              <h3 class="box-title">@lang('sys.permission_new')</h3>
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
    @if(isset($permission))
      <input type="hidden" name="permission_id" value="{{$permission->id}}" />
    @endif
                    <fieldset>
                       <div class="form-group">
                          <label class="col-sm-1 control-label" for="permission_name">@lang('sys.permission_name')</label>
                          <div class="col-sm-2">
                          @if(isset($permission))
                            <input class="form-control" name="permission_name" id="permission_name" type="text" placeholder="permission_list" value="{{ $permission->name }}" />
                          @else
                             <input class="form-control" name="permission_name" id="permission_name" type="text" placeholder="permission_list" value="{{ old('permission_name') }}" />
                          @endif
                          </div>
                          <label class="col-sm-1 control-label" for="permission_displayname">@lang('sys.permission_displayname')</label>
                          <div class="col-sm-2">
                          @if(isset($permission))
                            <input class="form-control" name="permission_displayname" id="permission_displayname" type="text" placeholder="permission_list" value="{{ $permission->display_name }}" />
                          @else
                             <input class="form-control" id="permission_displayname" name="permission_displayname" type="text" placeholder="permission list" value="{{ old('permission_displayname') }}" />
                          @endif
                          </div>

                          <label class="col-sm-1 control-label"  for="permission_description">@lang('sys.permission_description')</label>
                          <div class="col-sm-3">
                          @if(isset($permission))
                            <input class="form-control" name="permission_description" id="permission_description" type="text" placeholder="permission_list" value="{{ $permission->description }}" />
                          @else
                             <input class="form-control" name="permission_description" id="permission_description" type="text" placeholder="@lang('sys.permission_description_example')" value="{{ old('permission_description') }}" />
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
              <h3 class="box-title">@lang('sys.permission_list')</h3>

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
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>ID</th>
                  <th>@lang('sys.permission_name')</th>
                  <th>@lang('sys.permission_displayname')</th>
                  <th>@lang('sys.permission_description')</th>
                  <th>@lang('sys.action')</th>
                </tr>
@foreach ($permissions as $permission)
                <tr>
                  <td>{{ $permission->id }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->display_name }}</td>
                  <td>{{ $permission->description }}</td>
                  <td><a class="btn btn-default btn-flat" href="{{url('admin/permissions/'.$permission->id)}}">@lang('sys.update')</a></td>
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