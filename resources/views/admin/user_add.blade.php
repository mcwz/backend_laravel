@extends('layouts.admin_template')

@section('content')
<link href="{{ asset('bower_components/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
   <!--list row begin-->
    <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">@lang('sys.user_add')</h3>
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
            <form id="newuserform" class="form-horizontal" method="post">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="user_name" class="col-sm-2 control-label">@lang('sys.user_name')</label>
                  <div class="col-sm-8">
                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="username" value="{{ old('user_name') }}" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_email" class="col-sm-2 control-label">@lang('sys.user_email')</label>
                  <div class="col-sm-8">
                    <input type="email" name="user_email" class="form-control" id="user_email" placeholder="abc@def.com" value="{{ old('user_email') }}" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_pass" class="col-sm-2 control-label">@lang('sys.password')</label>
                  <div class="col-sm-8">
                    <input type="text" name="user_pass" class="form-control" id="user_pass" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="avatar" class="col-sm-2 control-label">@lang('sys.user_avatar')</label>
                  <div class="col-sm-8">
                    <input name="avatar" id="avatar" type="file" data-preview-file-type="text" >
                    <input name="avatar_real" id="avatar_real" type="hidden" value="" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_description" class="col-sm-2 control-label">@lang('sys.user_description')</label>
                  <div class="col-sm-8">
                    <input type="text" name="user_description" class="form-control" id="user_description" placeholder="@lang('sys.user_description_info')">
                  </div>
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
      <script src="{{ asset('bower_components/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
      <script src="{{ asset('bower_components/bootstrap-fileinput/js/locales/zh.js')}}"></script>
      <script>
      $(function(){
        //$("#avatar").fileinput({'showUpload':false,'showPreview':false, 'previewFileType':'any','showUpload':false});
        var btnCust = ''; 
        $("#avatar").fileinput({
          language:'zh',
              overwriteInitial: true,
              maxFileSize: 1500,
              showClose: false,
              showCaption: false,
              browseLabel: '',
              removeLabel: '',
              browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
              removeTitle: 'Cancel or reset changes',
              elErrorContainer: '#kv-avatar-errors-1',
              msgErrorClass: 'alert alert-block alert-danger',
              defaultPreviewContent: '<img src="{{ asset('bower_components/AdminLTE/dist/img/avatar5.png')}}" alt="Your Avatar" style="width:160px">',
              layoutTemplates: {main2: '{preview}'+  btnCust + '{upload} {remove} {browse}'},
              allowedFileExtensions: ["jpg", "png", "gif"],
              uploadAsync: true,
              uploadUrl: "{{url('admin/avatarUpload')}}",
              ajaxSettings:{
                headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              }
          });
        $('#avatar').on('fileimagesloaded', function(event) {
            $("#avatar_real").val("");
        });
        $('#avatar').on('fileuploaded', function(event, data, previewId, index) {
              var save_path=data.response.save_path;
              if(save_path){
                console.info("save:"+save_path);
                $("#avatar_real").val(save_path);
              }
          });
        $("#newuserform").on('submit',function(){
            if($("#avatar_real").val()=="")
            {
              alert("请先完成用户头像上传！");
              return false;
            }
            else
            return true;
          });
      });


      </script>
@endsection