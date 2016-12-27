{{--@if(Session::has('errors'))--}}
    {{--<div class="callout callout-danger">--}}
        {{--<h4>错误!</h4>--}}
        {{--@if(is_object($errors))--}}
            {{--@foreach($errors->all() as $error)--}}
                {{--<p>{{$error}}!</p>--}}
            {{--@endforeach--}}
        {{--@else--}}
            {{--<p>{{$errors}}!</p>--}}
        {{--@endif--}}
    {{--</div>--}}
{{--@endif--}}



<div id="error_div" class="alert alert-warning alert-block" style="display: none">
    {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
    <h4><i class="fa fa-bell-alt"></i>警告!</h4>
    <p id="error_message">发生了一些错误,请联系站长</p>
</div>
