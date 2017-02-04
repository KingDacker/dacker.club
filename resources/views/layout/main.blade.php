<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>{{ $data['page_title'] or "Dacker.club" }}</title>
    <meta name="Keywords" content="写真 美女 萝莉 女王 御姐 原味 丝袜 内裤 内衣 援交 av 学生妹 一夜情 " />
    <meta name="description" content="写真 美女 萝莉 女王 御姐 原味 丝袜 内裤 内衣 援交 av 学生妹 一夜情 " />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/app.css')}}" type="text/css" />
    {{--上传--}}
    <link rel="stylesheet" href="{{asset('/nose_source/css/fileinput.css')}}" type="text/css" />
    {{--simple.slide图片查看插件 基于jquery1.8--}}
    <link rel="stylesheet" href="{{asset('/nose_source/css/simple.slide.css')}}" type="text/css" />

    @yield('style')
</head>


<body class="">
<section class="vbox">
    @include('layout.header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
            @include('layout.sidebar')
            <!-- /.aside -->
            @yield('content')
        </section>
    </section>
</section>
<script src="{{ asset ("/nose_source/js/jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/nose_source/js/bootstrap.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/nose_source/js/app.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/nose_source/js/slimscroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/nose_source/js/app.plugin.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/nose_source/js/fileinput.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/nose_source/js/fileinput_locale_zh.js") }}" type="text/javascript"></script>

{{--simple.slide图片查看插件 基于jquery1.8--}}
<script src="{{ asset ("/nose_source/js/simple.slide.min.js") }}" type="text/javascript"></script>

@yield('script')
</body>
</html>