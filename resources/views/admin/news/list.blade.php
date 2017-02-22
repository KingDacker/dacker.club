@extends("admin.layout.main")
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">发布系统公告</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body pad">
                        <form action="{{url('/admin/news/add/system')}}" method="post">
                            {{csrf_field()}}
                            <textarea  name="content" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px; " placeholder="公告内容"></textarea>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-success" value="新增">
                            </div>
                        </form>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th width="70%">公告内容</th>
                                <th>状态</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            @forelse($data['list'] as $list)
                                <tr>
                                    <td>{{$list->id}}</td>
                                    <td>{!! $list->content !!}</td>
                                    <td>
                                        @if($list->status==1)
                                            正常
                                        @else
                                            删除
                                        @endif
                                    <td>{{$list->created_at}}</td>
                                    <td>
                                        <form action="{{url('/admin/news/del/system')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="news_id" value="{{$list->id}}">
                                        <button type="submit" class="btn btn-block btn-danger btn-xs">还原/删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-left">暂无数据</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{--@include('admin.layout.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这名用户吗?'])--}}
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $(".textarea").wysihtml5();
        });

    </script>
@stop