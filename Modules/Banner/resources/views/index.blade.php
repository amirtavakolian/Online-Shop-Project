@extends('panel::layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست برند ها ({{ $banners->count() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('panel.banners.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد بنر
                </a>
            </div>
            @include('banner::partials.messages')
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th>متن</th>
                        <th>الویت</th>
                        <th>وضعیت</th>
                        <th>نوع</th>
                        <th>متن دکمه</th>
                        <th>لینک دکمه</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <th>
                                {{ $loop->index+=1 }}
                            </th>
                            <th>
                                <img width="60px" height="40px" src="{{ asset('storage/' . $banner->image) }}">
                            </th>
                            <th>
                                {{ $banner->title }}
                            </th>
                            <th>
                                {{ $banner->text }}
                            </th>
                            <th>
                                {{ $banner->priority }}
                            </th>
                            <th>
                                    <span
                                        class="{{ $banner->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $banner->is_active }}
                                    </span>
                            </th>
                            <th>
                                {{ $banner->button_text }}
                            </th>
                            <th>
                                {{ $banner->button_link }}
                            </th>
                            <th>
                                {{ $banner->type }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-info mr-3"
                                   href="{{ route('panel.banners.edit', ['banner' => $banner]) }}">ویرایش</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
