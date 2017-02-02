@extends('layout.main')
@section('content')
    <section id="content">
        <section class="vbox">
            <section class="scrollable wrapper">
                <div class="m-b-md">
                    <h3 class="m-b-none">私密聊天</h3>
                </div>
                @include('message.error')
                @include('message.success')
                <div class="row">
                    <div class="col-lg-12">
                        <!-- chat -->
                        <section class="panel panel-default">
                            <header class="panel-heading">消息栏</header>
                            <section class="chat-list panel-body">
                                @foreach($data['list'] as $key=>$value)
                                    @if($value['position'] == 1)
                                        <article id="chat-id-1" class="chat-item left">
                                            <a href="#" class="pull-left thumb-sm avatar">
                                                <img src="{{$value['avatar_str']}}" alt="...">
                                            </a>
                                            <section class="chat-body">
                                                <div class="panel b-light text-sm m-b-none">
                                                    <div class="panel-body">
                                                        <span class="arrow left"></span>
                                                        <p class="m-b-none">{{$value['content']}}</p>
                                                    </div>
                                                </div>
                                                <small class="text-muted"><i class="fa fa-ok text-success"></i> {{$value['created_at']}}</small>
                                            </section>
                                        </article>
                                    @else
                                        <article id="chat-id-2" class="chat-item right">
                                            <a href="#" class="pull-right thumb-sm avatar">
                                                <img src="{{$value['avatar_str']}}" alt="...">
                                            </a>
                                            <section class="chat-body">
                                                <div class="panel bg-light text-sm m-b-none">
                                                    <div class="panel-body">
                                                        <span class="arrow right"></span>
                                                        <p class="m-b-none">{{$value['content']}}</p>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{$value['created_at']}}</small>
                                            </section>
                                        </article>
                                    @endif
                                @endforeach

                            </section>
                            <footer class="panel-footer">
                                <!-- chat form -->
                                <article class="chat-item" id="chat-form">
                                    <a class="pull-left thumb-sm avatar"></a>
                                    <section class="chat-body">
                                    <form action="{{url('user/news/chat/reply')}}" method="post" class="m-b-none">
                                    {{csrf_field()}}
                                        <div class="input-group">
                                        <input type="hidden" name="to_user_id" value="{{$data['user_id']}}">
                                        <input type="text" name="content" class="form-control" placeholder="每条私密消息,消耗一个鸡鸡币">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">发送</button>
                                        </span>
                                        </div>
                                    </form>
                                    </section>
                                </article>
                            </footer>
                        </section>
                        <!-- /chat -->
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


