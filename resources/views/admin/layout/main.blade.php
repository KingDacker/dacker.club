<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ $page_title or "dacker club" }}</title>
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    @yield('style')
</head>
<body class="skin-blue">
<div class="wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $data['page_title'] or "Page Title" }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">{{$data['page_title']}}</li>
            </ol>
        </section>
        <section class="content">
            @include('message.error')
            @include('message.success')
            @yield('content')
        </section>
    </div>
    @include('admin.layout.footer')
</div>
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>
@yield('script')
</body>
</html>