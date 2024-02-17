@extends('panel::layouts.master')

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="font-weight-bold">لیست دسته بندی ها ({{ $categoriesCount }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('category.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>
            @include('category::partials.messages')
            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام انگلیسی</th>
                        <th>والد</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $category->name }}
                            </th>
                            <th>
                                {{ $category->slug }}
                            </th>
                            <th>
                                {{ $category->parent_id == null ? 'بدون والد' : $category->parent->name }}
                            </th>

                            <th>
                                    <span
                                        class="{{ $category->categoryStatus[0] }}">
                                        {{ $category->categoryStatus[1] }}
                                    </span>
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-info mr-3"
                                   href="#">ویرایش</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
