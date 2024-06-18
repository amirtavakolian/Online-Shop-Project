@extends('panel::layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد دپارتمان</h5>
            </div>
            <hr>
            @include('coworkers::partials.messages')
            <form action="{{ route('coworkers.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">نام</label>
                        <input class="form-control" name="firstname" type="text">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">نام خانوادگی</label>
                        <input class="form-control"name="lastname" type="text">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">نام کاربری</label>
                        <input class="form-control"name="username" type="text">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="name">رمز عبور</label>
                        <input class="form-control"name="password" type="password">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="slug">دپارتمان</label>
                        <select class="form-control" name="department_id">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('coworkers.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection


