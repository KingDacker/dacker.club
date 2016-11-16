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
            <input type="reset" style="display:none;" />
            <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="page" value="1">
                    <div class="form-group">
                        <label>ID别称</label>
                        <input type="text" name="name_id" class="form-control" id="name_id" value="{{$condition['name_id']}}">
                    </div>
                    <div class="form-group">
                        <label>邮箱地址</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{$condition['email']}}">
                    </div>
                    <div class="form-group">
                        <label>用户昵称</label>
                        <input type="text" name="nick_name" class="form-control" id="nick_name" value="{{$condition['nick_name']}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>用户角色</label>
                        <select name="user_type" id="user_type" class="form-control select2" style="width: 100%;">
                            <option  value="0" selected="selected">请选择</option>
                            @foreach($user_type as $user_type_key=>$user_type_value)
                                @if($condition['user_type'] == $user_type_key)
                                    <option value="{{$user_type_key}}" selected="selected" >{{$user_type_value}}</option>
                                @else
                                    <option value="{{$user_type_key}}">{{$user_type_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>用户状态</label>
                        <select name="status" id="status" class="form-control select2" style="width: 100%;">
                            <option value="0" >请选择</option>
                            @foreach($status as $status_key=>$status_value)
                                @if($condition['status'] == $status_key)
                                    <option value="{{$status_key}}" selected="selected" >{{$status_value}}</option>
                                @else
                                    <option value="{{$status_key}}">{{$status_value}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>是否付费</label>
                        <select name="pay_status" id="pay_status" class="form-control select2" style="width: 100%;">
                            <option value="0" >请选择</option>
                            @foreach($pay_status as $pay_status_key=>$pay_status_value)
                                @if($condition['pay_status'] == $pay_status_key)
                                    <option value="{{$pay_status_key}}" selected="selected" >{{$pay_status_value}}</option>
                                @else
                                    <option value="{{$pay_status_key}}">{{$pay_status_value}}</option>
                                @endif
                            @endforeach
                        </select>
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
                    <h3 class="box-title">用户总数</h3>
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
                            <th>ID别称</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>角色</th>
                            <th>状态</th>
                            <th>付费</th>
                            <th>操作</th>
                        </tr>
                        @forelse($data as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name_id}}</td>
                                <td>{{$user->nick_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_type_str}}</td>
                                <td>{{$user->status_str}}</td>
                                <td>{{$user->pay_status_str}}</td>
                                <td>
                                    <a class="label label-success" href="{{URL::to('admin/user/edit/'.$user->id)}}">编辑</a>
                                    <span class="label label-danger" href="{{URL::to('admin/user/'.$user->id)}}">删除</span>
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
            'name_id' => $condition['name_id'],
            'email' => $condition['email'],
            'nick_name' => $condition['nick_name'],
            'user_type' => $condition['user_type'],
            'status' => $condition['status'],
            'pay_status' => $condition['pay_status'],
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
            var name_id = $('#name_id').val();
            var email =  $('#email').val();
            var nick_name =  $('#nick_name').val();
            var user_type =  $('#user_type').val();
            var status =  $('#status').val();
            var pay_status =  $('#pay_status').val();
            window.location.href = '/admin/user?name_id='+name_id+'&email='+email+'&nick_name='+nick_name+
                                   '&user_type='+user_type+'&status='+status+'&pay_status='+pay_status;
        }

        //清空表单
        function resetForm(){
            $('#name_id').val('');
            $('#email').val('');
            $('#nick_name').val('');
            $('#user_type').val(0);
            $('#status').val(0);
            $('#pay_status').val(0);
        }
    </script>
@stop