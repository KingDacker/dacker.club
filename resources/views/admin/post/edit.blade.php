@extends('admin.layout.main')
@section('content')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">审核帖子</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-footer">
        @foreach($post_status as $post_status_key=>$post_status_value)
            @if($data['status'] == $post_status_key)
                <input type="button" class="btn btn-success" value="{{$post_status_value}}" onclick="updatePost({{$post_status_key}})">
            @else
                <input type="button" class="btn btn-danger" value="{{$post_status_value}}" onclick="updatePost({{$post_status_key}})">
            @endif
        @endforeach
    </div>
</div>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">审核帖子</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>

    <form role="form" id="post_form" action="{{url('/admin/post/update/'.$data->id)}}" method="post">
        {{csrf_field()}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-group">
                        <label>用户ID</label>
                        <input type="text" name="user_id" class="form-control"  value="{{$data->user_id}}">
                    </div>
                    <div class="form-group">
                        <label>帖子标题</label>
                        <input type="text" name="title" class="form-control"  required value="{{$data->title}}" >
                    </div>
                    <div class="form-group">
                        <label>支付金额</label>
                        <input type="text" name="payments" class="form-control"  value="{{$data->payments}}">
                    </div>
                    <div class="form-group">
                        <label>创建日期</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="created_at" class="form-control pull-right" value="{{$data->created_at}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>投稿类型</label>
                        <select name="type"  class="form-control select2" style="width: 100%;">
                            <option  value="0" selected="selected">请选择</option>
                            @foreach($post_type as $post_type_key=>$post_type_value)
                                @if($data['type'] == $post_type_key)
                                    <option value="{{$post_type_key}}" selected="selected" >{{$post_type_value}}</option>
                                @else
                                    <option value="{{$post_type_key}}">{{$post_type_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>收费类型</label>
                        <select name="pay_type"  class="form-control select2" style="width: 100%;">
                            <option  value="0" selected="selected">请选择</option>
                            @foreach($post_pay_type as $post_pay_type_key=>$post_pay_type_value)
                                @if($data['pay_type'] == $post_pay_type_key)
                                    <option value="{{$post_pay_type_key}}" selected="selected" >{{$post_pay_type_value}}</option>
                                @else
                                    <option value="{{$post_pay_type_key}}">{{$post_pay_type_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>帖子审核类型</label>
                        <select id="status" name="status"  class="form-control select2" style="width: 100%;">
                            <option  value="0" selected="selected">请选择</option>
                            @foreach($post_status as $post_status_key=>$post_status_value)
                                @if($data['status'] == $post_status_key)
                                    <option value="{{$post_status_key}}" selected="selected" >{{$post_status_value}}</option>
                                @else
                                    <option value="{{$post_status_key}}">{{$post_status_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>帖子内容</label>
                        <textarea name="content" class="form-control" rows="3" >{{$data->content}}</textarea>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                返回
            </button>
            <button type="submit" class="btn btn-danger pull-right">确 定</button>
        </div>
    </form>
</div>
{{--投稿图片--}}
<div class="box box-default" >
    <div class="box-header with-border">
        <h3 class="box-title">投稿图片</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="timeline-item">
                <div class="timeline-body">
                    @foreach($images as $image)
                    {{--<img src="{{$image['image']}}" alt="" class="margin" width="160" height="150" />--}}
                    <a href="javascript:;" i="{{$image['image']}}" class="margin view_picture">
                        <img src="{{$image['image']}}" width="160" height="150">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>
{{--评论--}}
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">评论</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="box-body chat" id="chat-box">
                <!-- chat item -->
                @foreach($comments as $key=>$comment)
                <div class="item">
                    <img src="{{asset('/assets/img/user4-128x128.jpg')}}" alt="user image" class="online">
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right">
                                <i class="fa fa-clock-o"></i> {{$comment['created_at']}}
                            </small>
                            {{$comment['nick_name']}}
                        </a>
                        {{$comment['content']}}
                        <br>
                        <button type="button" class="btn btn-danger btn-sm " onclick="delComment({{$comment['id']}})" >删除</button>
                    </p>
                    @foreach($comment['reply'] as $k=>$v)
                    <div class="attachment">
                        <h4>{{$v['created_at']}} {{$v['nick_name']}}对{{$v['to_nick_name']}}说:</h4>
                        <p class="filename"> {{$v['content']}} </p>
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-sm " onclick="delComment({{$v['id']}})">删除</button>
                        </div>
                    </div>
                    @endforeach
                    <!-- /.attachment -->
                </div>
                @endforeach
                <!-- /.item -->
            </div>
            <!-- /.chat -->
        </div>
        <div class="box-footer">
            <div class="input-group">
                <input class="form-control" placeholder="Type message...">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-success">发布</button>
                </div>
            </div>
        </div>
        {{ $comments->links() }}
    </div>
    <!-- /.box-body -->
</div>



@stop
@section('script')
    <script type="text/javascript">
        $('.view_picture').simpleSlide();
        //删除评论
        function delComment(id){
            if(confirm('确定删除吗 ？')){
                $.ajax({
                    type:'post',
                    url:'/admin/post/delComment',
                    data:{'_token': '<?php echo csrf_token() ?>','id':id },
                    success:function(data){
                        if(data.status==200){
                            window.location.reload();
                        }else{
                            alert(data.msg);
                            return false;
                        }
                    }
                });
            }
        }

        //更新,审核帖子
        function updatePost(value){
            $('#status').val(value);
            $('#post_form').submit();
        }

    </script>
@stop