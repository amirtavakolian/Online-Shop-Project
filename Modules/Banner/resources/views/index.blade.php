@extends('panel::layouts.master')

    @section('content')
        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                <div class="mb-4 text-center text-md-right">
                    <h5 class="font-weight-bold">ایجاد بنر</h5>
                </div>
                <hr>
                @include('')
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="primary_image"> انتخاب تصویر </label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="banner_image">
                                <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="title">عنوان</label>
                            <input class="form-control" id="title" name="title" type="text" {{ old('title') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="text">متن</label>
                            <input class="form-control" id="text" name="text" type="text" {{ old('text') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="priority">الویت</label>
                            <input class="form-control" id="priority" name="priority" type="number" {{ old('priority') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="is_active">وضعیت</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیرفعال</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="type">نوع بنر</label>
                            <input class="form-control" id="type" name="type" type="text" {{ old('type') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="button_text">متن دکمه</label>
                            <input class="form-control" id="button_text" name="button_text" type="text" {{ old('button_text') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="button_link">لینک دکمه</label>
                            <input class="form-control" id="button_link" name="button_link" type="text" {{ old('button_link') }}>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="button_icon">آیکون دکمه</label>
                            <input class="form-control" id="button_icon" name="button_icon" type="text" {{ old('button_icon') }}>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </form>
            </div>
        </div>
@endsection
