@extends('panel::layouts.master')
@section('head')
    <link href="{{ asset('modules/category/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">

            @include('product::partials.messages')

            <form action='{{ route('product.category.update', ['product' => $product]) }}' method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">

                    {{-- Category&Attributes Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>دسته بندی و ویژگی ها : </p>
                    </div>

                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="category_id">دسته بندی</label>
                                <select id="categorySelect" name="category_id" class="form-control"
                                        data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }} -
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="attributesContainer" class="col-md-12">
                        <div id="attributes" class="row"></div>
                        <div class="col-md-12">
                            <hr>
                            <p>افزودن قیمت و موجودی برای متغیر <span class="font-weight-bold" id="variationName"></span>
                                :
                            </p>
                        </div>

                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>نام</label>
                                            <input class="form-control" name="variation_values[value][]" type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>قیمت</label>
                                            <input class="form-control" name="variation_values[price][]" type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>تعداد</label>
                                            <input class="form-control" name="variation_values[quantity][]" type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>شناسه انبار</label>
                                            <input class="form-control" name="variation_values[sku][]" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" name="attribute_id" class="variation_id">

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="#" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('modules/category/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('modules/product/js/czmore.js') }}"></script>
    <script>
        $("#czContainer").czMore();
    </script>
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

        // Show File Name
        $('#primary_image').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function () {
            let category = $(this).val();
            let route = `{{ route('product.category-attribute', ['category' => ':category']) }}`;
            route = route.replace(':category', category);
            $.get(route, function (response, status) {

                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attributes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });
                    $('#variationName').text(response.variation[0].name);
                    $('.variation_id').val(response.variation[0].id);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function () {
                alert('مشکل در دریافت لیست ویژگی ها');
            })
        });



    </script>
@endsection
