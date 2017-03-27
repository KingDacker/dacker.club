
<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>Musik | Web Application</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/animate.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/simple-line-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('/nose_source/css/app.css')}}" type="text/css" />
</head>
<body class="bg-light dk">
<section id="content">
    <div class="row m-n">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="text-center m-b-lg">
                <h1 class="h text-white animated fadeInDownBig">404</h1>
            </div>
            <div class="list-group auto m-b-sm m-b-lg">
                <a href="/" class="list-group-item">
                    <i class="fa fa-chevron-right icon-muted"></i>
                    <i class="fa fa-fw fa-home icon-muted"></i> 回到 首页

                </a>
                <a href="javascript:history.go(-1);location.reload()" class="list-group-item" >
                    <i class="fa fa-chevron-right icon-muted"></i>
                    <i class="fa fa-fw fa-question icon-muted" ></i> 返回 前页

                </a>
                <a class="list-group-item">
                    
                    <span class="badge bg-info lt">service@dackerclub.com</span>
                    <i class="fa fa-fw fa-phone icon-muted"></i> 联系 客服
                </a>
            </div>
        </div>
    </div>
</section>
<!-- footer -->
{{--<footer id="footer">--}}
    {{--<div class="text-center padder clearfix">--}}
        {{--<p>--}}
            {{--<small>Web app framework base on Bootstrap<br>&copy; 2014</small>--}}
        {{--</p>--}}
    {{--</div>--}}
{{--</footer>--}}
<footer id="footer" class="footer ">
    <div class="text-center padder clearfix">
        <p>
            <small>Email: service@dackerclub.com<br></small>
            <small>
                版权保护:如侵犯了您的隐私,请联系站长.<br>
                本站接受赞助和广告
                <strong>Copyright © {{date('Y')}}</strong><br>
            </small>
        </p>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-xs-6">--}}
            {{--<strong>联系站长:</strong>--}}
            {{--<p>--}}
                {{--Dacker.club<br>--}}
                {{--Email: service@dackerclub.com<br>--}}
            {{--</p>--}}
        {{--</div>--}}
        {{--<div class="col-xs-6">--}}
            {{--<strong>版权保护:</strong>--}}
            {{--<p>--}}
                {{--如侵犯了您的隐私,请联系站长.<br>--}}
                {{--本站接受赞助和广告--}}
                {{--<strong>Copyright © {{date('Y')}}</strong><br>--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
</footer>
<!-- / footer -->
<script src="{{ asset ("/nose_source/js/jquery.min.js") }}" type="text/javascript"></script>

<script>
    function returnPage(){
        self.location=document.referrer;
    }

</script>
</body>
</html>