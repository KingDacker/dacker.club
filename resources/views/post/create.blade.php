@extends('layout.main')
@section('content')

<section id="content">
<section class="vbox">
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 id="top_bar" class="m-b-none">开始申请投稿</h3>
        </div>
        <form  enctype="multipart/form-data" class="form-horizontal" >
            @include('message.close_error')
            <section class="panel panel-default">
                <header class="panel-heading"><strong>投稿基本信息</strong></header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题(必填)</label>
                        <div class="col-sm-10">
                            <input type="text" id="title" data-required="true" class="form-control" placeholder="5-15个字符">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">价格(选填)</label>
                        <div class="col-sm-10">
                            <input type="text" id="payments" data-notblank="true" class="form-control" placeholder="不填写则为免费(价格区间0-100000)" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">投稿类型(必填)</label>
                        <div class="col-sm-10">
                            @foreach($post_type as $key=>$value)
                                <div class="radio i-checks">
                                    <label>
                                @if($data['user']['user_type']>=3)
                                    <input type="radio" name="type" value="{{$key}}"   checked="">
                                    <i></i><b>{{$value}}</b>
                                @elseif($key==1)
                                    <input type="radio"  disabled="">
                                    <i></i><b style="color: #00a7d0">{{$value}}</b><b style="color: red"> (为什么我不能选?)</b>
                                @else
                                    <input type="radio" name="type" value="{{$key}}"   checked="">
                                    <i></i><b>{{$value}}</b>
                                @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容(选填)</label>
                        <div class="col-sm-10">
                            <textarea  id="post_content" class="form-control" rows="5" placeholder="内容描述(0-300字符)"></textarea>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                </div>
            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    <strong>图片信息(图片大小不能超过2mb,图片数量2-50张)</strong>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        {{--<input id="upload_image-id" name="upload_image" type="file"  class="file" multiple data-overwrite-initial="false" data-min-file-count="2" >--}}
                        <input id="upload_image" name="upload_image" type="file" multiple data-overwrite-initial="false" >
                        <input id="image_arr" type="hidden" name="image_arr" value="">
                        {{csrf_field()}}
                    </div>
                </div>
                <footer class="panel-footer text-right bg-light lter">
                    <input type="button"  class="btn btn-success btn-s-xs" onclick="post()" value="申请投稿" >
                </footer>
            </section>

        </form>

    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>

</section>


@stop
@section('script')
<script>
    //初始化fileinput控件（第一次初始化）
    function initFileInput(ctrlName, uploadUrl) {
        var token = '{{csrf_token()}}';
        var control = $('#' + ctrlName);
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: uploadUrl, //上传的地址
            overwriteInitial: false,
            allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
            dropZoneEnabled: true,//是否显示拖拽区域
            maxFileCount: 50, //表示允许同时上传的最大文件个数
            minFileCount: 2, //表示允许同时上传的最大文件个数
            maxFileSize: 2072,//单位为kb，如果为0表示不限制文件大小
            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
            uploadExtraData: {_token: token},//额外参数
            //uploadAsync:false,默认异步,false 则同步
            //enctype: 'multipart/form-data',//数据类型
            //maxFilesNum: 50,//最多文件数量
            //minImageWidth: 50, //图片的最小宽度
            //minImageHeight: 50,//图片的最小高度
            //maxImageWidth: 1000,//图片的最大宽度
            //maxImageHeight: 1000,//图片的最大高度
            //showUpload: true, //是否显示上传按钮
            //showCaption: true,//是否显示标题
            //browseClass: "btn btn-primary", //按钮样式
            //previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        }).on("fileuploaded", function (event, data, previewId, index) {
            var response = data.response;
            if(response.status==200){
                img_arr.push(response.data.img_name);
            }
        });
    }
    var img_arr = [];
    initFileInput('upload_image','/user/upload/image');

    //提交
    function post(){
        var title = $('#title').val();
        var content = $('#post_content').val();
        var type = $("input[name='type']:checked").val();
        var payments = $('#payments').val();
        if(!payments){
            payments = 0.00;
        }
        //检测标题
        if(title.length<5 || title.length>15){
            $('#error_div').show();
            $('#error_message').html('标题的长度为5-13');
            location.hash='#top_bar';
            return false;
        }
        //检测支付金额
        if(payments<0 || payments>100000){
            $('#error_div').show();
            $('#error_message').html('价格区间为0-10w');
            location.hash='#top_bar';
            return false;
        }
        //检测图片数量
        if(img_arr.length==0){
            $('#error_div').show();
            $('#error_message').html('最少上传一张图片');
            location.hash='#top_bar';
            return false;
        }

        //检测内容
        if(content.length>=300){
            $('#error_div').show();
            $('#error_message').html('内容描述限制字符为300');
            location.hash='#top_bar';
            return false;
        }

        $.ajax({
            type:'post',
            url:'/user/post/create',
            data:{
                '_token': '<?php echo csrf_token() ?>',
                'image_arr':img_arr,
                'title':title,
                'content':content,
                'type':type,
                'payments':payments,
            },
            traditional:false,//想要传递数组 设成false
            success:function(data){
                if(data.status==200){
                    window.location.reload();
                }else if(data.status==199){
                    //请去登录
                    window.location.href = data.data;
                }else{
                    alert(data.msg);
                    return false;
                }
            }
        });
    }
</script>
@stop