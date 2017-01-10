@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable wrapper-lg">
            <div class="row">
                <div class="col-sm-9">
                    <div class="blog-post">
                        <div class="post-item">
                            <br>
                            <div class="post-media">
                                <img style="width:25%;height:25%" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">
                            </div>
                            {{--<div class="post-left" style="margin-left:10px; ">--}}
                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                                {{--<img style="width:24%;" src="{{asset('/nose_source/img/test.jpg')}}" class="img-full">--}}

                            {{--</div>--}}

                            <br>


                        </div>
                        <div class="post-item">
                            <div class="caption wrapper-lg">
                                <h3 class="post-title">{{$data['post']['title']}}</h3>
                                <div class="post-sum">
                                    <p>{{$data['post']['content']}}</p>
                                </div>
                                <div class="line line-lg"></div>
                                <div class="text-muted">
                                    <i class="fa fa-user icon-muted"></i> by
                                    <a href="{{url('user/info/'.$data['user']['id'])}}" class="m-r-sm">{{$data['user']['nick_name']}}</a>
                                    <i class="fa fa-clock-o icon-muted"></i> {{$data['post']['created_at']}}
                                    <a href="#" class="m-l-sm"><i class="fa fa-comment-o icon-muted"></i> 4 comments</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="m-t-lg m-b">3 Comments</h4>
                    <section class="comment-list block">
                        @foreach($data['comments'] as $comment)
                        <!-- comment -->
                        <article id="comment-id-1" class="comment-item">
                            <a class="pull-left thumb-sm avatar"><img src="{{$comment['avatar_str']}}" class="img-circle"></a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                                <header class="panel-heading bg-white">
                                    <label class="label bg-info m-l-xs">身份</label>
                                    <a href="#">{{$comment['nick_name']}}</a>
                                    <span class="text-muted m-l-sm pull-right"><i class="fa fa-clock-o"></i>{{$comment['created_at']}}</span>
                                </header>
                                <div class="panel-body">
                                    <div>{{$comment['content']}}</div>
                                    <div class="comment-action m-t-sm">
                                        <a href="#" data-toggle="class" class="btn btn-default btn-xs active">
                                            <i class="fa fa-star-o text-muted text-active"></i>
                                            <i class="fa fa-star text-danger text"></i>
                                            155
                                        </a>
                                        <a href="#" class="btn btn-default btn-xs">
                                            <i class="fa fa-mail-reply text-muted"></i> 回复
                                        </a>
                                    </div>
                                    <br>
                                    <form id="reply_form" action="" class="m-b-none">
                                        <div class="input-group">
                                            <input type="text" id="reply_form" name="reply_form" class="form-control" placeholder="Input your comment here">
                                        <span class="input-group-btn">
                                          <button class="btn btn-primary" type="button">回复</button>
                                        </span>
                                        </div>
                                    </form>
                            </section>
                            <section class="media-body">

                            </section>
                        </article>
                            @if($comment['reply'])
                            @foreach($comment['reply'] as $reply_comment)
                            <!-- comment-reply -->
                            <article id="comment-id-2" class="comment-item comment-reply">
                                <a class="pull-left thumb-sm avatar"><img src="{{$reply_comment['avatar_str']}}" class="img-circle"></a>
                                <span class="arrow left"></span>
                                <section class="comment-body panel panel-default">
                                    <header class="panel-heading bg-white">
                                        <label class="label bg-info m-l-xs">身份</label>
                                        <a href="#">{{$reply_comment['nick_name']}} 回复 {{$reply_comment['to_nick_name']}} : </a>
                                        <span class="text-muted m-l-sm pull-right"><i class="fa fa-clock-o"></i>{{$reply_comment['created_at']}}</span>
                                    </header>
                                    <div class="panel-body">
                                        <div>{{$reply_comment['content']}}</div>
                                        <div class="comment-action m-t-sm">
                                            <a href="#" class="btn btn-default btn-xs"><i class="fa fa-mail-reply text-muted"></i> 回复</a>
                                        </div>
                                    </div>
                                </section>
                            </article>
                            @endforeach
                            @endif
                        @endforeach

                    </section>

                    <h4 class="m-t-lg m-b">发表回复</h4>
                    <form>
                        <div class="form-group">
                            <label></label>
                            <textarea class="form-control" rows="5" placeholder="Type your comment"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit comment</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-3">
                    <h5 class="font-bold">Categories</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="#">
                                <span class="badge pull-right">15</span>
                                Photograph
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <span class="badge pull-right">30</span>
                                Life style
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <span class="badge pull-right">9</span>
                                Food
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <span class="badge pull-right">4</span>
                                Travel world
                            </a>
                        </li>
                    </ul>
                    <div class="tags m-b-lg l-h-2x">
                        <a href="#" class="label bg-primary">Bootstrap</a> <a href="#" class="label bg-primary">Application</a> <a href="#" class="label bg-primary">Apple</a> <a href="#" class="label bg-primary">Less</a> <a href="#" class="label bg-primary">Theme</a> <a href="#" class="label bg-primary">Wordpress</a>
                    </div>
                    <h5 class="font-bold">Recent Posts</h5>
                    <div>
                        <article class="media">
                            <a class="pull-left thumb thumb-wrapper m-t-xs">
                                <img src="images/m1.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#" class="font-semibold">Bootstrap 3: What you need to know</a>
                                <div class="text-xs block m-t-xs"><a href="#">Travel</a> 2 minutes ago</div>
                            </div>
                        </article>
                        <div class="line"></div>
                        <article class="media m-t-none">
                            <a class="pull-left thumb thumb-wrapper m-t-xs">
                                <img src="images/m2.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#" class="font-semibold">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                <div class="text-xs block m-t-xs"><a href="#">Design</a> 2 hours ago</div>
                            </div>
                        </article>
                        <div class="line"></div>
                        <article class="media m-t-none">
                            <a class="pull-left thumb thumb-wrapper m-t-xs">
                                <img src="images/m3.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#" class="font-semibold">Sed diam nonummy nibh euismod tincidunt ut laoreet</a>
                                <div class="text-xs block m-t-xs"><a href="#">MFC</a> 1 week ago</div>
                            </div>
                        </article>
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
    //提交表单(每次提交搜索前,重置page)
    function postForm(){
        var status =  $('#status').val();
        window.location.href = '/user/post/list?status='+status;
    }
</script>
@stop


