<html>
<head>
    <link rel="stylesheet" href="{{ asset('modules/blog/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/style.css') }}">
</head>
<body>
<div class="top-bar">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="search-btn">
                <span><i class="fa fa-search"></i></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="top-cat-box">
                <div class="col-md-12">
                    <div class="menu">
                        <ul>
                            <li><a href="#">تماس با ما</a></li>
                            <li><a href="#">درباره ما</a></li>
                            <li><a href="#">مقالات</a></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                   <div class="show-cat">
                       <span>
                           دسته ها
                           <i class="fa fa-bars"></i>
                       </span>
                   </div>
                   </div> -->
            </div>
        </div>
    </div>
</div>
<div class="main-header">
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="main-menu">
                <ul>
                    <li><a href="#">اتاق خبر</a></li>
                    <li><a href="#">اقتصادی</a></li>
                    <li><a href="#">انجمن</a></li>
                    <li><a href="#">گروه رسانه ای</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="social-box">
                <ul>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clear-fix"></div>
@yield('content')
<div class="clear-fix"></div>
<div class="footer">
    <div class="container-fluid">
        <div class="col-md-5">
            <div class="footer-box">
                <span class="title">مجله seo90</span>
                <p>متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت متن ساختگی با تولید سادگی نامفهوم تولید
                    سادگی از صنعت متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت متن ساختگی با تولید سادگی از
                    صنعت متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت متن ساختگی با تولید سادگی نامفهوم
                    تولید سادگی از صنعت متن ساختگی بام تولید سادگی از صنعت متن ساختگی با تولید سادگی نامفهوم تولید
                    سادگی از صنعت متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت متن سادگی نامفهوم تولید
                    سادگی از صنعت
                </p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="footer-box">
                <span class="title">دسترسی سریع</span>
                <ul>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">قوانین</a></li>
                    <li><a href="#">نشریات</a></li>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">خبرنامه</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="footer-box">
                <span class="title">موضوعی</span>
                <ul>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">قوانین</a></li>
                    <li><a href="#">نشریات</a></li>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">خبرنامه</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-box contact-box">
                <span class="title">تماس با ما</span>
                <p><i class="fa fa-phone"></i> 09028468446</p>
                <p><i class="fa fa-phone"></i> 09336636892</p>
                <p><i class="fa fa-envelope-o"></i> info@seo90.ir</p>
                <p><i class="fa fa-map-marker"></i> تبریز </p>
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>
</div>
<div class="end-wrapper">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="copy-r">
                <p>&copy; تمامی حقوق متعلق به سئو 90 می باشد</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="creator text-left">
                <p>طراحی سایت ، سئو 90</p>
            </div>
        </div>
    </div>
</div>
<div class="bg"></div>
<script src="{{ asset('modules/blog/js/jquery.js') }}"></script>
<script src="{{ asset('modules/blog/js/bootstrap.js') }}"></script>
<script src="{{ asset('modules/blog/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('modules/blog/js/index.js') }}"></script>
@yield('script')
</body>
</html>




