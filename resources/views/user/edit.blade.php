@extends('layout.main')
@section('content')
<section id="content">
<section class="vbox">
    <section class="scrollable padder">
        <div class="m-b-md">
            <h3 class="m-b-none">修改个人信息</h3>
        </div>

        @include('message.error')
        @include('message.success')
        {{--基本信息--}}
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <section class="panel panel-default">
            <header class="panel-heading font-bold">基本信息</header>
            <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">ID</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user']['name_id']}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">注册日期</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user']['created_at']}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">昵称</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user']['nick_name']}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮箱</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user']['email']}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">身份认证</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user_info']['identity_str']}}</p>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">会员类型</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">{{$data['user']['user_type_str']}}</p>
                        </div>
                    </div>

            </div>
        </section>
        {{--详细信息--}}
        <section class="panel panel-default">
            <header class="panel-heading font-bold">详细信息</header>
            <div class="panel-body">

                    {{--<div class="col-sm-6">--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">身高</label>
                        <div class="col-sm-10">
                            <input type="text" name="height" value="{{$data['user_info']['height']}}" placeholder="单位cm" class="form-control" >
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">体重</label>
                        <div class="col-sm-10">
                            <input type="text" name="weight" value="{{$data['user_info']['weight']}}" placeholder="单位kg" class="form-control">
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="male" value="1"
                                        @if($data['user_info']['gender']==1)
                                        checked
                                        @endif
                                    >
                                    Male(男性)
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="female" value="2"
                                       @if($data['user_info']['gender']==2)
                                       checked
                                       @endif
                                    >
                                    Female(女性)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >手机</label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" class="form-control" value="{{$data['user_info']['mobile']}}">
                            <span class="help-block m-b-none">请放心填写,本站不会泄露任何个人资料</span>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >微信</label>
                        <div class="col-sm-10">
                            <input type="text" name="we_chat" class="form-control" value="{{$data['user_info']['we_chat']}}">
                            <span class="help-block m-b-none">请放心填写,本站不会泄露任何个人资料</span>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">自我介绍</label>
                        <div class="col-sm-10">
                            <textarea name="introduce" class="form-control" rows="10">{{$data['user_info']['introduce']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-id-1">头像</label>
                        <div class="col-sm-10">
                            <input id="upload_image" name="upload_image" type="file"  >
                            <input id="avatar" type="hidden" name="avatar" value="">
                            {{csrf_field()}}
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="button" class="btn btn-default" onclick="self.location=document.referrer;">返回</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                    {{--</div>--}}

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
    //初始化控件
    function initFileInput(ctrlName, uploadUrl) {
        var token = '{{csrf_token()}}';
        var image = '{{$data['user']['avatar_str']}}';
        var control = $('#' + ctrlName);
        control.fileinput({
            language: 'zh', //设置语言
            uploadUrl: uploadUrl, //上传的地址
            overwriteInitial: true,
            allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//接收的文件后缀
            dropZoneEnabled: true,//是否显示拖拽区域
            //maxFileCount: 1, //表示允许同时上传的最大文件个数
            maxFileSize: 500,//单位为kb，如果为0表示不限制文件大小
            msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
            uploadExtraData: {_token: token},//额外参数
            initialPreview: "<img src='"+image+"' />",
            //uploadAsync:false,默认异步,false 则同步
            //enctype: 'multipart/form-data',//数据类型
            //maxFilesNum: 1,//最多文件数量
            //minImageWidth: 50, //图片的最小宽度
            //minImageHeight: 50,//图片的最小高度
            //maxImageWidth: 1000,//图片的最大宽度
            //maxImageHeight: 1000,//图片的最大高度
            //showUpload: true, //是否显示上传按钮
            //showCaption: true,//是否显示标题
            //browseClass: "btn btn-primary", //按钮样式
            //previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",

        }).on("filebatchselected", function(event, files) {
            //自动上传参数
            $(this).fileinput("upload");
        }).on("fileuploaded", function (event, data, previewId, index) {
            var response = data.response;
            if(response.status==200){
                $('#avatar').val(response.data.img_name);
            }
        });
    }
    initFileInput('upload_image','/user/upload/image');
</script>
@stop