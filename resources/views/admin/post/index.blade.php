@extends("admin.layout.main")
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">检索条件</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <form role="form" id="myform" action="" method="post">
            {{csrf_field()}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="page" value="1">
                        <div class="form-group">
                            <label>帖子ID</label>
                            <input type="text" name="id" class="form-control" id="id" value="{{$condition['id']}}">
                        </div>
                        <div class="form-group">
                            <label>用户ID</label>
                            <input type="text" name="user_id" class="form-control" id="user_id" value="{{$condition['user_id']}}">
                        </div>
                        <div class="form-group">
                            <label>昵称ID</label>
                            <input type="text" name="name_id" class="form-control" id="name_id" value="{{$condition['name_id']}}">
                        </div>
                        <div class="form-group">
                            <label>用户昵称</label>
                            <input type="text" name="nick_name" class="form-control" id="nick_name" value="{{$condition['nick_name']}}">
                        </div>
                        <div class="form-group">
                            <label>帖子标题</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$condition['title']}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>投稿类型</label>
                            <select name="type" id="type" class="form-control select2" style="width: 100%;">
                                <option  value="0" selected="selected">请选择</option>
                                @foreach($post_type as $post_type_key=>$post_type_value)
                                    @if($condition['type'] == $post_type_key)
                                        <option value="{{$post_type_key}}" selected="selected" >{{$post_type_value}}</option>
                                    @else
                                        <option value="{{$post_type_key}}">{{$post_type_value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>收费类型</label>
                            <select name="pay_type" id="pay_type" class="form-control select2" style="width: 100%;">
                                <option  value="0" selected="selected">请选择</option>
                                @foreach($post_pay_type as $post_pay_type_key=>$post_pay_type_value)
                                    @if($condition['pay_type'] == $post_pay_type_key)
                                        <option value="{{$post_pay_type_key}}" selected="selected" >{{$post_pay_type_value}}</option>
                                    @else
                                        <option value="{{$post_pay_type_key}}">{{$post_pay_type_value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>帖子状态</label>
                            <select name="status" id="status" class="form-control select2" style="width: 100%;">
                                <option  value="0" selected="selected">请选择</option>
                                @foreach($post_status as $post_status_key=>$post_status_value)
                                    @if($condition['status'] == $post_status_key)
                                        <option value="{{$post_status_key}}" selected="selected" >{{$post_status_value}}</option>
                                    @else
                                        <option value="{{$post_status_key}}">{{$post_status_value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>开始日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="start_time" class="form-control pull-right" id="start_time" value="{{$condition['start_time']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>结束日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="end_time" class="form-control pull-right" id="end_time" value="{{$condition['end_time']}}">
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="button" class="btn btn-success" value="清空表单" onclick="resetForm()">
                <input type="button" class="btn btn-success" value="开始搜索" onclick="postForm()"/>
                {{--<input type="submit" class="btn btn-success" value="开始搜索" />--}}
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">帖子总数</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 120px;">
                            <div class="input-group-btn">
                                <a class="btn btn-app">
                                    <span class="badge bg-yellow">{{$data->total()}}</span>
                                    <i class="fa fa-users"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>用户ID</th>
                            <th>昵称ID</th>
                            <th>用户昵称</th>
                            <th>标题</th>
                            <th>投稿类型</th>
                            <th>收费类型</th>
                            <th>支付金额</th>
                            <th>帖子状态</th>
                            <th>操作</th>
                        </tr>
                        @forelse($data as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user_id}}</td>
                                <td>{{$post->name_id}}</td>
                                <td>{{$post->nick_name}}</td>

                                <td>{{$post->title}}</td>
                                <td>{{$post->type_str}}</td>
                                <td>{{$post->pay_type_str}}</td>
                                <td>{{$post->payments}}</td>
                                <td>{{$post->status_str}}</td>
                                <td>
                                    <a class="label label-success" href="{{URL::to('admin/post/edit/'.$post->id)}}">详情</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-left">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    {{--分页--}}
    {{ $data->appends(
        [
            'id' => $condition['id'],
            'user_id' => $condition['user_id'],
            'name_id' => $condition['name_id'],
            'nick_name' => $condition['nick_name'],
            'title'=>$condition['title'],
            'type' => $condition['type'],
            'pay_type' => $condition['pay_type'],
            'status' => $condition['status'],
            'start_time' => $condition['start_time'],
            'end_time' => $condition['end_time'],
        ]
        )->render()
    }}
            <!-- /.content -->

    {{--@include('admin.layout.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这名用户吗?'])--}}
@stop
@section('script')
    <script type="text/javascript">
        //提交表单(每次提交搜索前,重置page)
        function postForm(){
            var id = $('#id').val();
            var user_id = $('#user_id').val();
            var name_id = $('#name_id').val();
            var nick_name =  $('#nick_name').val();
            var title =  $('#title').val();
            var type =  $('#type').val();
            var pay_type =  $('#pay_type').val();
            var status =  $('#status').val();
            var start_time =  $('#start_time').val();
            var end_time =  $('#end_time').val();
//            console.log('/admin/post?id='+id+'&user_id='+user_id+'&name_id='+name_id+'&nick_name='+nick_name+
//                    '&title='+title+'&type='+type+'&pay_type='+pay_type+'&status='+status+'&start_time='+start_time+
//                    '&end_time='+end_time);
            window.location.href = '/admin/post?id='+id+'&user_id='+user_id+'&name_id='+name_id+'&nick_name='+nick_name+
                    '&title='+title+'&type='+type+'&pay_type='+pay_type+'&status='+status+'&start_time='+start_time+
                    '&end_time='+end_time;
        }

        //清空表单
        function resetForm(){
            $('#id').val('');
            $('#user_id').val('');
            $('#name_id').val('');
            $('#nick_name').val(0);
            $('#title').val(0);
            $('#type').val(0);
            $('#pay_type').val(0);
            $('#status').val(0);
            $('#start_time').val('');
            $('#end_time').val('');

        }
    </script>
@stop