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
                                    <i class="fa fa-user icon-muted"></i> By <a href="{{url('user/info/id/'.$data['user']['id'])}}" class="m-r-sm text-info" >{{$data['user']['nick_name']}}</a>
                                    <i class="fa fa-clock-o icon-muted"></i> {{$data['post']['created_at']}}
                                    {{--<a href="#" class="m-l-sm"><i class="fa fa-comment-o icon-muted"></i> 4 comments</a>--}}
                                    <a onclick="like()" data-toggle="class" class="m-l-sm active">
                                        @if($data['post']['like_status'])
                                            <i class="fa fa-star-o text-muted text"></i>
                                            <i class="fa fa-star text-danger text-active"></i>
                                        @else
                                            <i class="fa fa-star-o text-muted text-active"></i>
                                            <i class="fa fa-star text-danger text"></i>
                                        @endif
                                        <label id="like_num">{{$data['post']['like_num']}}</label> <label class="text-danger">喜欢请点我哟</label>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>


                    <section class="comment-list block">
                        @foreach($data['comments'] as $comment)
                        <!-- comment -->
                        <article id="comment-id-1" class="comment-item">
                            <a class="pull-left thumb-sm avatar"><img src="{{$comment['avatar_str']}}" class="img-circle"></a>
                            <span class="arrow left"></span>
                            <section class="comment-body panel panel-default">
                                <header class="panel-heading bg-white">
                                    <a href="#">{{$comment['nick_name']}}</a>
                                    <label class="label bg-info m-l-sm pull-right">{{$comment['user_type_str']}}</label>
                                    <label class="label bg-info m-l-sm pull-right">{{$comment['identity_str']}}</label>
                                </header>
                                <div class="panel-body">
                                    <div>{{$comment['content']}}</div>
                                    <div class="comment-action m-t-sm">
                                        <a  onclick="showComment({{$comment['id']}})" class="btn btn-default btn-xs">
                                            <i class="fa fa-mail-reply text-muted"></i> 回复
                                        </a>
                                        <span class="text-muted m-l-sm pull-right"><i class="fa fa-clock-o"></i>{{$comment['created_at']}}</span>
                                    </div>

                                    <form id="reply_form_{{$comment['id']}}" action="" class="m-b-none" style="display: none">
                                        <br>
                                        <div class="input-group">
                                            <input type="hidden" id="reply_nick_name_{{$comment['id']}}" value="{{$comment['nick_name']}}">
                                            <input type="hidden" id="reply_user_id_{{$comment['id']}}" value="{{$comment['user_id']}}">

                                            <input type="hidden" id="reply_id_{{$comment['id']}}" value="{{$comment['id']}}">
                                            <input type="hidden" id="to_user_id_{{$comment['id']}}" value="{{$comment['user_id']}}">
                                            <input type="text" id="content_{{$comment['id']}}" name="reply_comment" class="form-control" placeholder="">
                                            <span class="input-group-btn"><button class="btn btn-primary" type="button" onclick="replyComment({{$comment['id']}})">回复</button></span>
                                        </div>
                                    </form>
                                </div>
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
                                        <a href="#">{{$reply_comment['nick_name']}} 回复 {{$reply_comment['to_nick_name']}} : </a>
                                    </header>
                                    <div class="panel-body">
                                        <div class="comment-action m-t-sm">
                                            <label class="label bg-info m-l-xs pull-left">{{$reply_comment['identity_str']}}</label>
                                            <label class="label bg-info m-l-xs pull-left">{{$reply_comment['user_type_str']}}</label>
                                            <span class="text-muted m-l-sm pull-left"><i class="fa fa-clock-o"></i>{{$reply_comment['created_at']}}</span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div>{{$reply_comment['content']}}</div>
                                        <div class="comment-action m-t-sm">
                                            <a onclick="showComment({{$reply_comment['id']}})" class="btn btn-default btn-xs"><i class="fa fa-mail-reply text-muted"></i> 回复</a>
                                        </div>

                                        <form id="reply_form_{{$reply_comment['id']}}" action="" class="m-b-none" style="display: none">
                                            <br>
                                            <div class="input-group">
                                                <input type="hidden" id="reply_nick_name_{{$reply_comment['id']}}" value="{{$reply_comment['nick_name']}}">
                                                <input type="hidden" id="reply_user_id_{{$reply_comment['id']}}" value="{{$reply_comment['user_id']}}">

                                                <input type="hidden" id="reply_id_{{$reply_comment['id']}}" value="{{$comment['id']}}">
                                                <input type="hidden" id="to_user_id_{{$reply_comment['id']}}" value="{{$reply_comment['user_id']}}">
                                                <input type="text" id="content_{{$reply_comment['id']}}" name="reply_comment" class="form-control" placeholder="">
                                                <span class="input-group-btn"><button class="btn btn-primary" type="button" onclick="replyComment({{$reply_comment['id']}})">回复</button></span>
                                            </div>
                                        </form>
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
                            <textarea id="add_content" class="form-control" rows="5" placeholder="字数限制为300"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-success" onclick="addComment()">发表</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-3">
                    <h5 class="font-bold">简 介</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{url('user/info/id/'.$data['user']['id'])}}" >
                                <span class="pull-right">点我</span>
                                <a href="{{url('user/info/id/'.$data['user']['id'])}}" class="text-info" >投稿人资料</a>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{url('user/info/id/'.$data['user']['id'])}}" >
                                <span class=" pull-right">
                                    <a onclick="follow()" data-toggle="class" class="m-l-sm active pull-right">
                                        {{--@if($data['post']['like_status'])--}}
                                            {{--<i class="fa fa-star-o text-muted text"></i>--}}
                                            {{--<i class="fa fa-star text-danger text-active"></i>--}}
                                        {{--@else--}}
                                            {{--<i class="fa fa-star-o text-muted text-active"></i>--}}
                                            {{--<i class="fa fa-star text-danger text"></i>--}}
                                        {{--@endif--}}
                                        @if($data['post']['followers_status'])
                                            <i class="fa fa-eye text"></i>
                                            <i class="fa fa-eye-slash text-active"></i>
                                        @else
                                            <i class="fa fa-eye-slash text"></i>
                                            <i class="fa fa-eye text-active"></i>

                                        @endif
                                        <label id="followers_num">{{$data['user']['user_info']['followers_num']}}</label>

                                    </a>
                                </span>
                                <a href="{{url('user/info/id/'.$data['user']['id'])}}" class="text-info" >关注不迷路</a>
                            </a>
                        </li>

                        
                        <li class="list-group-item">
                            <a href="#">
                                <span class="badge pull-right">{{$data['post_image']->count()}}</span>
                                图片总数
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <span class=" pull-right">{{$data['post']['payments']}} 鸡鸡币</span>
                                价格
                            </a>
                        </li>

                        <li class="list-group-item">
                            <a href="#">
                                <button class="badge btn btn-danger btn-sm pull-right ">Go</button>
                                点击购买
                            </a>
                        </li>
                    </ul>
                    <div class="tags m-b-lg l-h-2x">
                        <a href="#" class="label bg-primary">{{$data['user']['user_info']['identity_str']}}</a>
                        <a href="#" class="label bg-primary">{{$data['user']['user_type_str']}}</a>


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
    var post_id = '{{$data['post']['id']}}';
    //显示回复对话框
    function showComment(id){
        var reply_nick_name = $('#reply_nick_name_' + id).val();
        $('#reply_form_' + id).show();
        $('#content_' + id).attr('placeholder','回复 '+ reply_nick_name + ':');

    }

    //回复 xxx 留言
    function replyComment(id){
        var reply_id = $('#reply_id_' + id).val();
        var to_user_id = $('#to_user_id_' + id).val();
        var content = $('#content_' + id).val();
        comment(reply_id,to_user_id,content);
    }

    //新增一条留言
    function addComment(){
        var reply_id = 0;
        var to_user_id = 0;
        var content = $('#add_content').val();
        comment(reply_id,to_user_id,content);
    }

    //共通
    function comment(reply_id,to_user_id,content){
        $.ajax({
            type:'post',
            url:'/user/post/reply/comment',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'post_id':post_id,
                'reply_id':reply_id,
                'to_user_id':to_user_id,
                'content':content,
            },
            //traditional:false,//想要传递数组 设成false
            success:function(data){
                if(data.status==200){
                    window.location.reload();
                }else if(data.status==199){
                    //请去登录
                    window.location.href = data.data;
                }else{
                    alert(data.msg);
                    return false;
                }
            }
        });
    }

    //点赞,取消点赞
    function like(){
        $.ajax({
            type:'post',
            url:'/user/post/likes',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'post_id':post_id,
            },
            //traditional:false,//想要传递数组 设成false
            success:function(data){
                if(data.status==200){
                    $('#like_num').html(data.data);
                }else if(data.status==199){
                    //请去登录
                    window.location.href = data.data;
                }else{
                    alert(data.msg);
                    return false;
                }
            }
        });
    }

    //关注,取消关注
    function follow(){
        $.ajax({
            type:'post',
            url:'/user/follow',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'user_id':'{{$data['user']['id']}}',
            },
            //traditional:false,//想要传递数组 设成false
            success:function(data){
                if(data.status==200){
                    $('#followers_num').html(data.data);
                }else if(data.status==199){
                    //请去登录
                    window.location.href = data.data;
                }else{
                    alert(data.msg);
                    return false;
                }
            }
        });
    }
</script>
@stop


