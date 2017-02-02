@extends('layout.main')
@section('content')
    <section id="content">
        <section class="vbox">
            <section class="scrollable wrapper">
                <div class="m-b-md">
                    <h3 class="m-b-none">常见问题</h3>
                </div>
                @include('message.error')
                @include('message.success')
                <div class="row">
                    <div class="col-lg-12">
                        <!-- .accordion -->
                        <div class="panel-group m-b" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                        为什么我不能选择私属物品的分类,进行投稿?
                                    </a>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body text-sm">
                                        1.私属物品投稿,必须是女生.<br>
                                        2.必须申请成为中级会员.<br>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                        如何申请成为中级会员
                                    </a>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body text-sm">
                                        1.发送邮件到kingdacker@126.com,标题为--申请dacker俱乐部中级会员.<br>
                                        2.内容为:可以视频的联系方式(微信,QQ等),认证的时间.<br>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                        遇到解决不了的问题,或者Bug
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body text-sm">
                                        请继续骚扰客服 kingdacker@126.com
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- .tooltip & popup -->
                        {{--<section class="panel panel-default text-sm doc-buttons">--}}
                            {{--<div class="panel-body">--}}
                                {{--<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">Tooltip on top</button>--}}
                                {{--<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="" data-original-title="Tooltip on right">On right</button>--}}
                                {{--<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip on bottom">On bottom</button>--}}
                                {{--<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="left" title="" data-original-title="Tooltip on left">On left</button>--}}
                                {{--<button class="btn btn-sm btn-info" data-toggle="popover" data-html="true" data-placement="top" data-content="<div class='scrollable' style='height:40px'>Vivamus sagittis lacus vel augue laoreet rutrum faucibus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</div>" title="" data-original-title="<button type=&quot;button&quot; class=&quot;close pull-right&quot; data-dismiss=&quot;popover&quot;>×</button>Popover on top">Popover on top</button>--}}
                                {{--<a href="modal.html" data-toggle="ajaxModal" class="btn btn-sm btn-default">Modal</a>--}}
                            {{--</div>--}}
                        {{--</section>--}}
                    </div>
                </div>
            </section>
        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
    </section>

@stop
@section('script')
<script>

</script>
@stop


