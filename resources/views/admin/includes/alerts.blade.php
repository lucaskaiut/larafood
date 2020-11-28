@if(\Session::has('success'))
    <div class="alert alert-default-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
@endif

@if(\Session::has('error'))
    <div class="alert alert-default-danger" role="alert">
        {!! \Session::get('error') !!}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-default-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
