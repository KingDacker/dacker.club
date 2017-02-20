@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">私密消息</h3>
            </div>
            <form role="form" id="my_form" action="" method="post">
            <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                    消息列表
                </header>
                <section class="panel-body">
                    @foreach($data['list'] as $key=>$value)
                    <article class="media">
                        <span class="pull-left thumb-sm">
                            <a href="{{url('user/info/id/'.$value['send_user']['id'])}}">
                                <img src="{{$value['send_user']['avatar_str']}}" alt="..." class="img-circle">
                            </a>
                        </span>
                        <div class="media-body" onclick="chatDetail({{$value['user_id']}})">
                            <div class="pull-right media-xs text-center text-muted">
                                {{--<strong class="h4">12:18</strong>--}}
                            </div>
                            <small class="block">
                                <a href="#" class="">{{$value['send_user']['nick_name']}}</a>
                                {{--<span class="label label-success">Circle</span>--}}
                                <label class="label bg-info m-l-sm pull-right">{{$value['send_user']['user_type_str']}}</label>
                                <label class="label bg-info m-l-sm pull-right">{{$value['send_user']['user_info']['identity_str']}}</label>

                            </small>
                            @if($value['new_msg'])
                                <small class="block m-t-sm text-success"><a href="#">你收到一条新的私密信息</a></small>
                            @else
                                <small class="block m-t-sm"><a href="#">点击查看历史信息</a></small>

                            @endif
                        </div>
                    </article>
                    <div class="line pull-in"></div>
                    @endforeach
                </section>
            </section>

            </form>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>


@stop
@section('script')
<script>
    function chatDetail(user_id){
        window.location.href = '/user/news/chat/detail/' + user_id;
    }

</script>
@stop


