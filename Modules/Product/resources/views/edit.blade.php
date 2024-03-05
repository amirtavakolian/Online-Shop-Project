@extends('panel::layouts.master')

@section('title')
    edit products
@endsection
@section('head')
    <link href="{{ asset('modules/category/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('modules/product/css/datetimepicker.css') }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ویرایش تگ </h5>
            </div>
            <hr>
            @include('product::partials.messages')
            <form action="{{ route('product.update', ['product' => $product]) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $product->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select id="brandSelect" name="brand_id" class="form-control" data-live-search="true">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->isSelected($product->brand->id) }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $product->isProductActive() }}>فعال</option>
                            <option value="0" {{ $product->isProductActive() }}>غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select id="tagSelect" name="tag_ids[]" class="form-control" multiple data-live-search="true">
                            @foreach($tags as $tag)
                                <option
                                    value="{{ $tag->id }}" {{ $product->isTagSelected($tag->id) }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <p>هزینه ارسال : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount">هزینه ارسال</label>
                        <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                               value="{{ $product->delivery_amount }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                        <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product"
                               type="text" value="{{ $product->delivery_amount_per_product }}">
                    </div>

                    {{-- Attributes & Variations --}}
                    <div class="col-md-12">
                        <hr>
                        <p>ویژگی ها : </p>
                    </div>

                    @foreach($product->attributes()->withPivot('value')->get() as $attribute)
                        <div class="form-group col-md-3">
                            <label>{{ $attribute->name }}</label>
                            <input class="form-control" type="text" name="attribute_values[{{ $attribute->id }}][value]"
                                   value="{{ $attribute->pivot->value }}">
                        </div>
                    @endforeach
                    @foreach($product->variationAttribute as $key => $variation)
                        <div class="col-md-12">
                            <hr>
                            <div class="d-flex">
                                <p class="mb-0"> قیمت و موجودی برای متغیر {{ $variation->name }}
                                    : {{ $variation->pivot->value }}</p>
                                <p class="mb-0 mr-3">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                            data-target="#collapse-{{ $variation->pivot->id }}">
                                        نمایش
                                    </button>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="collapse mt-2" id="collapse-{{ $variation->pivot->id }}">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label> قیمت </label>
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $key }}][price]"
                                                   value="{{ $variation->pivot->price }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label> تعداد </label>
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $key }}][quantity]"
                                                   value="{{ $variation->pivot->quantity }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> sku </label>
                                            <input type="text" class="form-control"
                                                   name="variation_values[{{ $key }}][sku]"
                                                   value="{{ $variation->pivot->sku }}">
                                        </div>

                                        {{-- Sale Section --}}
                                        <div class="col-md-12">
                                            <p> حراج : </p>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> قیمت حراجی </label>
                                            <input type="text" name="variation_values[{{ $key }}][sale_price]"
                                                   value="" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تاریخ شروع حراجی </label>
                                            <input type="text"
                                                   name="variation_values[{{ $key }}][date_on_sale_from]"
                                                   value=""
                                                   class="form-control"
                                                   id="variationDateOnSaleFrom{{ $variation->pivot->id }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تاریخ پایان حراجی </label>
                                            <input type="text"
                                                   name="variation_values[{{ $key }}][date_on_sale_to]"
                                                   value=""
                                                   class="form-control"
                                                   id="variationDateOnSaleTo{{ $variation->pivot->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="attirbute_id" value="{{ $product->variationAttribute->first()->id }}">
                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('modules/category/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('modules/product/js/czmore.js') }}"></script>
    <script>
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });
    </script>
    <script src="{{ asset('modules/product/js/datetimepicker.js') }}"></script>
    <script>
        let f = @json($product->variationAttribute);
        f.forEach((c) => {
            $(`#variationDateOnSaleFrom${c.pivot.id}`).MdPersianDateTimePicker({
                targetTextSelector: `#variationDateOnSaleFrom${c.pivot.id}`,
                targetDateSelector: `#variationDateOnSaleFrom${c.pivot.id}`,
                dateFormat	: "yyyy-MM-dd HH:mm:ss"
            });
            $(`#variationDateOnSaleTo${c.pivot.id}`).MdPersianDateTimePicker({
                targetTextSelector: `#variationDateOnSaleTo${c.pivot.id}`,
                targetDateSelector: `#variationDateOnSaleTo${c.pivot.id}`,
                dateFormat	: "yyyy-MM-dd HH:mm:ss"
            });
        });

    </script>
@endsection

