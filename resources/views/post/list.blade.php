@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">投稿列表</h3>
            </div>
            <form role="form" id="my_form" action="" method="post">
            {{csrf_field()}}
            <section class="panel panel-default">
                <header class="panel-heading">
                    投稿状态
                </header>
                <div class="row wrapper">
                    <div class="col-sm-5 m-b-xs">
                        <select name="status" id="status"  class="input-sm form-control input-s-sm inline v-middle">
                            <option value="0">请选择</option>
                            @foreach($post_status as $post_status_key=>$post_status_value )
                                @if($data['condition']['status'] == $post_status_key)
                                    <option value="{{$post_status_key}}" selected="selected" >{{$post_status_value}}</option>
                                @else
                                    <option value="{{$post_status_key}}">{{$post_status_value}}</option>
                                @endif

                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-default" onclick="postForm()">搜索</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light" >
                        <thead>
                        <tr>
                            <td style="width:10px;" >
                                <label class="checkbox m-n i-checks" style="padding-left: 20px;">
                                    <input type="checkbox"><i></i>
                                </label>
                            </td>
                            <td>ID</td>
                            <td>投稿标题</td>
                            <td>投稿类型</td>
                            <td>投稿价格(元)</td>
                            <td>投稿日期</td>
                            <td>投稿状态</td>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['post_list'] as $key=>$value)
                            <tr>
                                <td>
                                    <label class="checkbox m-n i-checks" style="padding-left: 20px;">
                                        <input type="checkbox" name="post[]"><i></i>
                                    </label>
                                </td>
                                <td>{{$value['id']}}</td>
                                <td>{{$value['title']}}</td>
                                <td>{{$value['type_str']}}</td>
                                <td>{{$value['payments']}}</td>
                                <td>{{$value['created_at']}}</td>
                                <td>
                                    <a href="#" class="btn btn-s-md btn-{{$value['status_color']}}">
                                        {{$value['status_str']}}
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-4 hidden-xs"></div>
                        <div class="col-sm-4 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm"></small>
                        </div>
                        <div class="col-sm-4 text-right text-center-xs">
                            {{--分页--}}
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {{ $data['post_list']->appends(['status' => $data['condition']['status']])->render()}}
                                {{--<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>--}}
                                {{--<li><a href="#">1</a></li>--}}
                                {{--<li><a href="#">2</a></li>--}}
                                {{--<li><a href="#">3</a></li>--}}
                                {{--<li><a href="#">4</a></li>--}}
                                {{--<li><a href="#">5</a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
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
    //提交表单(每次提交搜索前,重置page)
    function postForm(){
        var status =  $('#status').val();
        window.location.href = '/user/post/list?status='+status;
    }
</script>
@stop


