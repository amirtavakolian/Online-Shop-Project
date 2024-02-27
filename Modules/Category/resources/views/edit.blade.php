@extends('panel::layouts.master')
@section('head')
    <link href="{{ asset('modules/category/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد دسته بندی</h5>
            </div>
            <hr>
            @include('category::partials.messages')
            <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" value="{{ $category->name }}" name="name" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="slug">نام انگلیسی</label>
                        <input class="form-control" id="slug" value="{{ $category->slug }}" name="slug" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="parent_id">والد</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="" {{ $category->isParentIdNull() }}>بدون والد</option>
                            @foreach($categories as $currerntCategory)
                                <option
                                    value="{{ $currerntCategory->id }}" {{ $category->isItemSelected($currerntCategory->id) }}>
                                    {{ $currerntCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ $category->is_active != 1 ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="attribute_ids">ویژگی</label>
                        <select id="attributeSelect" name="attribute_ids[]" class="form-control attributeSelect"
                                multiple>
                            @foreach($attributes as $attribute)
                                <option
                                    value="{{ $attribute->id }}">
                                    {{ $attribute->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="attribute_is_filter_ids">انتخاب ویژگی های قابل فیلتر</label>
                        <select id="attributeIsFilterSelect" name="attribute_is_filter_ids[]"
                                class="form-control attributeSelect" multiple
                                data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="variationSelect">انتخاب ویژگی متغیر</label>
                        <select id="variationSelect" name="variation_id" class="form-control attributeSelect"
                                data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="icon">آیکون</label>
                        <input class="form-control" id="icon" name="icon" type="text">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description">
                            {{ $category->description }}
                        </textarea>
                    </div>

                </div>
                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="#" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('modules/category/js/bootstrap-select.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#attributeSelect').selectpicker();
            $('#attributeIsFilterSelect').selectpicker();
            $('#variationSelect').selectpicker();

            $('#attributeSelect').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var selectedOption = $(this).find('option').eq(clickedIndex);
                var optionValue = selectedOption.val();
                var optionText = selectedOption.text();
                var newOption = $('<option>', {
                    value: optionValue,
                    text: optionText
                });
                $('#attributeIsFilterSelect').append(newOption);
                $('#attributeIsFilterSelect').selectpicker('refresh');
            });

            $('#attributeIsFilterSelect').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                $('#variationSelect').empty();
                $('#attributeIsFilterSelect option').each(function (index, option) {
                    if (!$(option).prop('selected')) {
                        $('#variationSelect').append($(option).clone());
                        $('#variationSelect').selectpicker('refresh');
                    }
                });
            });
        });
    </script>
@endsection
