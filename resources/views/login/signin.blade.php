<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>Dacker.club | Dacker俱乐部</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/app.css')}}" type="text/css" />
    <!--[if lt IE 9]>
    请使用谷歌浏览器
    <![endif]-->
</head>
<body class="bg-info dker">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xl">
        <a class="navbar-brand block" href="index.html"><span class="h1 font-bold">Dacker</span></a>
        <section class="m-b-lg">
            <header class="wrapper text-center">
                <strong>登录去寻找一些有趣的事情</strong>
            </header>
            @include('message.error')
            <form method="post" action="{{URL('/login/signin')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="email" placeholder="邮箱/ID" class="form-control input-lg text-center no-border">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="密码" class="form-control input-lg text-center no-border">
                </div>
                <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded">
                    <i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">登录</span>
                </button>
                <div class="text-center m-t m-b"><a href="{{url('/login/email')}}"><small>忘记密码?</small></a></div>
                <div class="line line-dashed"></div>
                <p class="text-muted text-center"><small>还没有账号?</small></p>
                <a href="{{url('/login/signup')}}" class="btn btn-lg btn-info btn-block rounded">注册一个账号</a>
            </form>
        </section>
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder">
        <p>
            <small>基于Bootstrap建设网站<br>&copy; 2016</small>
        </p>
    </div>
</footer>
<!-- / footer -->
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>


</body>
</html>