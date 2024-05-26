@extends('panel::layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد نقش کاربری</h5>
            </div>
            <hr>
            @include('rolepermission::partials.messages')
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام انگلیسی:</label>
                        <input class="form-control" id="name" name="name" type="text">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">اسلاگ فارسی:</label>
                        <input class="form-control" id="slug" name="slug" type="text">
                    </div>
                </div>
                <label for="name">سطوح دسترسی</label>
                <div class="form-row">
                    @foreach($permissions as $permission)
                        <div class="form-group col-md-3">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="">
                            <label for="name">{{ $permission->slug }}</label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('roles.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>

@endsection()

