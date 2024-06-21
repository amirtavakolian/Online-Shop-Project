@extends('panel::layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست محصولات ها ({{ $products->count() }})</h5>
                @include('product::partials.messages')
                <div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('product.create') }}">
                        <i class="fa fa-plus"></i>
                        ایجاد محصول
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام برند</th>
                        <th>نام دسته بندی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th>
                                {{ $loop->index+=1 }}
                            </th>
                            <th>
                                {{ $product->name }}
                            </th>
                            <th>{{ $product->brand->name }}</th>
                            <th>
                                {{ $product->category->name }}
                            </th>
                            <th>
                                <span
                                    class="{{ $product->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                    {{ $product->productActiveStatus }}
                                </span>
                            </th>
                            <th>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        عملیات
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                           class="dropdown-item text-right"> ویرایش محصول </a>

                                        <a href="{{ route('product.images.edit', ['product' => $product->id]) }}"
                                           class="dropdown-item text-right"> ویرایش تصاویر </a>

                                        <a href="{{ route('product.category.edit', ['product' => $product->id]) }}"
                                           class="dropdown-item text-right"> ویرایش دسته بندی و ویژگی </a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
