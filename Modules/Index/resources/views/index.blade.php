<!DOCTYPE html>
<html class="no-js" lang="zxx">

@include('index::sections.head')

<body>
<div class="wrapper">

    @include('index::sections.header')
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
                                                <li>
                                                    <a href="#"><i class="sli sli-bag"></i><span
                                                            class="ht-product-action-tooltip"> افزودن به سبد خرید </span>
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

    <div class="testimonial-area pt-80 pb-95 section-margin-1" style="background-image: url('assets/a.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1">
                        <div class="single-testimonial text-center">
                            <img src="assets/img/testimonial/testi-1.png" alt=""/>
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
                        <a href="product-details.html"><img src="assets/img/banner/banner-4.png" alt=""/></a>
                        <div class="banner-content banner-position-3">
                            <h3>لورم ایپسوم</h3>
                            <h2>لورم ایپسوم <br/>متن </h2>
                            <a href="product-details.html">فروشگاه</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 text-right">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="product-details.html"><img src="assets/img/banner/banner-5.png" alt=""/></a>
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
                            <img src="assets/img/icon-img/free-shipping.png" alt=""/>
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
                            <img src="assets/img/icon-img/support.png" alt=""/>
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
                            <img src="assets/img/icon-img/security.png" alt=""/>
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

    <footer class="footer-area bg-paleturquoise" style="direction: rtl;">
        <div class="container">
            <div class="footer-top text-center pt-45 pb-45">
                <nav>
                    <ul>
                        <li><a href="index.html">صفحه ای اصلی </a></li>
                        <li><a href="shop.html">فروشگاه </a></li>
                        <li><a href="contact-us.html">تماس با ما </a></li>
                        <li><a href="about-us.html">ارتباط با ما </a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer-bottom border-top-1 pt-20">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="footer-social pb-20">
                            <a href="#">اینستاگرام</a>
                            <a href="#">تویتر</a>
                            <a href="#">فیسبوک</a>
                            <a href="#">لینکدین</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="copyright text-center pb-20">
                            <p>Copyright © WebProg.ir</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <div class="payment-mathod pb-20">
                            <a href="#"><img src="assets/img/icon-img/payment.png" alt=""/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Start Modal -->
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
    <!-- Modal end -->

</div>

@include('index::sections.scripts')
