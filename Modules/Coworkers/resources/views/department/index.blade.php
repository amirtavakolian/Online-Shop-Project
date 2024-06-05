@extends('panel::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">لیست دپارتمان ها</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('departments.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دپارتمان
                </a>
            </div>
            @include('category::partials.messages')
            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>دپارتمان</th>
                        <th>مدیر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $department->name }}
                            </th>
                            <th>
                                {{ $department->departmentBoss }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-success mr-3" href="#">ویرایش</a>
                                <a class="btn btn-sm btn-danger mr-3" href="#">حذف</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
