@extends('layouts.admin_template')

@section('content')
   <!--list row begin-->
    <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.role_add_permission')</h3>
            </div>
            <!-- /.box-header -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form role="form" method="post">
            {{ csrf_field() }}
              <div class="box-body">
              <div class="row">
                  <div class="col-xs-12">
                    <blockquote>
                      <p>@lang('sys.role_info'):{{$role->name}}-{{$role->display_name}}</p>
                      <small>{{$role->description}} </small>
                    </blockquote>
                  </div>
              </div>
                <div class="form-group">
                @foreach ($permissions as $permission)
                  <div class="checkbox">
                    <label>
                      <input @if(in_array($permission->id,$rolePermission)) checked="checked" @endif name="permission[]" value="{{$permission->id}}" type="checkbox">
                      {{$permission->display_name}}
                    </label>
                  </div>
                @endforeach   

                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('admin/roles')}}" class="btn btn-default">@lang('sys.cancel')</a>
                <button type="submit" class="btn btn-info pull-right">@lang('sys.save')</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
@endsection