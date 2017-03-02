<aside class="bg-black dk aside hidden-print" id="nav">
    <section class="vbox">
        <section class="w-f-md scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                    {{--导航中心--}}
                    <ul class="nav clearfix">
                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                            Dacker俱乐部
                        </li>
                        @foreach($menu_list['top_menu'] as $top_menu)
                        @if($top_menu['menu']['level1']==$data['checked_menu']['level1'])
                        <li class="active">
                        @else
                        <li >
                        @endif
                            <a href="{{$top_menu['url']}}">
                                <i class="{{$top_menu['image_color']}}"></i>
                                {{--今天新增数量--}}
                                {{--<b class="badge bg-primary pull-right">6</b>--}}
                                <span class="font-bold">{{$top_menu['name']}}</span>
                            </a>
                        </li>
                        @endforeach
                        <li class="m-b hidden-nav-xs"></li>
                    </ul>
                    {{--用户中心--}}
                    <ul class="nav " data-ride="collapse">
                        <li
                                @if('网站公告'==$data['checked_menu']['level1'])
                                class="active"
                                @endif
                        >
                            <a href="{{url('announcement')}}">
                                <i class="fa-calendar fa"></i>
                                <span>网站公告</span>
                            </a>
                        </li>
                        @foreach($menu_list['user_menu'] as $user_menu)
                        @if(session('user'))
                        <li
                            @if($user_menu['menu']['level1']==$data['checked_menu']['level1'])
                            class="active"
                            @endif
                        >
                                @if($user_menu['list'])
                                <a href="#" class="auto">
                                    <span class="pull-right text-muted"><i class="fa fa-angle-left text"></i><i class="fa fa-angle-down text-active"></i></span>
                                    <i class="{{$user_menu['image_color']}}"></i>
                                    <span>{{$user_menu['name']}}</span>
                                </a>
                                <ul class="nav dk text-sm">
                                @foreach($user_menu['list'] as $value)
                                    <li
                                    @if($value['menu']['level2']==$data['checked_menu']['level2'])
                                   class="active"
                                    @endif
                                    >
                                        <a href="{{$value['url']}}" class="auto">
                                            <i class="fa fa-angle-right text-xs"></i>
                                            <span>{{$value['name']}}</span>
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                                @else
                                <a href="{{$user_menu['url']}}">
                                    <i class="{{$user_menu['image_color']}}"></i>
                                    <span>{{$user_menu['name']}}</span>
                                </a>
                                @endif
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    {{--固定链接--}}
                    <ul class="nav text-sm">
                        <li
                            @if('常见问题'==$data['checked_menu']['level1'])
                            class="active"
                            @endif
                        >
                            <a href="{{url('help')}}">
                                <i class="icon-question icon"></i>
                                <span>常见问题</span>
                            </a>
                        </li>
                        <li
                            @if('欢迎赞助'==$data['checked_menu']['level1'])
                            class="active"
                            @endif
                        >
                            <a href="{{url('sponsor')}}">
                                <i class="fa-bug fa"></i>
                                <span>欢迎赞助</span>
                            </a>
                        </li>

                    </ul>
                    {{--固定链接结束--}}
                </nav>
                <!-- / nav -->
            </div>
        </section>

        <footer class="footer hidden-xs no-padder text-center-nav-xs">
            <div class="bg hidden-xs ">
                @if(session('user'))
                    <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="thumb-sm avatar pull-left m-l-xs">
                            <img src="{{session('user')['avatar_str']}}" class="dker" alt="...">
                            <i class="on b-black"></i>
                        </span>
                        <span class="hidden-nav-xs clear">
                            <span class="block m-l">
                            <strong class="font-bold text-lt">{{session('user')['nick_name']}}</strong>
                            <b class="caret"></b>
                            </span>
                            <span class="text-muted text-xs block m-l">{{session('user')['user_type_str']}}--{{session('user')['user_info']['identity_str']}}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">
                        <li>
                            <a href="#">
                                 {{--<span class="arrow bottom hidden-nav-xs"></span>--}}
                                <span class="pull-right ">{{  session('user')['name_id'] }}</span>
                                ID
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="  pull-right">{{$point}}</span>
                                鸡鸡币
                            </a>
                        </li>
                        <li>
                            <a href="{{url('user/news/chat/list')}}">
                                <span class="badge bg-danger pull-right">{{$unread_num}}</span>
                                未读消息
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{url('login/logout')}}"  >登出</a>
                        </li>
                    </ul>
                </div>
                @else
                    <div class="dropdown dropup wrapper-sm clearfix">
                        <a href="{{url('login/signin')}}" >
                            <span class="thumb-sm avatar pull-left m-l-xs">
                                <img src="{{asset('nose_source/img/avatar.png')}}" class="dker" alt="...">
                            </span>
                            <span class="hidden-nav-xs clear">
                            <span class="block m-l">
                                <strong class="font-bold text-lt">请先登录</strong>
                            </span>
                            <span class="text-muted text-xs block m-l">没有账号,请点击注册</span>
                            </span>
                        </a>
                    </div>
                @endif
            </div>
        </footer>
    </section>
</aside>