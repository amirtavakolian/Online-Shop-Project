@extends('panel::layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد نقش کاربری</h5>
            </div>
            <hr>
            @include('rolepermission::partials.messages')
            <form action="{{ route('user-roles.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">کاربران:</label>
                        <select class="form-control" name="user_id">
                            @foreach($users as $user)
                                <option
                                        value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label for="name">سطوح دسترسی</label>
                <div class="form-row">
                    @foreach($roles as $role)
                        <div class="form-group col-md-2">
                            <input type="checkbox" name="roles_id[]" value="{{ $role->id }}" id="">
                            <label for="name">{{ $role->slug }}</label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('user-roles.index') }}" class="btn btn-danger mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>

@endsection()

