@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox bg-white">
        {{--<header class="header bg-light lter hidden-print">--}}
            {{--<a href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>--}}
            {{--<p>Invoice</p>--}}
        {{--</header>--}}
        <section class="scrollable wrapper">
            @if($data['order']['address'])
            <h4>收货地址:</h4>
            <form class="form-horizontal" >
            <div class="well bg-light b m-t">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="radio i-checks">
                            <label>
                                {{$data['order']['receiver_name']}} {{$data['order']['receiver_mobile']}}
                                <br>{{$data['order']['address']}}
                                <br><b>{{$data['order']['express_name']}} {{$data['order']['express_num']}}</b>

                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                    <td>{{$data['order_post']['post_title']}}</td>
                    <td>￥{{$data['order']['price']}}</td>
                    <td>￥{{$data['order']['price']*$data['order']['buy_num']}}</td>
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
                    <td><strong>￥{{$data['order']['actual_price']}}</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right no-border"></td>
                    <td>
                        <button type="button" class="pull-left btn btn-primary" onclick="history.go(-1)" >返回</button>
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

</script>
@stop