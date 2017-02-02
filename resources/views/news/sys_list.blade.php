@extends('layout.main')
@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <div class="m-b-md">
                <h3 class="m-b-none">系统消息</h3>
            </div>
            <form role="form" id="my_form" action="" method="post">
            {{csrf_field()}}
            <section class="panel panel-default">
                <header class="panel-heading">
                    消息栏
                </header>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light" >
                        <thead>
                        <tr>
                            <td>内容</td>
                            <td width="15%">日期</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['list'] as $key=>$value)
                            <tr>
                                <td>{{$value['content']}}</td>
                                <td>{{$value['created_at']}}</td>
                                {{--<td>--}}
                                    {{--<a href="#" class="btn btn-s-md btn-success">--}}
                                        {{--{{$value['created_at']}}--}}
                                    {{--</a>--}}
                                {{--</td>--}}

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
                                {{ $data['list']->render()}}
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

</script>
@stop


