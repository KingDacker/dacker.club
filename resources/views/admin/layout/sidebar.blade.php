<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/assets/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="header">菜单栏目</li>
            <li><a href="{{url('/admin/password')}}"><i class="fa fa-share"></i> <span>修改密码</span></a></li>
            <li><a href="{{url('/admin/post')}}"><i class="fa fa-edit"></i> <span>帖子管理</span></a></li>
            <li><a href="{{url('/admin/user')}}"><i class="fa fa-user"></i> <span>用户管理</span></a></li>
            <li><a href="{{url('/admin/user')}}"><i class="fa fa-user"></i> <span>用户管理</span></a></li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>用户管理</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                    <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> 检索用户</a></li>
                    <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> 个人资料</a></li>
                    <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> 收货地址</a></li>

                </ul>
            </li>

            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
</aside>