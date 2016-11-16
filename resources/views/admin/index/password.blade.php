@extends("admin.layout.main")
@section("content")
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">原始密码</label>
                        <input type="text" name="password" class="form-control" id="password" required  placeholder="原始密码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">新密码</label>
                        <input type="password" name="new_password" class="form-control" id="new_password" required placeholder="新密码">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">新密码确认</label>
                        <input type="password" name="new_password_again" class="form-control" id="new_password_again" required placeholder="新密码确认">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                        返回
                    </button>
                    <button type="submit" class="btn btn-danger pull-right">确 定</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $(".select2").select2();
        });
    </script>
@stop