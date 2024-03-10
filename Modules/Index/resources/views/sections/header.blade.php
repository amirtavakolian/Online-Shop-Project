<header class="header-area sticky-bar">
    <div class="main-header-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo pt-40">
                        <a href="index.html">
                            <h3 class="font-weight-bold">WebProg.ir</h3>
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li class="angle-shape">
                                    <a href="about_us.html"> ارتباط با ما </a>
                                </li>

                                <li><a href="contact-us.html"> تماس با ما </a></li>

                                <li class="angle-shape">
                                    <a href="shop.html"> فروشگاه </a>

                                    <ul class="mega-menu">
                                        @foreach($categories as $category)
                                        <li>
                                            <a class="menu-title" href="#">{{ $category->name }}</a>
                                            @foreach($category->children as $child)
                                                <ul>
                                                    <li><a href="#">{{ $child->name }}</a></li>
                                                </ul>
                                            @endforeach
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="angle-shape">
                                    <a href="index.html"> صفحه اصلی </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="header-right-wrap pt-40">
                        <div class="header-search">
                            <a class="search-active" href="#"><i class="sli sli-magnifier"></i></a>
                        </div>
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                    <span class="icon-cart">
                      <i class="sli sli-bag"></i>
                      <span class="count-style">02</span>
                    </span>


                                <span class="cart-price">
                      500,000
                    </span>
                                <span>تومان</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    <h4>سبد خرید</h4>
                                </div>
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 90.00</span>
                                        </div>

                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 9,000</span>
                                        </div>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div
                                        class="shopping-cart-total d-flex justify-content-between align-items-center"
                                        style="direction: rtl;">
                                        <h4>
                                            جمع کل :
                                        </h4>
                                        <span class="shop-total">
                          25,000 تومان
                        </span>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover text-center">
                                        <a class="default-btn" href="checkout.html">
                                            ثبت سفارش
                                        </a>
                                        <a class="default-btn" href="cart-page.html">
                                            سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="setting-wrap">
                            <button class="setting-active">
                                <i class="sli sli-settings"></i>
                            </button>
                            <div class="setting-content">
                                <ul class="text-right">
                                    <li><a href="login.html">ورود</a></li>
                                    <li>
                                        <a href="register.html">ایجاد حساب</a>
                                    </li>
                                    <li><a href="my-account.html">پروفایل</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-search start -->
        <div class="main-search-active">
            <div class="sidebar-search-icon">
                <button class="search-close">
                    <span class="sli sli-close"></span>
                </button>
            </div>
            <div class="sidebar-search-input">
                <form>
                    <div class="form-search">
                        <input id="search" class="input-text" value="" placeholder=" ...جستجو " type="search"/>
                        <button>
                            <i class="sli sli-magnifier"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="header-small-mobile">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a href="index.html">
                            <h4 class="font-weight-bold">WebProg.ir</h4>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                    <span class="icon-cart">
                      <i class="sli sli-bag"></i>
                      <span class="count-style">02</span>
                    </span>

                                <span class="cart-price">
                      500,000
                    </span>
                                <span>تومان</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    <h4>سبد خرید</h4>
                                </div>
                                <ul style="height: 400px;">
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 90.00</span>
                                        </div>

                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-1.svg"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 9,000</span>
                                        </div>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt="" src="assets/img/cart/cart-2.svg"/></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div
                                        class="shopping-cart-total d-flex justify-content-between align-items-center"
                                        style="direction: rtl;">
                                        <h4>
                                            جمع کل :
                                        </h4>
                                        <span class="shop-total">
                          25,000 تومان
                        </span>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover text-center">
                                        <a class="default-btn" href="checkout.html">
                                            ثبت سفارش
                                        </a>
                                        <a class="default-btn" href="cart-page.html">
                                            سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-off-canvas-active">
    <a class="mobile-aside-close">
        <i class="sli sli-close"></i>
    </a>

    <div class="header-mobile-aside-wrap">
        <div class="mobile-search">
            <form class="search-form" action="#">
                <input type="text" placeholder=" ... جستجو "/>
                <button class="button-search">
                    <i class="sli sli-magnifier"></i>
                </button>
            </form>
        </div>

        <div class="mobile-menu-wrap">
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu text-right">
                        <li class="menu-item-has-children">
                            <a href="index.html"> صفحه ای اصلی </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="shop.html">فروشگاه</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children">
                                    <a href="#">مردانه</a>
                                    <ul class="dropdown">
                                        <li><a href="shop.html"> پیراهن </a></li>
                                        <li>
                                            <a href="#"> تی شرت </a>
                                        </li>
                                        <li>
                                            <a href="#"> پالتو </a>
                                        </li>
                                        <li>
                                            <a href="#"> لباس راحتی </a>
                                        </li>
                                        <li>
                                            <a href="#">لباس زیر</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">زنانه</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="product-details.html"> مانتو </a>
                                        </li>
                                        <li>
                                            <a href="#"> شومیز </a>
                                        </li>
                                        <li>
                                            <a href="#"> دامن </a>
                                        </li>
                                        <li>
                                            <a href="#">پالتو </a>
                                        </li>
                                        <li>
                                            <a href="#">لباس راحتی</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#"> بچه گانه </a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="#"> ست لباس </a>
                                        </li>
                                        <li>
                                            <a href="#"> شلوارک </a>
                                        </li>
                                        <li>
                                            <a href="#"> ژاکت </a>
                                        </li>
                                        <li>
                                            <a href="#"> ست نوزاد </a>
                                        </li>
                                        <li>
                                            <a href="#"> پیراهن </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><a href="contact-us.html">تماس با ما</a></li>

                        <li><a href="about_us.html"> در باره ما</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->
        </div>

        <div class="mobile-curr-lang-wrap">
            <div class="single-mobile-curr-lang">
                <ul class="text-right">
                    <li class="my-3"><a href="login.html"> ورود </a></li>
                    <li class="my-3">
                        <a href="register.html"> ایجاد حساب </a>
                    </li>
                    <li class="my-3"><a href="my-account.html"> پروفایل </a></li>
                </ul>
            </div>
        </div>

        <div class="mobile-social-wrap text-center">
            <a class="facebook" href="#"><i class="sli sli-social-facebook"></i></a>
            <a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a>
            <a class="pinterest" href="#"><i class="sli sli-social-pinterest"></i></a>
            <a class="instagram" href="#"><i class="sli sli-social-instagram"></i></a>
            <a class="google" href="#"><i class="sli sli-social-google"></i></a>
        </div>
    </div>
</div>
