@extends('admin.layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            @include('message.error')
            @include('message.success')
            <form class="form-horizontal" method="post" action="{{url('user/order/pay')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <strong>编辑收货地址</strong>
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">收件人姓名</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="receiver_name" value="{{$data['address']['name'] or ''}}" class="form-control parsley-validated"  placeholder="收件人姓名">
                                    </div>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手机号码</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="receiver_mobile" value="{{$data['address']['mobile'] or ''}}" class="form-control parsley-validated" placeholder="手机号码">
                                    </div>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮政编码</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="postcode" value="{{$data['address']['postcode'] or ''}}" class="form-control parsley-validated" placeholder="邮政编码">
                                    </div>
                                </div>
                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">省 市 区</label>
                                    <div class="col-sm-3">
                                        <select id="province_select" class="form-control m-b" onchange="changeProvince()">
                                            <option value="0">请选择</option>
                                            @if($data['option_list'])
                                            @foreach($data['option_list']['province_list'] as $key=>$value)
                                                <option value="{{$value['id']}}"
                                                @if($data['address']['province']== $value['id'])
                                                    selected
                                                @endif
                                                >{{$value['name']}}</option>
                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="city_select" class="form-control m-b" onchange="changeCity()">
                                            <option value="0">请选择</option>
                                            @if($data['option_list'])
                                                @foreach($data['option_list']['city_list'] as $key=>$value)
                                                    <option value="{{$value['id']}}"
                                                            @if($data['address']['city']== $value['id'])
                                                            selected
                                                            @endif
                                                    >{{$value['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="area_select" class="form-control m-b" >
                                            <option value="0">请选择</option>
                                            @if($data['option_list'])
                                                @foreach($data['option_list']['area_list'] as $key=>$value)
                                                    <option value="{{$value['id']}}"
                                                            @if($data['address']['area']== $value['id'])
                                                            selected
                                                            @endif
                                                    >{{$value['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="line line-dashed b-b line-lg pull-in"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">详细地址</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="address_detail" value="{{$data['address']['detail'] or ''}}" class="form-control parsley-validated" placeholder="详细地址">
                                    </div>
                                </div>

                            </div>
                            <footer class="panel-footer text-right bg-light lter">
                                <button type="button" class="btn btn-success btn-s-xs" onclick="addAddress('add')">新增地址</button>
                                <button type="button" class="btn btn-success btn-s-xs" onclick="addAddress('update')">更新地址</button>
                            </footer>
                        </section>
                    </div>
                </div>
                <div class="line"></div>
            </form>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>


@stop
@section('script')
<script>
    var address_id = '{{$data['address']['id'] or 0}}';
    var user_id = '{{$data['user_id']}}';
    var address_option = '';


    //改变省
    function changeProvince(){
        addressOption($('#province_select').val());
        var temp_html = '<option value="0">请选择</option>';
        $.each(address_option,function(i,val){
            temp_html+="<option value='"+val.id+"'>"+val.name+"</option>";
        });
        $('#city_select').html(temp_html);
        $('#area_select').html('<option value="0">请选择</option>');
    }

    //改变市
    function changeCity(){
        addressOption($('#city_select').val());
        var temp_html = '<option value="0">请选择</option>';
        $.each(address_option,function(i,val){
            temp_html+="<option value='"+val.id+"'>"+val.name+"</option>";
        });
        $('#area_select').html(temp_html);
    }

    //公共方法
    function addressOption(pid){
        $.ajax({
            type:'post',
            async: false,
            url:'/address/option',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'pid':pid
            },
            //traditional:false,//想要传递数组 设成false
            success:function(data){
                if(data.status==200){
                    address_option = data.data;
                }else{
                    alert('服务器繁忙,请稍候再试');
                    return false;
                }
            }
        });
    }

    //新增收货地址
    function addAddress($method){
        var name = $("#receiver_name").val();
        var mobile = $("#receiver_mobile").val();
        var postcode = $("#postcode").val();
        var province = $("#province_select").val();
        var city = $("#city_select").val();
        var area = $("#area_select").val();
        var detail = $("#address_detail").val();
        if(name&&mobile&&postcode&&province&&city&&area&&detail){
            $.ajax({
                type:'post',
                url:'/admin/address/create',
                data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'address_id':address_id,
                    'name':name,
                    'mobile':mobile,
                    'postcode':postcode,
                    'province':province,
                    'city':city,
                    'area':area,
                    'detail':detail,
                    'user_id':user_id,
                    'method':$method
                },
                //traditional:false,//想要传递数组 设成false
                success:function(data){
                    if(data.status==200){
                        window.location.href = '/admin/user/edit/' + user_id;
                    }else{
                        alert('服务器繁忙,请稍候再试');
                        return false;
                    }
                }
            });
        }else{
            alert('请填写正确的收货地址');
            return false;
        }


    }
</script>
@stop


