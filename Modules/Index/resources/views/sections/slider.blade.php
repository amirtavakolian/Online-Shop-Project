<div class="slider-area section-padding-1">
    <div class="slider-active owl-carousel nav-style-1">
        @foreach($sliders as $slider)
            <div class="single-slider slider-height-1 bg-paleturquoise">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6 text-right">
                            <div class="slider-content slider-animated-1">
                                <h1 class="animated">{{ $slider->title }}</h1>
                                <p class="animated">{{ $slider->text }}</p>
                                <div class="slider-btn btn-hover">
                                    <a class="animated" href="{{ url($slider->button_link) }}">
                                        <i class="sli sli-basket-loaded"></i>
                                        فروشگاه
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-single-img slider-animated-1">
                                <img class="animated" src="{{ 'storage/'.$slider->image }}" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
