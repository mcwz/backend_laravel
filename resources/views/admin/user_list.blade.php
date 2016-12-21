@extends('layouts.admin_template')

@section('content')
<div class='row'>
    <div class="col-xs-12">
          <div class="box">
          <div class="box-header">
              <h3 class="box-title">@lang('sys.action')</h3>
            </div>
    <div class="box-body">
<a href="{{url('admin/users/add')}}" class="btn btn-default btn-flat">@lang('sys.user_add')</a>
    </div></div></div>
</div><!-- /.row -->


   <!--list row begin-->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.user_list')</h3>

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
                  <th>@lang('sys.user_name')</th>
                  <th>@lang('sys.user_email')</th>
                  <th>@lang('sys.created_at')</th>
                  <th>@lang('sys.updated_at')</th>
                  <th>@lang('sys.action')</th>
                </tr>
@foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>{{ $user->updated_at }}</td>
                  <td><a  class="btn btn-default btn-flat"  href="{{ url('/admin/user/role/'.$user->id) }}">@lang('sys.role')</a> <a  class="btn btn-default btn-flat"  href="{{ url('/admin/user/update/'.$user->id) }}">@lang('sys.update')</a></td>
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