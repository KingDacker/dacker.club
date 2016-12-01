<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="{{asset('/nose_source/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/app.css')}}" type="text/css" />
    <!--[if lt IE 9]>
    请使用谷歌浏览器
    <![endif]-->
</head>
<body class="bg-info dker">
<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xl">
        <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">Dacker</span></a>
        <section class="m-b-lg">
            <header class="wrapper text-center">
                <strong>注册去寻找一些有趣的事情 </strong>
            </header>
            @include('admin.layout.message.error')
            <form action="">
                <p><p>
                <div class="form-group">
                    <input name="nick_name" placeholder="昵称(2-8个字符)" class="form-control  input-lg text-center no-border" value="{{old('nick_name')}}">
                </div>
                <div class="form-group">
                    <input name="email" type="email" placeholder="邮箱" class="form-control  input-lg text-center no-border" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <input name="password" type="password" placeholder="密码(6-20个字符)" class="form-control  input-lg text-center no-border">
                </div>
                <div class="checkbox i-checks m-b">
                    <label class="m-l">
                        <input type="checkbox" checked="" disabled><i></i> 同意 <a href="#">内容和条款</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign up</span></button>
                <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>已经有账号了?</small></p>
                <a href="{{url('login/signin')}}" class="btn btn-lg btn-info btn-block btn-rounded">Sign in</a>
            </form>
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder clearfix">
        <p>
            <small>基于Bootstrap建设网站<br>&copy; 2016</small>
        </p>
    </div>
</footer>
<!-- / footer -->
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>

</body>
</html>