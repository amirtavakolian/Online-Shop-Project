@extends('blog::layouts.master')

@section('content')
    <div class="single_post">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="post_img">
                            <img src="{{ asset('storage/'.$post->image_url) }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="posts_meta text-center">
                    <span><i class="fa fa-comment-o"></i> 25 نظر</span>
                    <span><i class="fa fa-archive"></i> {{ $post->category->name }}</span>
                    <span><i class="fa fa-calendar"></i> {{ $post->created_at }}</span>
                </div>
                <div class="post_content">
                    <h4>{{ $post->title }}</h4>
                    <p>
                        {!!  $post->content !!}
                    </p>
                </div>
                @if($post->disable_comment == 1)
                    <div class="alert alert-danger">
                        <p>ثبت کامنت غیر فعال است</p>
                    </div>
                @else
                    <div class="comments_form">
                        <h5>دیدگاه شما </h5>
                        @guest()
                            <div class="alert alert-danger">
                                <p>جهت ثبت کامنت لطفا <a href="{{ route('login.index') }}">وارد شوید</a> </p>
                            </div>
                        @else
                            <form>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <input type="text" value="{{ auth()->user()->name }}" class="form-control" placeholder="نام شما">
                                    </div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="نظر شما ..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-left">
                                            <button class="btn btn-primary">ثبت نظر</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endguest
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
