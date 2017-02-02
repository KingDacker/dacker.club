@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">收入记录</h3>
            </div>
            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="{{url('user/address/edit')}}" class="btn btn-sm btn-success">新增收货地址</a>
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
                            <td>收货人姓名</td>
                            <td>收货人手机</td>
                            <td>收货地址</td>
                            <td>操作</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['address_list'] as $key=>$value)
                            <tr>
                                <td>
                                    <label class="checkbox m-n i-checks" style="padding-left: 20px;">
                                        <input type="checkbox" name="post[]"><i></i>
                                    </label>
                                </td>
                                <td><b class="text-primary">{{$value['name']}}</b></td>
                                <td>{{$value['mobile']}}</td>
                                <td><b class="text-primary">{{$value['detail']}}</b></td>
                                <td>
                                    <a href="{{url('user/address/edit/id/'.$value['id'])}}" class="btn btn-sm btn-success">编辑</a>
                                    <a onclick="delAddress({{$value['id']}})" class="btn btn-sm btn-danger">删除</a>
                                </td>
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
                            <ul class="pagination pagination-sm m-t-none m-b-none"></ul>
                        </div>
                    </div>
                </footer>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>


@stop
@section('script')
<script>
    function delAddress(id){
        if(confirm("确定删除")){
            $.ajax({
                type:'post',
                url:'/user/address/del',
                data:{
                    '_token': '<?php echo csrf_token() ?>',
                    'address_id':id,
                },
                //traditional:false,//想要传递数组 设成false
                success:function(data){
                    if(data.status==200){
                        window.location.href = '/user/address/list';
                    }else{
                        alert('服务器繁忙,请稍候再试');
                        return false;
                    }
                }
            });
        }
    }
</script>
@stop


