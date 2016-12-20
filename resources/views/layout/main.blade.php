<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>{{ $page_title or "Dacker.club" }}Musik | Web Application</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/app.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/fileinput.css')}}" type="text/css" />
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
            @include('message.error')
            @include('message.success')
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
@yield('script')
</body>
</html>