@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">提现记录</h3>
            </div>
            @include('message.error')
            @include('message.success')
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <section class="panel panel-default">
                <header class="panel-heading font-bold">申请提现</header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">可提现金额</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$point}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">支付宝账号</label>
                        <div class="col-lg-6">
                            <input type="text" name="ali_account" value="{{$data['user_info']['ali_account']}}" placeholder="支付宝账号" class="form-control" >
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">支付宝昵称</label>
                        <div class="col-lg-6">
                            <input type="text" name="ali_name" value="{{$data['user_info']['ali_name']}}" placeholder="支付宝昵称" class="form-control" >
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">体现金额</label>
                        <div class="col-sm-6">
                            <input type="text" name="cash" value="" placeholder="提现金额最小限制为100的整数倍" class="form-control" >
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-default" onclick="self.location=document.referrer;">返回</button>
                            <button type="submit" class="btn btn-primary">申请</button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="panel panel-default">
                    <header class="panel-heading">
                        提现记录
                    </header>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light" >
                            <thead>
                            <tr>
                                <td>提现金额</td>
                                <td>申请日期</td>
                                <td>申请状态</td>
                                <td>备注/回复</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['applications_list'] as $key=>$value)
                                <tr>
                                    <td>{{$value['number']}}</td>
                                    <td>{{$value['created_at']}}</td>
                                    <td>{{$value['status_str']}}</td>
                                    <td>{{$value['reply']}}</td>
                                </tr>
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
                                {{$data['applications_list']->links()}}
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


