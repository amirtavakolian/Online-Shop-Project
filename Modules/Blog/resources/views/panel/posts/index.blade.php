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
                    <a href="{{ route('blog.posts.create') }}" class="btn btn-success">ایجاد پست جدید</a>
                    <br><br>
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
                            <th scope="col">حذف</th>
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
                                <td><a href="{{ route('blog.posts.destroy', ['post' => $post->id]) }}"
                                       data-post-id="{{ $post->id }}">حذف</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let table = document.querySelector("table");
        table.addEventListener("click", function (e) {
            if (e.target.hasAttribute('data-post-id')) {
                if (confirm('آیا مطمئن هستید؟')) {
                    e.preventDefault();
                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    let route = `{{ route('blog.posts.destroy', ['post' => ':post']) }}`;
                    route = route.replace(':post', e.target.getAttribute('data-post-id'));

                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', route);
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    xhr.send();

                    xhr.addEventListener("load", function () {
                        window.location.reload();
                    });
                }
            }
        })
    </script>

@endsection
