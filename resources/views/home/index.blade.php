@extends('layout.main')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable padder-lg w-f-md" id="bjax-target">
                    <a href="#" class="pull-right text-muted m-t-lg" data-toggle="class:fa-spin" ><i class="icon-refresh i-lg  inline" id="refresh"></i></a>
                    <h2 class="font-thin m-b">Dacker 俱乐部
                        <span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
                        <span class="bar1 a1 bg-primary lter"></span>
                        <span class="bar2 a2 bg-info lt"></span>
                        <span class="bar3 a3 bg-success"></span>
                        <span class="bar4 a4 bg-warning dk"></span>
                        <span class="bar5 a5 bg-danger dker"></span>
                        </span>
                    </h2>
                    @include('message.success')
                    {{--推荐首页大图--}}
                    <div class="row row-sm">
                        @foreach($data['list'] as $key=>$value)
                        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                            <div class="item">
                                <div class="pos-rlt" onclick="">
                                    <div class="item-overlay opacity r r-2x ">
                                        <div class="center text-center m-t-n">
                                            <a href="{{url('user/post/detail/'.$value['post_id'])}}"><i class="icon-arrow-right i-2x"></i></a>
                                        </div>
                                    </div>
                                    <div class="top">
                                        <span class="pull-right m-t-n-xs m-r-sm text-white">
                                          <i class="fa fa-bookmark i-lg"></i>
                                        </span>
                                    </div>
                                    <a ><img src="{{$value['post_image']}}" alt="" class="r r-2x img-full" width="125" height="240"></a>
                                </div>
                                <div class="padder-v">
                                    <a href="{{url('user/post/detail/'.$value['id'])}}" class="text-ellipsis">{{$value['post_title']}}</a>
                                    <a href="{{url('user/info/id/'.$value['user_id'])}}" class="text-ellipsis text-xs text-muted">{{$value['nick_name']}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{--最热 最新 最好--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4">--}}
                            {{--<h3 class="font-thin">最 热</h3>--}}
                            {{--<div class="list-group bg-white list-group-lg no-bg auto">--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">1</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">2</span>--}}
                                    {{--<span class="pull-left thumb-sm  m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test2.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">3</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">4</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">5</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<h3 class="font-thin">最 新</h3>--}}
                            {{--<div class="list-group bg-white list-group-lg no-bg auto">--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">1</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">2</span>--}}
                                    {{--<span class="pull-left thumb-sm  m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test2.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">3</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">4</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">5</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4">--}}
                            {{--<h3 class="font-thin">最 好</h3>--}}
                            {{--<div class="list-group bg-white list-group-lg no-bg auto">--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">1</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">2</span>--}}
                                    {{--<span class="pull-left thumb-sm  m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test2.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">3</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">4</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="list-group-item clearfix">--}}
                                    {{--<span class="pull-right h2 text-muted m-l">5</span>--}}
                                    {{--<span class="pull-left thumb-sm m-r">--}}
                                    {{--<img src="{{ asset ("/nose_source/images/test.jpg") }}" alt="...">--}}
                                    {{--</span>--}}
                                    {{--<span class="clear">--}}
                                    {{--<span>Little Town</span>--}}
                                    {{--<small class="text-muted clear text-ellipsis">by Chris Fox</small>--}}
                                    {{--</span>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row m-t-lg m-b-lg">
                        <div class="col-sm-6">
                            <div class="bg-primary wrapper-md r">
                                <a href="{{url('login/signin')}}">
                                    <span class="h4 m-b-xs block"><i class=" icon-user-follow i-lg"></i> 登录或者创建账号</span>
                                    <span class="text-muted">嘿,没有账号的你赶紧去创建吧!</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-black wrapper-md r">
                                <a href="{{url('login/signin')}}">
                                    <span class="h4 m-b-xs block"><i class="icon-cloud-download i-lg"></i> 下载我的App</span>
                                    <span class="text-muted">App我还没有做啊,哎呀好懒得,先用网站凑合看吧.</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                @include('layout.footer')
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html">lyc</a>
</section>

@stop
@section('script')
    <script type="text/javascript">

    </script>
@stop