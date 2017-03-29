<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>{{ $data['page_title'] or "DackerClub.com" }}</title>
    <meta name="baidu-site-verification" content="xxcwFSux5Y" />
    <meta name="Keywords" content="与其拍摄一个东西，不如拍摄一个意念，与其拍摄一个意念，不如拍摄一个梦幻 岁月更替，在光与影的交错里，演绎一场与时光的相逢写真 美女 萝莉 女王 御姐  私房 写真 {{ $data['post']['title'] or "DackerClub.com" }}" />
    <meta name="description" content="与其拍摄一个东西，不如拍摄一个意念，与其拍摄一个意念，不如拍摄一个梦幻 岁月更替，在光与影的交错里，演绎一场与时光的相逢写真 美女 萝莉 女王 御姐 私房 写真 {{ $data['post']['title'] or "DackerClub.com" }}" />
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