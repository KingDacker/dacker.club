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
                            <label>订单ID</label>
                            <input type="text" name="id" class="form-control" id="id" value="{{$data['condition']['id']}}">
                        </div>
                        <div class="form-group">
                            <label>订单编号</label>
                            <input type="text" name="oid" class="form-control" id="oid" value="{{$data['condition']['oid']}}">
                        </div>
                        <div class="form-group">
                            <label>用户昵称ID</label>
                            <input type="text" name="name_id" class="form-control" id="name_id" value="{{$data['condition']['name_id']}}">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>开始日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="start_time" class="form-control pull-right" id="start_time" value="{{$data['condition']['start_time']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>结束日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="end_time" class="form-control pull-right" id="end_time" value="{{$data['condition']['end_time']}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>用户邮件</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{$data['condition']['email']}}">
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
                    <h3 class="box-title">订单总数</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 120px;">
                            <div class="input-group-btn">
                                <a class="btn btn-app">
                                    <span class="badge bg-yellow">{{$data['order_list']->total()}}</span>
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
                            <th>订单号</th>
                            <th>投稿标题</th>
                            <th>实物/虚拟</th>
                            <th>订单状态</th>
                            <th>下单时间</th>
                            <th>操作</th>

                        </tr>
                        @forelse($data['order_list'] as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->oid}}</td>
                                <td>{{$order->post_title}}</td>
                                <td>{{$order->order_type_str}}</td>
                                <td>{{$order->order_status_str}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a class="label label-success" href="{{URL::to('admin/post/edit/'.$order->id)}}">详情</a>
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
    {{ $data['order_list']->appends(
        [
            'name_id' => $data['condition']['name_id'],
            'email' => $data['condition']['email'],
            'id' => $data['condition']['id'],
            'oid' => $data['condition']['oid'],
            'start_time' => $data['condition']['start_time'],
            'end_time' => $data['condition']['end_time'],
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
            var oid = $('#oid').val();
            var name_id = $('#name_id').val();
            var email =  $('#email').val();
            var start_time =  $('#start_time').val();
            var end_time =  $('#end_time').val();
            window.location.href = '/admin/order/lists?id='+id+'&oid='+oid+'&name_id='+name_id+'&email='+email+
                    '&start_time='+start_time+ '&end_time='+end_time;
        }

        //清空表单
        function resetForm(){
            $('#id').val('');
            $('#oid').val('');
            $('#name_id').val('');
            $('#emial').val('');
            $('#start_time').val('');
            $('#end_time').val('');
        }
    </script>
@stop