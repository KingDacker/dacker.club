@extends('admin.layout.main')
@section('content')
<div class="row">
    <form role="form" action="{{url('/admin/user/update/'.$data['user']->id)}}" method="post">
    <div class="col-md-6">
        <div class="box box-primary">
            {{csrf_field()}}
            <div class="box-body">
                <div class="form-group">
                    <label>用户ID</label>
                    <input type="text" name="password" class="form-control" disabled  value="{{$data['user']->id}}">
                </div>
                <div class="form-group">
                    <label>鸡鸡币</label>
                    <input type="text" name="point" class="form-control" disabled  value="{{$data['user_info']->point}}">
                </div>
                <div class="form-group">
                    <label>付费状态</label>
                    <input type="text" name="pay_status" class="form-control" disabled  value="{{$data['user']->pay_status_str}}">
                </div>
                <div class="form-group">
                    <label>用户密码</label>
                    <input type="text" name="password" class="form-control"  placeholder="不需要重置密码时不填" >
                </div>
                <div class="form-group">
                    <label>用户ID别称</label>
                    <input type="text" name="name_id" class="form-control"  value="{{$data['user']->name_id}}">
                </div>
                <div class="form-group">
                    <label>用户昵称</label>
                    <input type="text" name="nick_name" class="form-control"  value="{{$data['user']->nick_name}}">
                </div>
                <div class="form-group">
                    <label>用户邮箱</label>
                    <input type="email" name="email" class="form-control"  value="{{$data['user']->email}}">
                </div>

                <div class="form-group">
                    <label>用户角色</label>
                    <select name="user_type" id="user_type" class="form-control select2" style="width: 100%;">
                        <option  value="0" selected="selected">请选择</option>
                        @foreach($user_type as $user_type_key=>$user_type_value)
                            @if($data['user']['user_type'] == $user_type_key)
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
                            @if($data['user']['status'] == $status_key)
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
                        <input type="text" name="created_at" class="form-control pull-right" id="datepicker" value="{{$data['user']->created_at}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>付费截止日期</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="closed_at" class="form-control pull-right" id="datepicker" value="{{$data['user']->closed_at}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>最后登录日期</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="last_login_at" class="form-control pull-right" id="datepicker" value="{{$data['user']->last_login_at}}">
                    </div>
                </div>

                <div class="form-group">
                    <label >身高</label>
                    <input type="text" name="height" class="form-control"  value="{{$data['user_info']->height}}">
                </div>
                <div class="form-group">
                    <label >体重</label>
                    <input type="text" name="weight" class="form-control"  value="{{$data['user_info']->weight}}">
                </div>
                <div class="form-group">
                    <label >性别</label>
                    <select name="gender"  class="form-control select2" style="width: 100%;">
                        <option  value="0" selected="selected">请选择</option>
                        @foreach($user_gender as $gender_key=>$gender_value)
                            @if($data['user_info']['gender'] == $gender_key)
                                <option value="{{$gender_key}}" selected="selected" >{{$gender_value}}</option>
                            @else
                                <option value="{{$gender_key}}">{{$gender_value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                    返回
                </button>
                <button type="submit" class="btn btn-danger pull-right">确 定</button>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">

                <div class="form-group">
                    <label class="text-red">收益率</label>
                    <input type="text" name="point_scale" class="form-control"  value="{{$data['user_info']->point_scale}}">
                </div>
                <div class="form-group">
                    <label class="text-red">粉丝数量</label>
                    <input type="text" name="followers_num" class="form-control"  value="{{$data['user_info']->followers_num}}">
                </div>
                <div class="form-group">
                    <label class="text-red">用户身份</label>
                    <select name="identity"  class="form-control select2" style="width: 100%;">
                        <option  value="0" selected="selected">请选择</option>
                        @foreach($user_identity as $identity_key=>$identity_value)
                            @if($data['user_info']['identity'] == $identity_key)
                                <option value="{{$identity_key}}" selected="selected" >{{$identity_value}}</option>
                            @else
                                <option value="{{$identity_key}}">{{$identity_value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="text-red">手机</label>
                    <input type="text" name="mobile" class="form-control"  value="{{$data['user_info']->mobile}}">
                </div>
                <div class="form-group">
                    <label class="text-red">微信</label>
                    <input type="text" name="we_chat" class="form-control"  value="{{$data['user_info']->we_chat}}">
                </div>
                <div class="form-group">
                    <label class="text-red">支付宝账号</label>
                    <input type="text" name="ali_account" class="form-control"  value="{{$data['user_info']->ali_account}}">
                </div>
                <div class="form-group">
                    <label class="text-red">支付宝昵称</label>
                    <input type="text" name="ali_name" class="form-control"  value="{{$data['user_info']->ali_name}}">
                </div>


                <div class="form-group">
                    <label class="text-red">自我介绍</label>
                    <textarea name="introduce" class="form-control" rows="27" placeholder="Enter ...">{{$data['user_info']->introduce}}</textarea>
                </div>

            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                    返回
                </button>
                <button type="submit" class="btn btn-danger pull-right">确 定</button>
            </div>
        </div>
    </div>

    @if(count($data['address_list']))
    <div class="col-md-6">
        <div class="box box-primary">
            {{csrf_field()}}
            <div class="box-body">
                @foreach($data['address_list'] as $key=>$value)
                    <div class="form-group">
                        <label>{{$key+1}}. 收货人姓名 手机</label>
                        <p>{{$value['name'].' '.$value['mobile'].' '.$value['detail']}}"</p>
                        <input type="hidden" id="address_id" value="{{$value['id']}}">
                    </div>
                    <div class="form-group">
                        <a href="{{url('admin/address/edit/'.$value['id'].'/user/'.$data['user']->id)}}" class="btn btn-success" >编 辑</a>
                        <button type="button" class="btn btn-danger pull-right" onclick="delAddress()">删 除</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <label class="text-red">增加的鸡鸡币数量</label>
                    <input type="text" name="add_point" id="add_point" class="form-control" placeholder="要求为整数" value="">
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-danger pull-right" onclick="addPoint({{$data['user']->id}})">确 定</button>
            </div>
        </div>
        </div>
    </form>
</div>



@stop
@section('script')
<script>
    //增加鸡鸡币
    function addPoint(user_id){
        var add_point = $('#add_point').val();
        $.ajax({
            type:'post',
            url:'/admin/user/add/point',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'add_point':add_point,
                'user_id':user_id
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

    //删除地址
    function delAddress(){
        var address_id = $('#address_id').val();
        var user_id = '{{$data['user']->id}}';
        if(window.confirm('确定要删除吗？')){
            $.ajax({
                type:'post',
                url:'/admin/address/del',
                data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'address_id':address_id,
                    'user_id':user_id
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
        }else{
            return false;
        }



    }

</script>
@stop