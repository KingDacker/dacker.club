@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox bg-white">
        {{--<header class="header bg-light lter hidden-print">--}}
            {{--<a href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>--}}
            {{--<p>Invoice</p>--}}
        {{--</header>--}}
        <section class="scrollable wrapper">
            @include('message.error')
            @include('message.success')
            <h4>收货地址:</h4>
            <form class="form-horizontal" method="post" action="{{url('user/order/pay')}}">
            {{csrf_field()}}
            <input type="hidden" name="post_id" value="{{$data['post']['id']}}">
            <input type="hidden" name="order_type" value="{{$data['post']['order_type']}}">
            <div class="well bg-light b m-t">
                <h5><a href="#"  target="_blank" >管理收货地址点这里</a></h5>
                <div class="row">

                    @if($data['address_list']->count())
                        @foreach($data['address_list'] as $value)
                            <div class="col-xs-6">
                                <div class="radio i-checks">
                                    <label>
                                        <input type="radio" name="address_id" value="{{$value['id']}}" checked="">
                                        <i></i>{{$value['name']}} {{$value['mobile']}}
                                        <br>{{$value['detail']}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-12">
                            <section class="panel panel-default">
                                <header class="panel-heading">
                                    <strong>新增收货地址</strong>
                                </header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">收件人姓名</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="receiver_name" class="form-control parsley-validated"  placeholder="收件人姓名">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">手机号码</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="receiver_mobile" class="form-control parsley-validated" placeholder="手机号码">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">邮政编码</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="postcode" class="form-control parsley-validated" placeholder="邮政编码">
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">省 市 区</label>
                                        <div class="col-sm-3">
                                            <select id="province_select" class="form-control m-b" onchange="changeProvince()">
                                                <option value="0">请选择</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="city_select" class="form-control m-b" onchange="changeCity()">
                                                <option value="0">请选择</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="area_select" class="form-control m-b" >
                                                <option value="0">请选择</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">详细地址</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="address_detail" class="form-control parsley-validated" placeholder="详细地址">
                                        </div>
                                    </div>

                                </div>
                                <footer class="panel-footer text-right bg-light lter">
                                    <button type="button" class="btn btn-success btn-s-xs" onclick="addAddress()">新增地址</button>
                                </footer>
                            </section>
                        </div>
                    @endif
                </div>
            </div>
            <div class="line"></div>
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 60px">数量</th>
                    <th>投稿商品</th>
                    <th style="width: 140px">单价</th>
                    <th style="width: 90px">总价</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$data['post']['title']}}</td>
                    <td>￥{{$data['post']['payments']}}</td>
                    <td>￥{{$data['post']['payments']}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><strong>邮费</strong></td>
                    <td>￥0.00</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right no-border"><strong>折扣</strong></td>
                    <td>￥0.00</td>
                </tr>

                <tr>
                    <td colspan="3" class="text-right no-border"><strong>实际支付</strong></td>
                    <td><strong>￥{{$data['post']['payments']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right no-border"></td>
                    <td>
                        @if($data['post'])
                        <button type="submit" class="pull-left btn btn-primary" >支付</button>
                        @else
                        <button type="button" class="pull-left btn btn-danger" disabled >售罄了哟!</button>
                        @endif

                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>
@stop
@section('script')
<script>
    var address_option = '';
    //初始化省
    var is_init = '{{$data['address_list']->count()}}';
    if(is_init=='0'){
        initProvince();
    }

    function initProvince(){
        addressOption(0);
        var temp_html = '<option value="0">请选择</option>';
        $.each(address_option,function(i,val){
            temp_html+="<option value='"+val.id+"'>"+val.name+"</option>";
        });
        $('#province_select').html(temp_html);
        $('#city_select').html('<option value="0">请选择</option>');
        $('#area_select').html('<option value="0">请选择</option>');
    }

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
            url:'/user/address/option',
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
    function addAddress(){
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
                //async: false,
                url:'/user/address/create',
                data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'name':name,
                    'mobile':mobile,
                    'postcode':postcode,
                    'province':province,
                    'city':city,
                    'area':area,
                    'detail':detail,
                },
                //traditional:false,//想要传递数组 设成false
                success:function(data){
                    if(data.status==200){
                        window.location.reload();
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