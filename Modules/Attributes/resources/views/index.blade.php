@extends('panel::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">لیست دسته بندی ها ({{ $attributesCount }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="#">
                    <i class="fa fa-plus"></i>
                    ایجاد ویژگی
                </a>
            </div>
            @include('category::partials.messages')
            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($attributes as $attribute)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $attribute->name }}
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

