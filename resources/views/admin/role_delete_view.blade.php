@extends('layouts.admin_template')

@section('content')
    <div class='row'>
    <div class="col-xs-8">
          <div class="box">
          <div class="box-header">
              <h3 class="box-title">@lang('sys.role_detail')</h3>
            </div>
    <div class="box-body no-padding">
    
    <table class="table table-hover">
                <tbody>
                <tr>
                  <th>@lang('sys.role_name')</th>
                  <td>{{$role->name}}</td>
                </tr> 
                <tr>
                  <th>@lang('sys.role_displayname')</th>
                  <td>{{$role->display_name}}</td>
                </tr> 
                <tr>
                  <th>@lang('sys.role_description')</th>
                  <td>{{$role->description}}</td>
                </tr> 
                <tr>
                  <th>@lang('sys.created_at')</th>
                  <td>{{$role->created_at}}</td>
                </tr> 
                <tr>
                  <th>@lang('sys.updated_at')</th>
                  <td>{{$role->updated_at}}</td>
                </tr> 
                <tr>
                  <th>@lang('sys.role_permissions_count')</th>
                  <td>{{count($role_permissions)}}</td>
                </tr>
                <tr>
                  <th>@lang('sys.role_users_count')</th>
                  <td>{{count($role_users)}}</td>
                </tr>              
              </tbody></table>
    </div>
    <div class="box-footer">
    <form class="form-horizontal" role="form" method="post">
    {{ csrf_field() }}
        <input type="hidden" name="role_delete_id" value="{{$role->id}}">
        <button type="submit" onclick="return confirm('@lang('sys.role_delete_confirm')')" class="btn btn-primary">@lang('sys.delete')</button>
    </form>
    </div>
    </div>
    </div>
    </div><!-- /.row -->



       <!--list row begin-->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.role_users')</h3><small>@lang('sys.role_user_delete_info')</small>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>ID</th>
                  <th>@lang('sys.user_name')</th>
                  <th>@lang('sys.user_email')</th>
                  <th>@lang('sys.user_description')</th>
                </tr>
@foreach ($role_users as $role_user)
                <tr>
                  <td>{{ $role_user->id }}</td>
                  <td>{{ $role_user->name }}</td>
                  <td>{{ $role_user->email }}</td>
                  <td>{{ $role_user->description }}</td>
                </tr>
@endforeach                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    <!--list row begin-->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.role_permissions')</h3>
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
                </tr>
@foreach ($role_permissions as $role_permission)
                <tr>
                  <td>{{ $role_permission->id }}</td>
                  <td>{{ $role_permission->name }}</td>
                  <td>{{ $role_permission->display_name }}</td>
                  <td>{{ $role_permission->description }}</td>
                </tr>
@endforeach                
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->
        </div>
      </div>


@endsection