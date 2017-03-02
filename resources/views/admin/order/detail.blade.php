@extends("admin.layout.main")
@section('content')

<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> AdminLTE, Inc.
                <small class="pull-right">Date: {{$data['order']['created_at']}}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            邮寄地址
            <address>
                <br><strong>{{$data['order']['receiver_name']}}</strong><br>
                {{$data['order']['address']}}<br>
                手机号码: {{$data['order']['receiver_mobile']}}<br>
                快递公司:{{$data['order']['express_name']}}<br>
                快递编号:{{$data['order']['express_num']}}
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>订单编号</b><br>
            <br>
            <b>Order ID:</b> {{$data['order']['oid']}}<br>
            <b>Order Post ID: </b> {{$data['order_post']['id']}}<br>
        </div>
        <div class="col-sm-4 invoice-col">
            备注
            <address>
                <br>{{$data['order']['remark']}}
            </address>
        </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>数量</th>
                    <th>投稿标题</th>
                    <th>单价</th>
                    <th>总价</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$data['order_post']['post_title']}}</td>
                    <td>{{$data['order']['price']}}</td>
                    <td>{{$data['order']['actual_price']}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>邮费:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>折扣:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>实际支付:</td>
                    <td>{{$data['order']['actual_price']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
            </button>
            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</section>
@stop
@section('script')
    <script type="text/javascript">

    </script>
@stop