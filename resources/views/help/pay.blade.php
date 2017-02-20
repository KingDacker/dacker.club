@extends('layout.main')
@section('content')
    <section id="content">
        <section class="vbox">
            <section class="scrollable wrapper-lg">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="blog-post">
                            <div class="post-item">
                                <div class="post-media">
                                    <img src="{{ asset ("/nose_source/img/ali_pay.jpg") }}" class="img-sm" width="30%" height="30%">
                                </div>
                                <div class="caption wrapper-lg">
                                    <h2 class="post-title"><a href="#">赞助请扫这里哟,一元不嫌少</a></h2>
                                    <div class="post-sum">
                                        <p>赞助的时候,请填写上你的注册邮箱,例如xxxx@dacker.com
                                            <br>
                                            赞助一元,可以获得一个鸡鸡币
                                            <br>
                                        </p>
                                    </div>
                                    <div class="line line-lg"></div>
                                    <div class="text-muted">
                                        <i class="fa fa-user icon-muted"></i> by <a href="#" class="m-r-sm">dacker小编</a>
                                        <i class="fa fa-clock-o icon-muted"></i> <?php echo date('Y年m月d日 H:i:s')?>
                                        {{--<a href="#" class="m-l-sm"><i class="fa fa-comment-o icon-muted"></i> 2 comments</a>--}}
                                    </div>
                                </div>
                            </div>

                            {{--<div class="post-item">--}}
                                {{--<div class="caption wrapper-lg">--}}
                                    {{--<h2 class="post-title"><a href="#">Bootstrap 3: What you need to know</a></h2>--}}
                                    {{--<div class="post-sum">--}}
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat.--}}
                                        {{--</p>--}}
                                        {{--<h3>Html5 and CSS3</h3>--}}
                                        {{--<p>--}}
                                            {{--Phasellus at ultricies neque, quis malesuada augue. Donec eleifend condimentum nisl eu consectetur. Integer eleifend, nisl venenatis consequat iaculis, lectus arcu malesuada sem, dapibus porta quam lacus eu neque.</p>--}}
                                    {{--</div>--}}
                                    {{--<div class="line line-lg"></div>--}}
                                    {{--<div class="text-muted">--}}
                                        {{--<i class="fa fa-user icon-muted"></i> by <a href="#" class="m-r-sm">Admin</a>--}}
                                        {{--<i class="fa fa-clock-o icon-muted"></i> Feb 15, 2013--}}
                                        {{--<a href="#" class="m-l-sm"><i class="fa fa-comment-o icon-muted"></i> 4 comments</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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


