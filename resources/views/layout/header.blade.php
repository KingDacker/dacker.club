<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
    <div class="navbar-header aside bg-info dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
            <i class="icon-list"></i>
        </a>
        <a href="/" class="navbar-brand text-lt">
            <i class="icon-present"></i>
            <img src="{{asset('nose_source/images/logo.png')}}" alt="." class="hide">
            <span class="hidden-nav-xs m-l-sm">Dacker</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
            <i class="icon-settings"></i>
        </a>
    </div>
    <ul class="nav navbar-nav hidden-xs">
        <li>
            <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
                <i class="fa fa-indent text"></i>
                <i class="fa fa-dedent text-active"></i>
            </a>
        </li>
    </ul>
    <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
                <input type="text" class="form-control input-sm no-border rounded"
                       placeholder="搜索">
            </div>
        </div>
    </form>
    <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
            {{--登录后--}}
            @if(session('user'))
                <li class="hidden-xs">
                    <a class="dropdown-toggle lt" data-toggle="dropdown">
                        <b>ID:{{  session('user')['name_id'] }}</b>
                    </a>
                </li>
                <li class="dropdown" style="margin-right: 10px">
                    <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown" style="margin-right: 10px">
                        <i class="fa-user fa"> {{  session('user')['nick_name'] }}</i><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <li>
                            <span class="arrow top"></span>
                            <a href="{{url('login/logout')}}">登出</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <span class="badge bg-danger pull-right">3</span>
                                未读消息
                            </a>
                        </li>
                        <li>
                            <a href="#">常见问题</a>
                        </li>
                    </ul>
                </li>
            {{--未登录--}}
            @else
                <li class="dropdown" style="margin-right: 10px">
                    <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown" style="margin-right: 10px">
                        <i class="fa-user fa"> 游客 </i><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <li>
                            <span class="arrow top"></span>
                            <a href="{{url('login/signin')}}">登录</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{url('login/signup')}}">注册</a>
                        </li>
                    </ul>
                </li>
                <li class="hidden-xs">
                    <a href="{{url('login/signin')}}" class="dropdown-toggle lt">
                        <span>登录</span>
                    </a>
                </li>
                <li class="hidden-xs" style="margin-right: 10px">
                    <a href="{{url('login/signup')}}" class="dropdown-toggle lt" style="margin-right: 10px">
                        <span>注册</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</header>