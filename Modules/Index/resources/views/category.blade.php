@extends('index::layouts.master')

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('index.home') }}">صفحه ای اصلی</a>
                    </li>
                    <li class="active">فروشگاه</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse text-right">

                <!-- sidebar -->
                <div class="col-lg-3 order-2 order-sm-2 order-md-1">
                    <div class="sidebar-style mr-30">
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">جستجو </h4>
                            <div class="pro-sidebar-search mb-50 mt-25">
                                <form class="pro-sidebar-search-form" action="#">
                                    <input type="text" placeholder="... جستجو ">
                                    <button>
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title"> دسته بندی </h4>
                            <div class="sidebar-widget-list mt-30">
                                <ul>
                                    {{ $category->parent->name }}
                                    @foreach($category->parent->children as $childCategory)
                                        <li style="margin-right: 10%;">
                                            <a href="{{ route('index.categories', ['category' => $childCategory->slug]) }}"
                                               style="{{ $childCategory->id == $category->id ? 'color:red' : '' }}">
                                                {{ $childCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>
                        @foreach($attributes as $key => $attribute)
                            <div class="sidebar-widget mt-30">
                                <h4 class="pro-sidebar-title">{{ $key }}</h4>
                                <div class="sidebar-widget-list mt-20">
                                    <ul>
                                        @foreach($attribute as $attr)
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" value="{{ $attr }}"><a href="#">{{ $attr }}</a>
                                                    <span class="checkmark"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <!-- content -->
                <div class="col-lg-9 order-1 order-sm-1 order-md-2">
                    <!-- shop-top-bar -->
                    <div class="shop-top-bar" style="direction: rtl;">
                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select style="padding: 10px;">
                                    <option value=""> مرتب سازی</option>
                                    <option value=""> بیشترین قیمت</option>
                                    <option value=""> کم ترین قیمت</option>
                                    <option value=""> جدیدترین</option>
                                    <option value=""> قدیمی ترین</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">
                            <div class="row ht-products" style="direction: rtl;">
                                <!--Product Start-->
                                @foreach($category->products as $product)
                                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                        <div
                                            class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                            <div class="ht-product-inner">
                                                <div class="ht-product-image-wrap">
                                                    <a href="product-details.html" class="ht-product-image">
                                                        <img src="{{ asset('storage/'.$product->primary_image) }}"
                                                             alt="Universal Product Style"/>
                                                    </a>
                                                    <div class="ht-product-action">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal"
                                                                   data-target="#modal-{{ $product->id }}"><i
                                                                        class="sli sli-magnifier"></i><span
                                                                        class="ht-product-action-tooltip"> مشاهده سریع
                                                                </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-heart"></i><span
                                                                        class="ht-product-action-tooltip">
                                                                    افزودن به علاقه مندی ها </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-refresh"></i><span
                                                                        class="ht-product-action-tooltip">
                                                                    مقایسه </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-bag"></i><span
                                                                        class="ht-product-action-tooltip"> افزودن
                                                                    به سبد خرید </span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ht-product-content">
                                                    <div class="ht-product-content-inner">
                                                        <div class="ht-product-categories">
                                                            <a href="#">لورم</a>
                                                        </div>
                                                        <h4 class="ht-product-title text-right">
                                                            {{ $product->name }}
                                                        </h4>
                                                        @if($product->isInSaleDateRange())
                                                            <div class="ht-product-price">
                                                        <span class="new">
                                                            <b>{{ number_format($product->salePrice()) }} تومان </b>
                                                        </span>
                                                                <span class="old">
                                                            <b>{{ number_format($product->price()) }} تومان </b>
                                                        </span>
                                                            </div>
                                                        @else
                                                            <div class="ht-product-price">
                                                        <span
                                                            class="new"><b>{{ number_format($product->price()) }} تومان </b></span>
                                                            </div>
                                                        @endif
                                                        <div class="ht-product-ratting-wrap">
                                                        <span class="ht-product-ratting">
                                                            <span class="ht-product-user-ratting" style="width: 100%;">
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                            </span>
                                                            <i class="sli sli-star"></i>
                                                            <i class="sli sli-star"></i>
                                                            <i class="sli sli-star"></i>
                                                            <i class="sli sli-star"></i>
                                                            <i class="sli sli-star"></i>
                                                        </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Product End-->
                                @endforeach
                            </div>
                        </div>
                        <div class="pro-pagination-style text-center mt-30">
                            <ul class="d-flex justify-content-center">
                                <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($category->products as $product)
        <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                                <div class="product-details-content quickview-content">
                                    <h2 class="text-right mb-4">{{ $product->name }}</h2>
                                    @if($product->isInSaleDateRange())
                                        <div class="product-details-price">
                                            <span class="new">{{ number_format($product->salePrice()) }} تومان </span>
                                            <span class="old">{{ number_format($product->price()) }} تومان </span>
                                        </div>
                                    @else
                                        <div class="product-details-price">
                                            <span class="new">{{ number_format($product->price()) }} تومان </span>
                                        </div>
                                    @endif
                                    <div class="pro-details-rating-wrap">
                                        <div class="pro-details-rating">
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <span>3 دیدگاه</span>
                                    </div>
                                    <p class="text-right">{{ $product->description }}</p>
                                    <div class="pro-details-list text-right">
                                        <ul class="text-right">
                                            @foreach($product->attributes as $attribute)
                                                <li>{{ $attribute->name }} : {{ $attribute->pivot->value }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="pro-details-size-color text-right">
                                        <div class="pro-details-size">
                                            <span>{{ $product->variationAttribute->first()->name }}</span>
                                            <div class="pro-details-size-content">
                                                <ul>
                                                    @foreach($product->variationAttribute as $productVariation)
                                                        <li><a href="#">{{ $productVariation->pivot->value }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2"/>
                                        </div>
                                        <div class="pro-details-cart">
                                            <a href="#">افزودن به سبد خرید</a>
                                        </div>
                                        <div class="pro-details-wishlist">
                                            <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                        </div>
                                        <div class="pro-details-compare">
                                            <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-details-meta">
                                        <span>دسته بندی :</span>
                                        <ul>
                                            <li><a href="#">{{ $product->category->parent->name }},</a></li>
                                            <li><a href="#">{{ $product->category->name }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-meta">
                                        <span>تگ ها :</span>
                                        <ul>
                                            @foreach($product->tags as $tag)
                                                <li><a href="#">{{ $tag->name, }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="{{ asset('storage/'.$product->primary_image) }}" alt=""/>
                                    </div>

                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                        @foreach($product->images as $productImage)
                                            <a class="active" data-toggle="tab" href="#pro-1">
                                                <img src="{{ asset('storage/'.$productImage->image) }}" alt=""/>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
