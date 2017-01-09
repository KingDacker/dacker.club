@extends('layout.main')
@section('content')
<section id="content">
<section class="vbox">
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">修改密码</h3>
        </div>
        @include('message.error')
        @include('message.success')
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <section class="panel panel-default">
            <header class="panel-heading font-bold">密码修改完成后,需要重新登录</header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">旧密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" >
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >新密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="new_password" class="form-control" value="">
                        <span class="help-block m-b-none">密码长度6-20</span>
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >新密码确认</label>
                    <div class="col-sm-10">
                        <input type="password" name="new_password_com" class="form-control" value="">
                        <span class="help-block m-b-none">密码长度6-20</span>
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button type="button" class="btn btn-default" onclick="self.location=document.referrer;">返回</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
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