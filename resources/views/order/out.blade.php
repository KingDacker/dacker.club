@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">支出列表</h3>
            </div>
            <form role="form" id="my_form" action="" method="post">
            {{csrf_field()}}
            <section class="panel panel-default">
                <header class="panel-heading">
                    总支出 : {{$data['total_pay'] or 0}} 鸡鸡币
                </header>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light" >
                        <thead>
                        <tr>
                            <td style="width:10px;" >
                                <label class="checkbox m-n i-checks" style="padding-left: 20px;">
                                    <input type="checkbox"><i></i>
                                </label>
                            </td>
                            <td>订单ID</td>
                            <td>投稿标题</td>
                            <td>投稿类型</td>
                            <td>支付金额</td>
                            <td>支付日期</td>
                            <td>详情</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['order_list'] as $key=>$value)
                            @foreach($value['post_list'] as $k=>$v)
                            <tr>
                                <td>
                                    <label class="checkbox m-n i-checks" style="padding-left: 20px;">
                                        <input type="checkbox" name="post[]"><i></i>
                                    </label>
                                </td>
                                <td>{{$value['oid']}}</td>
                                <td>
                                    <a href="{{url('post/detail/'.$v['post_id'])}}">
                                        <b class="text-primary">{{$v['post_title']}}</b>
                                    </a>
                                </td>
                                <td>{{$v['post_type']}}</td>
                                <td>{{$value['actual_price']}}</td>
                                <td>{{$value['created_at']}}</td>
                                <td>
                                    <a href="{{url('user/order/detail/'.$v['id'])}}" class="btn btn-s-sm btn-info">订单详情</a>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-4 hidden-xs"></div>
                        <div class="col-sm-4 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm"></small>
                        </div>
                        <div class="col-sm-4 text-right text-center-xs">
                            {{--分页--}}
                            {{$data['order_list']->links()}}
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {{--<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><a href="#">4</a></li>--}}
                                {{--<li><a href="#">5</a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                </footer>
            </section>
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


