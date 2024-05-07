@php use Carbon\Carbon; @endphp
@extends('blog::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="top-sidebar-r">
                    <span class="title">پست های جدید</span>
                    @foreach($posts->sortByDesc('created_at')->take(4) as $post)
                        <a href="#">
                            <div class="bx">
                                <div class="col-md-6">
                                    <div class="img-box">
                                        <figure>
                                            <img style="object-fit: fill" src="{{ asset('storage/'.$post->image_url) }}" alt="">
                                            <figcaption><span>1</span></figcaption>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="meta">
                                        <h6>{{ $post->title }}</h6>
                                        <span><i class="fa fa-clock-o"></i>{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                        <div class="text-left">
                                            <sub><i class="fa fa-comment"></i> 26</sub>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-slider-box">
                    <div class="owl-carousel owl-theme main-slider">
                        @foreach($posts->sortByDesc('created_at')->take(4) as $post)
                            <div class="item">
                                <figure>
                                    <img style="object-fit: fill" src="{{ asset('storage/'.$post->image_url) }}" alt="">
                                    <figcaption class="gradient-fig"></figcaption>
                                    <figcaption class="desc-fig">
                                        <span><i class="fa fa-heart"></i> 56</span>
                                        <h3 style="color: red">{{ $post->title }}</h3>
                                        <span><i class="fa fa-clock-o"></i>{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>

                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="top-sidebar-l">
                    <span class="title">یادداشت</span>
                    <a href="#">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span><i class="fa fa-heart"></i> 56</span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>رم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است. چاپگرها و متو
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span><i class="fa fa-heart"></i> 78</span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>رم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است. چاپگرها و متو
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span><i class="fa fa-heart"></i> 321</span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>رم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است. چاپگرها و متو
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span><i class="fa fa-heart"></i> 56</span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>رم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است. چاپگرها و متو
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span><i class="fa fa-heart"></i> 56</span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>رم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک
                                    است. چاپگرها و متو
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-fix"></div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="content-wrapper">
                        <div class="most-views">
                            <span class="title">مطالب پربازدید</span>
                            <div class="col-md-8">
                                <div class="main-post">
                                    @foreach($posts->sortByDesc('view')->take(1) as $post)
                                        <a href="#">
                                            <figure>
                                                <img style="object-fit: fill" src="{{ asset('storage/'.$post->image_url) }}" alt="">
                                                <figcaption>
                                                    <h3>{{ $post->title }}</h3>
                                                    <span><i class="fa fa-comments-o"></i> 65</span>
                                                </figcaption>
                                            </figure>
                                            <div class="p-div">
                                                <p>{{ $post->content }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="oth-posts">
                                    @foreach($posts->sortByDesc('view')->take(3) as $post)
                                        <div class="r-box">
                                            @foreach($post->tags as $tag)
                                                <span class="cat-span">{{ $tag->name }}</span>
                                            @endforeach
                                            <a href="#">
                                                <h5>{{ $post->title }}</h5>
                                            </a>
                                            <span><i class="fa fa-clock-o"></i>{{ $post->created_at }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="l-sidebar">
                        <div class="cat-sidebar">
                            <span class="title">دسته بندی مطالب</span>
                            <div class="text-left"><i class="fa fa-folder-o"></i></div>
                            <ul>
                                @foreach($categoryPostsCount as $count)
                                    <li><a href="#">{{ $count->name }}</a><span>{{ $count->posts_count }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="latest-posts">
            <div class="container-fluid">
                <div class="blog-title-span">
                    <span class="title">آخرین مطالب</span>
                </div>
                @foreach($posts->sortByDesc('created_at')->take(8) as $post)
                    <div class="col-md-3">
                        <div class="post-box">
                            <a href="#">
                                <figure>
                                    <img style="object-fit: fill" src="{{ asset('storage/'.$post->image_url) }}" alt="">
                                    <figcaption class="meta-fig">
                                        <span><i class="fa fa-clock-o"></i> {{ $post->created_at }}</span>&nbsp;
                                        <span><i class="fa fa-comment-o"></i> 12</span>
                                    </figcaption>
                                    <figcaption class="view">
                                        @foreach($post->tags as $tag)
                                            <span>{{ $tag->name }}</span>
                                        @endforeach
                                    </figcaption>
                                </figure>
                                <div class="text-p">
                                    <h5>{{ $post->title }}</h5>
                                    <p>
                                        {{ $post->content }}
                                    </p>
                                    <div class="text-rigt">
                                        <a href="#">ادامه ...</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

