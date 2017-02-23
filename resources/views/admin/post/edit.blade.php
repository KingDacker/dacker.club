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
            @if($data['post']['status'] == $post_status_key)
                <input type="button" class="btn btn-success" value="{{$post_status_value}}" onclick="updatePost({{$post_status_key}})">
            @else
                <input type="button" class="btn btn-default" value="{{$post_status_value}}" onclick="updatePost({{$post_status_key}})">
            @endif
        @endforeach

        @if($data['top_status'])
                <input type="button" class="btn btn-success pull-right" value="取消置顶" onclick="topPost({{$data['post']->id}})">
        @else
                <input type="button" class="btn btn-success pull-right" value="置顶" onclick="topPost({{$data['post']->id}})">
        @endif
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

    <form role="form" id="post_form" action="{{url('/admin/post/update/'.$data['post']->id)}}" method="post">
        {{csrf_field()}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" value="{{$data['post']->id}}">
                    <div class="form-group">
                        <label>用户ID</label>
                        <input type="text" name="user_id" class="form-control"  value="{{$data['post']->user_id}}">
                    </div>
                    <div class="form-group">
                        <label>帖子标题</label>
                        <input type="text" name="title" class="form-control"  required value="{{$data['post']->title}}" >
                    </div>
                    <div class="form-group">
                        <label>支付金额</label>
                        <input type="text" name="payments" class="form-control"  value="{{$data['post']->payments}}">
                    </div>
                    <div class="form-group">
                        <label>创建日期</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="created_at" class="form-control pull-right" value="{{$data['post']->created_at}}">
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
                                @if($data['post']['type'] == $post_type_key)
                                    <option value="{{$post_type_key}}" selected="selected" >{{$post_type_value}}</option>
                                @else
                                    <option value="{{$post_type_key}}" >{{$post_type_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>帖子审核类型</label>
                        <select id="status" name="status"  class="form-control select2" style="width: 100%;">
                            <option  value="0" selected="selected">请选择</option>
                            @foreach($post_status as $post_status_key=>$post_status_value)
                                @if($data['post']['status'] == $post_status_key)
                                    <option value="{{$post_status_key}}" selected="selected" >{{$post_status_value}}</option>
                                @else
                                    <option value="{{$post_status_key}}">{{$post_status_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>帖子内容</label>
                        <textarea name="content" class="form-control" rows="5" >{{$data['post']->content}}</textarea>
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
                    @foreach($data['post_image'] as $image)
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
                @foreach($data['comments'] as $key=>$comment)
                <div class="post" style="padding-left: 5px">
                    <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{$comment['avatar_str']}}" alt="user image">
                    <span class="username">
                        <a href="javascript:void(0);">{{$comment['nick_name']}}</a>
                        <a class="pull-right btn-box-tool">{{$comment['created_at']}}</a>
                        <a class="pull-right btn-box-tool">{{$comment['user_type_str']}}</a>
                        <a class="pull-right btn-box-tool">{{$comment['identity_str']}}</a>
                    </span>
                    {{--<span class="description">Shared publicly - 7:30 PM today</span>--}}
                    </div>
                    <!-- /.user-block -->
                    <p> {{$comment['content']}}</p>
                    <ul class="list-inline">
                        <li><a href="javascript:void(0);" class="link-black text-sm" onclick="delComment({{$comment['id']}})"><i class="fa fa-share margin-r-5"></i> 删除</a></li>
                        {{--<li><a href="javascript:void(0);" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>--}}
                        <li class="pull-right"><a href="javascript:void(0);" class="link-black text-sm" onclick="showComment({{$comment['id']}})"><i class="fa fa-comments-o margin-r-5"></i> 回复</a></li>
                    </ul>
                    {{--回复框--}}
                    <div class="input-group" id="reply_form_{{$comment['id']}}" style="display: none">
                        <input id="content_{{$comment['id']}}" class="form-control" placeholder="Type message...">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success" onclick="replyComment({{$comment['id']}})">发布</button>
                        </div>
                        <input type="hidden" id="reply_nick_name_{{$comment['id']}}" value="{{$comment['nick_name']}}">
                        <input type="hidden" id="reply_user_id_{{$comment['id']}}" value="{{$comment['user_id']}}">
                        <input type="hidden" id="reply_id_{{$comment['id']}}" value="{{$comment['id']}}">
                        <input type="hidden" id="to_user_id_{{$comment['id']}}" value="{{$comment['user_id']}}">
                    </div>




                </div>
                    @foreach($comment['reply'] as $k=>$v)
                    <div class="post" style="margin-left: 45px;padding-left: 5px">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{$v['avatar_str']}}" alt="user image">
                            <span class="username">
                                <a href="javascript:void(0);">{{$v['nick_name']}}</a>
                                <a class="pull-right btn-box-tool">{{$v['created_at']}}</a>
                                <a class="pull-right btn-box-tool">{{$v['user_type_str']}}</a>
                                <a class="pull-right btn-box-tool">{{$v['identity_str']}}</a>
                            </span>
                            <span class="description">回复 {{$v['to_nick_name']}} :</span>
                        </div>
                        <!-- /.user-block -->
                        <p> {{$v['content']}}</p>
                        <ul class="list-inline">
                            <li><a href="javascript:void(0);" class="link-black text-sm" onclick="delComment({{$v['id']}})"><i class="fa fa-share margin-r-5"></i> 删除</a></li>
                            {{--<li><a href="javascript:void(0);" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>--}}
                            <li class="pull-right"><a href="javascript:void(0);" onclick="showComment({{$v['id']}})" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> 回复</a></li>
                        </ul>

                        {{--回复框--}}
                        <div class="input-group" id="reply_form_{{$v['id']}}" style="display: none">
                            <input id="content_{{$v['id']}}" class="form-control" placeholder="Type message...">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success" onclick="replyComment({{$v['id']}})">发布</button>
                            </div>
                            <input type="hidden" id="reply_nick_name_{{$v['id']}}" value="{{$v['nick_name']}}">
                            <input type="hidden" id="reply_user_id_{{$v['id']}}" value="{{$v['user_id']}}">
                            <input type="hidden" id="reply_id_{{$v['id']}}" value="{{$comment['id']}}">
                            <input type="hidden" id="to_user_id_{{$v['id']}}" value="{{$v['user_id']}}">
                        </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <!-- /.chat -->
        </div>
        <div class="box-footer">
            <div class="input-group">
                <input id="add_content" class="form-control" placeholder="Type message...">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-success" onclick="addComment()">发布</button>
                </div>
            </div>
        </div>
        {{ $data['comments']->links() }}
    </div>
    <!-- /.box-body -->
</div>



@stop
@section('script')
    <script type="text/javascript">
        var post_id = '{{$data['post']['id']}}';

        //图片插件
        $('.view_picture').simpleSlide();

        //删除评论
        function delComment(id){
            if(confirm('确定删除吗 ？')){
                $.ajax({
                    type:'post',
                    url:'/admin/post/del/comment',
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

        //置顶,取消置顶
        function topPost(id){
            $.ajax({
                type:'post',
                url:'/admin/post/top',
                data:{'_token': '<?php echo csrf_token() ?>','id':id },
                success:function(data){
                    if(data.status==200){
                        window.location.reload();
                    }else{
                        alert('bug');
                        return false;
                    }
                }
            });
        }

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
                url:'/admin/post/add/comment',
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
    </script>
@stop