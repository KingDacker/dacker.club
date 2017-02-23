@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable">
            @include('message.error')
            @include('message.success')
            <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                    <section class="vbox">
                        <section class="scrollable">
                            <div class="wrapper">
                                <div class="text-center m-b m-t">
                                    <a href="#" class="thumb-lg" >
                                        <img src="{{$data['user']['avatar_str']}}" class="img-circle">
                                    </a>
                                    <div>
                                        <div class="h3 m-t-xs m-b-xs">{{$data['user']['nick_name']}}</div>
                                        <small class="text-muted"><b>ID: </b> {{$data['user']['name_id']}}</small>
                                    </div>
                                </div>
                                <div class="panel wrapper">
                                    <div class="row text-center">
                                        <div class="col-xs-6">
                                            <a href="#">
                                                <span class="m-b-xs h4 block">{{$data['user']['post_num']}}</span>
                                                <small class="text-muted">发稿数量</small>
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="#">
                                                <span class="m-b-xs h4 block" id="followers_num">{{$data['user']['fun_num']}}</span>
                                                <small class="text-muted">粉丝数量</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group btn-group-justified m-b">
                                    <a class="btn btn-success btn-rounded" data-toggle="button" onclick="follow()">
                                        <span class="text">
                                          <i class="fa fa-eye"></i> 关注
                                        </span>
                                        <span class="text-active">
                                          <i class="fa fa-eye-slash"></i> 取消关注
                                        </span>
                                    </a>
                                    <a class="btn btn-dark btn-rounded" onclick="sendMessage()">
                                        <i class="fa fa-comment-o"></i> 发送私信
                                    </a>
                                </div>
                                <div>
                                    <h5 class="font-thin ">自我介绍</h5>
                                    <p>
                                        <?php echo str_replace(" "," ",str_replace("\n","<br/>",$data['user_info']['introduce']))?>
                                    </p>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </section>
                    </section>
                </aside>
                <aside class="col-lg-3 b-l">
                    <section class="vbox">
                        <section class="scrollable padder-v">
                            <div class="panel">
                                <h4 class="font-thin padder">详细信息</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p><a class="text-info">身份信息</a> </p>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 身份认证: {{$data['user_info']['identity_str']}}
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 会员类型: {{$data['user']['user_type_str']}}
                                        </small>
                                    </li>
                                    <li class="list-group-item">
                                        <p><a  class="text-info">个人信息</a></p>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 注册日期: {{$data['user']['register_at']}}
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 身高: {{$data['user_info']['height']?$data['user_info']['height'].'cm':''}}
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 体重: {{$data['user_info']['weight']?$data['user_info']['weight'].'kg':''}}
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 性别: {{$data['user_info']['gender_str']}}
                                        </small>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel clearfix">
                                <div class="panel-body">
                                    <div class="clear">
                                        <p><a  class="text-info">联系方式</a></p>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 电话: ******
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 微信: ******
                                        </small>
                                        <small class="block text-muted">
                                            <i class="fa fa-clock-o"></i> 邮箱: ******
                                        </small>
                                        <p><a href="{{url('user/info/update')}}" class="btn btn-xs btn-success m-t-xs">修改资料</a></p>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </section>
                </aside>
                <aside class="bg-white">
                    <section class="vbox">
                        <header class="header bg-light lt">
                            <ul class="nav nav-tabs nav-white">
                                <li class="active"><a href="#activity" data-toggle="tab">投稿列表</a></li>
                                {{--<li class=""><a href="#events" data-toggle="tab">Events</a></li>--}}
                                {{--<li class=""><a href="#interaction" data-toggle="tab">Interaction</a></li>--}}
                            </ul>
                        </header>
                        <section class="scrollable">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                        @if($data['post_list']->count())
                                            @foreach($data['post_list'] as $lists)
                                                <li class="list-group-item">
                                                    <a href="{{url('user/post/detail/'.$lists['id'])}}" class="thumb-sm pull-left m-r-sm">
                                                        <img src="{{$data['user']['avatar_str']}}" class="img-circle">
                                                    </a>
                                                    <a href="{{url('user/post/detail/'.$lists['id'])}}" class="clear">
                                                        <small class="pull-right">{{$lists['created_at']}}</small>
                                                        <strong class="block">{{$lists['title']}}</strong>
                                                        <small>{{$lists['content']}}</small>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item">
                                            <a class="clear">
                                                <strong class="block">没有投稿记录</strong>
                                                <small></small>
                                            </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="tab-pane" id="events">
                                    <div class="text-center wrapper">
                                        <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                                    </div>
                                </div>
                                <div class="tab-pane" id="interaction">
                                    <div class="text-center wrapper">
                                        <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </section>
                </aside>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>
@stop
@section('script')
<script>
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

    //发送私信
    function sendMessage(){
        var user_id  = '{{$data['user']['id']}}';
        window.location.href = '/user/news/chat/detail/'+user_id;
    }
</script>
@stop