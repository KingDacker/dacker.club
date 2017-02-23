<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/nose_source/img/avatar.png") }}" class="img-circle" alt="User Image"/>
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
            <li><a href="{{url('/admin/post')}}"><i class="fa fa-edit"></i> <span>投稿管理</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>用户管理</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('/admin/user')}}"><i class="fa fa-circle-o"></i> 检索用户</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> 个人资料</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> 收货地址</a></li>
                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-money"></i> <span>用户财务</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" >
                    <li class=""><a href="{{url('/admin/user')}}"><i class="fa fa-circle-o"></i> 检索用户</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> 支出记录</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> 收入记录</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>订单管理</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu" >
                    <li class="active"><a href="{{url('/admin/order/lists')}}"><i class="fa fa-circle-o"></i> 检索订单</a></li>

                </ul>
            </li>


            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
</aside>