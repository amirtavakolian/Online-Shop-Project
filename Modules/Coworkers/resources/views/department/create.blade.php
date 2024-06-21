@extends('panel::layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد دپارتمان</h5>
            </div>
            <hr>
            @include('coworkers::partials.messages')
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="slug">مدیر دپارتمان</label>
                        <select class="form-control" name="boss_id">
                            <option value="">بدون مدیریت</option>
                            @foreach($coworkers as $coworker)
                                <option value="{{ $coworker->id }}">{{ $coworker->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ route('departments.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection


