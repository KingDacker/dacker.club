@extends('admin.layout.main')
@section('content')
<div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <form role="form" action="{{url('/admin/user/update/'.$data->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>用户ID</label>
                            <input type="text" name="password" class="form-control" disabled  value="{{$data->id}}">
                        </div>
                        <div class="form-group">
                            <label>付费状态</label>
                            <input type="text" name="pay_status" class="form-control" disabled  value="{{$data->pay_status_str}}">
                        </div>
                        <div class="form-group">
                            <label>用户密码</label>
                            <input type="text" name="password" class="form-control"  placeholder="不需要重置密码时不填" >
                        </div>
                        <div class="form-group">
                            <label>用户ID别称</label>
                            <input type="text" name="name_id" class="form-control" required value="{{$data->name_id}}">
                        </div>
                        <div class="form-group">
                            <label>用户昵称</label>
                            <input type="text" name="nick_name" class="form-control" required value="{{$data->nick_name}}">
                        </div>
                        <div class="form-group">
                            <label>用户邮箱</label>
                            <input type="email" name="email" class="form-control" required value="{{$data->email}}">
                        </div>

                        <div class="form-group">
                            <label>用户角色</label>
                            <select name="user_type" id="user_type" class="form-control select2" style="width: 100%;">
                                <option  value="0" selected="selected">请选择</option>
                                @foreach($user_type as $user_type_key=>$user_type_value)
                                    @if($data['user_type'] == $user_type_key)
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
                                    @if($data['status'] == $status_key)
                                        <option value="{{$status_key}}" selected="selected" >{{$status_value}}</option>
                                    @else
                                        <option value="{{$status_key}}">{{$status_value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>创建日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="created_at" class="form-control pull-right" id="datepicker" value="{{$data->created_at}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>付费截止日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="closing_data" class="form-control pull-right" id="datepicker" value="{{$data->closing_data}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>最后登录日期</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="last_login_data" class="form-control pull-right" id="datepicker" value="{{$data->last_login_data}}">
                            </div>
                            <!-- /.input group -->
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
        </div>
    </div>



@stop
@section('script')
    <script type="text/javascript">
        $(function () {

        });



    </script>
@stop