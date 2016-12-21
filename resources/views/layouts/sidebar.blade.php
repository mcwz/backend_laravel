<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('admin/user/showuseravatar/'.Auth::user()->id)}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">&nbsp;</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview"><a href="javascript:;"><span>@lang('sys.sys_setup')</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/permissions') }}">@lang('sys.permission_list')</a></li>
                    <li><a href="{{ url('/admin/roles') }}">@lang('sys.role_list')</a></li>
                    <li><a href="{{ url('/admin/users') }}">@lang('sys.user_list')</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="javascript:;"><span>个人设置</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/profile') }}">个人信息设置</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>