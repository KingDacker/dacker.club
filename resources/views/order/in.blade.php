@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">收入记录</h3>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <section class="panel panel-default">
                <header class="panel-heading">
                    总收入 : {{$data['total_pay'] or 0}} 鸡鸡币
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
                            <td>投稿标题</td>
                            <td>投稿类型</td>
                            <td>购买人员</td>
                            <td>收入金额</td>
                            <td>收入日期</td>
                            <td></td>
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
                                <td>
                                    <a href="{{url('user/post/detail/'.$v['post_id'])}}">
                                        <b class="text-primary">{{$v['post_title']}}</b>
                                    </a>
                                </td>
                                <td>{{$v['post_type']}}</td>
                                <td>
                                    <a href="{{url('user/info/id/'.$value['user_id'])}}">
                                        <b class="text-primary">{{$value['nick_name']}}</b>
                                    </a>
                                </td>
                                <td>{{$value['pay_price']}}</td>
                                <td>{{$value['created_at']}}</td>
                                <td>
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


