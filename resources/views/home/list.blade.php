@extends('layout.main')
@section('content')
<section id="content">
        <section class="hbox stretch">
            <section>
                <section class="vbox">
                    <section class="scrollable padder-lg" >
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
                                        <div class="pos-rlt">
                                            <div class="item-overlay opacity r r-2x ">
                                                <div class="center text-center m-t-n">
                                                    <a href="{{url('post/detail/'.$value['id'])}}"><i class="icon-arrow-right i-2x"></i></a>
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
                                            <a href="{{url('post/detail/'.$value['id'])}}" class="text-ellipsis">{{$value['title']}}</a>
                                            <a href="{{url('user/info/id/'.$value['user_id'])}}" class="text-ellipsis text-xs text-muted">{{$value['nick_name']}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{--分页--}}
                        {{ $data['list']->links() }}
                    </section>
                    {{--@include('layout.footer')--}}
                </section>
            </section>
        </section>
        {{--<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html">lyc</a>--}}
    </section>
@stop
@section('script')
    <script type="text/javascript">

    </script>
@stop