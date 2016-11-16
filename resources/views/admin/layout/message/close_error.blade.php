@if(Session::has('errors'))
    <div class="callout callout-danger">
        <h4>错误!</h4>
        @if(is_object($errors))
            @foreach($errors->all() as $error)
                <p>{{$error}}!</p>
            @endforeach
        @else
            <p>{{$errors}}!</p>
        @endif
    </div>
@endif