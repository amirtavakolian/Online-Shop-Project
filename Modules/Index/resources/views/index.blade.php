@extends('index::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    @include('index::sections.slider')

    <div class="banner-area pt-100 pb-65">
        <div class="container">
            <div class="row">
                @foreach($indexTopBanners as $indexTopBanner)
                    <div class="col-lg-4 col-md-4">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="{{ url($indexTopBanner->button_link) }}">
                                <img class="animated" src="{{ asset('storage/'.$indexTopBanner->image) }}" alt=""/>
                            </a>
                            <div class="banner-content-2 banner-position-5">
                                <h4>{{ $indexTopBanner->title }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($indexBottomBanners as $indexBottomBanner)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="{{ $indexBottomBanner->button_link }}">
                                <img class="animated" src="{{ asset('storage/'.$indexBottomBanner->image) }}" alt=""/>
                            </a>
                            <div class="banner-content banner-position-6 text-right">
                                <h3>{{ $indexBottomBanner->title }}</h3>
                                <h2>{{ $indexBottomBanner->text }}</h2>
                                <a href="{{ $indexBottomBanner->button_link }}">{{ $indexTopBanner->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="product-tab-list nav pb-60 text-center flex-row-reverse">
                <h3>محصولات</h3>
            </div>
            <div class="tab-content jump-2">
                <div id="product-2" class="tab-pane active">
                    <div class="ht-products product-slider-active owl-carousel">
                        <!--Product Start-->
                        @foreach($products as $product)
                            <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                <div class="ht-product-inner">
                                    <div class="ht-product-image-wrap">
                                        <a href="#" class="ht-product-image">
                                            <img src="{{ asset('storage/'.$product->primary_image) }}"
                                                 alt="Universal Product Style"/>
                                        </a>
                                        <div class="ht-product-action">
                                            <ul>
                                                <li>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#modal-{{ $product->id }}"><i
                                                            class="sli sli-magnifier"></i><span
                                                            class="ht-product-action-tooltip"> مشاهده سریع</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="sli sli-heart"></i><span
                                                            class="ht-product-action-tooltip"> افزودن به علاقه مندی ها </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="sli sli-refresh"></i><span
                                                            class="ht-product-action-tooltip"> مقایسه</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ht-product-content">
                                        <div class="ht-product-content-inner">
                                            <div class="ht-product-categories">
                                                <a href="#">لورم </a>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Modal -->
    <div id="start-modal">

        @foreach($products as $product)
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
                                                <span
                                                    class="new">{{ number_format($product->salePrice()) }} تومان </span>
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
                                        <div class="pro-details-size-color text-right" id="cart-section">
                                            <div class="pro-details-size">
                                            <span>
                                                {{ $product->variationAttribute->first()->name }}
                                            </span>
                                                <div class="pro-details-size-content">
                                                    <ul>
                                                        @foreach($product->variationAttribute as $productVariation)
                                                            <li>
                                                                <a href="#"
                                                                   data-variant-id="{{ $productVariation->pivot->id }}">
                                                                    {{ $productVariation->pivot->value }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pro-details-quality">

                                            <div class="pro-details-cart">
                                                <a href="#" class="cart btn btn-danger">افزودن به سبد خرید</a>
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
                                            @foreach($product->tags as $tag)
                                                <a href="#">#{{ $tag->name }} </a>
                                            @endforeach
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
        <input type="hidden" id="selected-variant">
        <!-- Modal end -->
    </div>

    <div class="testimonial-area pt-80 pb-95 section-margin-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1">
                        <div class="single-testimonial text-center">
                            <img src="" alt=""/>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است. چاپگرها و
                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و
                                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد
                                گذشته، حال و
                                آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 text-right">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.html"><img src="" alt=""/></a>
                        <div class="banner-content banner-position-3">
                            <h3>لورم ایپسوم</h3>
                            <h2>لورم ایپسوم <br/>متن </h2>
                            <a href="product-details.html">فروشگاه</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.html"><img src="" alt=""/></a>
                        <div class="banner-content banner-position-4">
                            <h3>لورم ایپسوم</h3>
                            <h2>لورم ایپسوم </h2>
                            <a href="product-details.html">فروشگاه</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="feature-area" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>24x7 لورم ایپسوم</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="" alt=""/>
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const addToCartSection = document.querySelector("#start-modal");
        const selectedVariant = document.querySelector("#selected-variant");
        const token = document.querySelector('meta[name="csrf-token"]').content;

        window.addEventListener('load', function () {
            loadCartItems();
        })
        addToCartSection.addEventListener("click", function (e) {
            e.preventDefault();
            if (e.target.hasAttribute('data-variant-id')) {
                selectedVariant.value = e.target.attributes[1].nodeValue;
            }
        });
        addToCartSection.addEventListener("click", function (e) {
            if (e.target.classList.contains('cart')) {
                e.preventDefault();
                if (selectedVariant.value == "") {
                    alert("لطفا یکی از مقادیر بالا رو انتخاب کنید")
                } else {
                    console.log(selectedVariant.value)
                    let formData = new FormData()
                    formData.set('variant_id', selectedVariant.value)
                    const xhr = new XMLHttpRequest();
                    let route = `{{ route('cart.add') }}`
                    xhr.open("POST", route)
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    xhr.send(formData)
                    console.log(xhr);
                    xhr.onload = function () {
                        if (this.status == 200) {
                            alert('محصول به سبد خرید شما اضافه شد')
                            const cartItemsCount = document.querySelector('span[class="count-style"]');
                            setCartItemsCountBadge(this.response);
                            loadCartItems();
                        }
                    }
                }
            }
        });

        function setCartItemsCountBadge(items) {
            const cartItemsCount = document.querySelector('span[class="count-style"]');
            cartItemsCount.innerText = Object.keys(JSON.parse(items).data).length;
        }

        function loadCartItems() {
            const cartItemsXhr = new XMLHttpRequest();
            cartItemsXhr.open('GET', `{{ route('cart.items') }}`);
            cartItemsXhr.send();

            cartItemsXhr.onload = function () {

                if (JSON.parse(this.response).data != null) {
                    setCartItemsCountBadge(this.response);

                    let cartItemsSidebar = document.querySelector("#cartItemsHeader");
                    let totalPriceSection = document.querySelector(".shop-total");
                    let cartItems = JSON.parse(this.response);
                    let cart;
                    let totalAmount = 0;

                    for (item in cartItems.data) {
                        cart += `
                    <li class="single-shopping-cart">
                        <div class="shopping-cart-title">
                            <h4><a href="#"> ${cartItems.data[item].name} </a></h4>
                            </div>

                         <div class="shopping-cart-img">
                             <a href="#">
                                <img alt="" src="${cartItems.data[item].image}"  style="width: 60px; height: 60px;"/>
                             </a>
                             <div class="item-close">
                                <a href="#"><i class="sli sli-close"></i></a>
                             </div>
                         </div>
                    </li>`
                    }
                    cartItemsSidebar.innerHTML = cart;
                    // totalPriceSection.innerHTML = totalAmount.toLocaleString() + " تومان";
                }
            }
        }
    </script>
@endsection
