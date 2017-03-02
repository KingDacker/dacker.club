@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable wrapper-lg">
            <div class="m-b-md">
                <h3 class="m-b-none">系统消息</h3>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="blog-post">
                        @foreach($data['list'] as $key=>$value)
                        <div class="post-item">
                            {{--<div class="post-media">--}}
                                {{--<img src="images/m42.jpg" class="img-full">--}}
                            {{--</div>--}}
                            <div class="caption wrapper-lg">
                                {{--<h3 class="post-title"><a href="#">标题</a></h3>--}}
                                <div class="post-sum">
                                    <p>{!! $value['content'] !!}</p>
                                </div>
                                <div class="line line-lg"></div>
                                <div class="text-muted">
                                    <i class="fa fa-user icon-muted"></i> 发布者 <a href="#" class="m-r-sm">站长</a>
                                    <i class="fa fa-clock-o icon-muted"></i> {{$value['created_at']}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>


@stop
@section('script')
<script>

</script>
@stop


