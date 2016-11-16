{{--点击可以关闭的错误信息--}}
@if(Session::has('errors'))
    <div id="errors-message" class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 错误!</h4>
        @if(is_object($errors))
            @foreach($errors->all() as $error)
                <p>{{$error}}!</p>
            @endforeach
        @else
            <p>{{$errors}}!</p>
        @endif
    </div>
@endif



