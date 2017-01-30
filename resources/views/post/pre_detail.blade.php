@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable wrapper-lg">
            @include('message.error')
            @include('message.success')
            <div class="row">
                <div class="col-sm-9">
                    <div class="blog-post">
                        <div class="post-item">
                            <header class="panel-heading"><strong>点击查看高清大图</strong></header>
                            {{--(写真)--}}
                            <div class="post-left" style="margin-left:10px; ">
                                @foreach($data['post_image'] as $key=>$value)
                                    <a href="javascript:;" i="{{$value['image']}}" class=" nose_view_picture">
                                        <img style="width:24%;" src="{{$value['image']}}" width="160" height="200">
                                    </a>
                                @endforeach
                            </div>
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
                                </div>
                            </div>
                        </div>
                        <div class="post-item">
                            <div class="caption wrapper-lg">
                                <h3 class="post-title">未通过/删除理由</h3>
                                <div class="post-sum">
                                    <p>{{$data['post']['reply']}}</p>
                                </div>
                                <div class="line line-lg"></div>

                            </div>
                        </div>
                    </div>
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
                    </ul>
                    <div class="tags m-b-lg l-h-2x">
                        <a href="#" class="label bg-primary">{{$data['user']['user_info']['identity_str']}}</a>
                        <a href="#" class="label bg-primary">{{$data['user']['user_type_str']}}</a>
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

    //幻灯片
    $('.nose_view_picture').simpleSlide(
//        {
//
//            "opacity":0.5,                  //背景透明度
//            "windowAction": "zoomIn",       //窗体进入动画
//            "imageAction": "bounceIn",      //图片进入动画
//            "loadingImage":"img/1.gif"      //加载图片
//
//        }
    );

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

    //虚拟支付
    function pay(){
        if(confirm("确定购买?")){
            $('#pay_form').submit();
        }
    }
</script>
@stop


