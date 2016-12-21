@extends('layouts.admin_template')

@section('content')
    <div class="example-modal">
        <div class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">没有权限</h4>
              </div>
              <div class="modal-body">
                <p>您没有操作此模块的权限。</p>
              </div>
              <div class="modal-footer">
                
                <a href="{{url('admin/index')}}" class="btn btn-primary">确定</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
@endsection