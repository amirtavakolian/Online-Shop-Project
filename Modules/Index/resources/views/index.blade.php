@extends('index::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('index.name') !!}</p>
@endsection
