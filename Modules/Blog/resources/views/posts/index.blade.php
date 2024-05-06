@extends('blog::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <div class="single_post">
        <div class="container-fluid">
            <div class="col-md-12">
                @include('blog::partials.messages')
                <div class="post_content text-center">
                    <table class="table table-bordered" style="text-align: center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان</th>
                            <th scope="col">متن</th>
                            <th scope="col">زمان مطالعه</th>
                            <th scope="col">نویسنده</th>
                            <th scope="col">تعداد بازدید</th>
                            <th scope="col">عکس</th>
                            <th scope="col">ویدیو</th>
                            <th scope="col">لینک یوتیوب</th>
                            <th scope="col">پست مرتبط</th>
                            <th scope="col">ثبت کامنت</th>
                            <th scope="col">تاریخ انتشار پست</th>
                            <th scope="col">دسته بندی</th>
                            <th scope="col">تاریخ ایجاد پست</th>
                            <th scope="col">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ substr($post->content, 3, 30)}}</td>
                                <td>{{ $post->time_to_read }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->view }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$post->image_url) }}" width="110px" height="80px">
                                </td>
                                <td>{{ $post->video_url ?? 'ندارد' }}</td>
                                <td>{{ $post->stream_url ?? 'ندارد' }}</td>
                                <td>{{ $post->relatedPost->title ?? 'ندارد' }}</td>
                                <td>{{ $post->disable_comment ? 'غیر فعال':'فعال' }}</td>
                                <td>{{ $post->published_at ?? 'ندارد'}}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td><a href="{{ route('blog.posts.edit', ['post' => $post->id]) }}">ویرایش</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

