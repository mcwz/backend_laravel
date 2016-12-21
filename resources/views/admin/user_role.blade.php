@extends('layouts.admin_template')

@section('content')
   <!--list row begin-->
    <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.user_role')</h3>
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
                      <p>@lang('sys.userinfo')</p>
                      <small>{{$user->name}} ● {{$user->email}} </small>
                    </blockquote>
                  </div>
              </div>
                <div class="form-group">
                @foreach ($roles as $role)
                  <div class="checkbox">
                    <label>
                      <input @if(in_array($role->id,$userRole)) checked="checked" @endif name="role[]" value="{{$role->id}}" type="checkbox">
                      {{$role->display_name}}
                    </label>
                  </div>
                @endforeach   

                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('admin/users')}}" class="btn btn-default">@lang('sys.cancel')</a>
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