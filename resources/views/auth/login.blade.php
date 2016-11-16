<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset("/assets/css/app.css") }}" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>TianMao</b>CMF
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Happy Coding</p>

        <form action="{{URL::to('/auth/login')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row form-group has-feedback">
                <input type="text" class="form-control" placeholder="账号" name="email">
                <span class="fa fa-user form-control-feedback"></span>
                @include('admin.layout.message.tips',['field'=>'email'])
            </div>
            <div class="row form-group has-feedback">
                <input type="password" class="form-control" placeholder="密码" name="password">
                <span class="fa fa-lock form-control-feedback"></span>
                @include('admin.layout.message.tips',['field'=>'password'])
            </div>
            <div class="row form-group has-feedback">
                <input type="text" class="form-control" placeholder="验证码" name="captcha">
                <span class="fa fa-image form-control-feedback"></span>
                @include('admin.layout.message.tips',['field'=>'captcha'])
            </div>
            <div class="row form-group has-feedback">
                <img src="{{$captcha}}" alt="图片验证码" style="width: 100%;">
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" value="1"> 保持登录
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登 录</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset ("/assets/js/app.js") }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
    });
</script>
</body>
</html>