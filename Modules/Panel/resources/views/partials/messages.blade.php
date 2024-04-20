@if(session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
@if(session()->has('failed'))
    <div class="alert alert-danger">{!!  session()->get('failed') !!}</div>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif
