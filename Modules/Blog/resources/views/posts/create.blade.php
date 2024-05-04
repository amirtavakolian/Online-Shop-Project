@extends('blog::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('modules/blog/css/persian-datepicker.min.css') }}">
@endsection
@section('content')
    <div class="single_post">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <form method="POST" action="{{ route('blog.posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8">
                    @include('blog::partials.messages')
                    <div class="post_content text-center">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان:</label>
                            <input type="text" name="title" class="form-control ">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">متن:</label>
                            <textarea class="form-control " name="content" id="content"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">دسته بندی:</label>
                            <select class="form-control " name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="exampleInputEmail1">آپلود عکس:</label>
                                    <input type="file" name="image_url" class="form-control ">
                                </div>
                                <div class="col-sm-4">
                                    <label for="exampleInputEmail1">نام عکس:</label>
                                    <input type="text" name="image_name" class="form-control ">
                                </div>
                                <div class="col-sm-4">
                                    <label for="exampleInputEmail1">دایرکتوری عکس:</label>
                                    <input type="text" name="image_directory" class="form-control ">
                                </div>
                            </div>
                            <br>
                            <input type="button" id="suggest-image" value="پیشنهاد عکس"
                                   class="btn btn-danger mb-2 form-control " style="width: 20% !important;">
                            <div class=container>
                                <div class="row" id="suggested-images">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">آپلود ویدیو:</label>
                            <input type="file" name="video_url" class="form-control ">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">لینک استریم ویدیو:</label>
                            <input type="text" name="stream_url" class="form-control ">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">پست پیشنهادی:</label>
                            <select class="form-control " name="related_post_id">
                                <option value=""></option>
                                @foreach($posts as $post)
                                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">زمان انتشار پست:</label>
                            <input type="text" class="form-control" id="published_at">
                            <input type="hidden" name="published_at" class="form-control" id="published_at_timestamp">
                        </div>
                        <label>محاسبه زمان مطالعه پست:</label>
                        <div class="form-inline ">
                            <button type="button" id="calculateText" class="btn btn-primary mb-2 form-control ">محاسبه
                            </button>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="time_to_read" class="form-control"
                                       placeholder="زمان مطالعه" id="time_to_read" readonly>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 3%">
                            <input type="checkbox" name="disable_comment">
                            <label for="exampleInputEmail1">بدون کامنت</label>
                        </div>

                        <input type="submit" value="ثبت پست" class="btn btn-danger mb-2 form-control ">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        let myEditor;
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                myEditor = editor; // Now the editor instance is saved to the variable
            })
            .catch(error => {
                console.error(error);
            });

        const calculateText = document.querySelector("#calculateText");
        calculateText.addEventListener("click", function () {
            const token = document.querySelector('meta[name="csrf-token"]').content;

            var editorData = myEditor.getData();
            var tempDiv = document.createElement("div");
            tempDiv.innerHTML = editorData;
            var plainText = tempDiv.textContent || tempDiv.innerText || "";

            var data = new FormData();
            data.append('text', plainText);

            const xhr = new XMLHttpRequest();
            let route = `{{ route('blog.post.text.calculate') }}`
            xhr.open('POST', route);
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.send(data)

            xhr.addEventListener('load', function () {
                time_to_read.value = Math.ceil(xhr.response);
            });
        });
    </script>
    <script>
        let suggestImageButton = document.querySelector('#suggest-image');
        suggestImageButton.addEventListener('click', function () {
            let titleInput = document.querySelector('input[name="title"]');
            if (titleInput.value != "") {
                let suggestImageButton = document.querySelector('#suggested-images');
                let imageView = ``;
                fetch('https://serpapi.com/search.json?engine=google_images&q=' + titleInput.value + '&api_key=fc974452803803f47b046cd3338fe2c3e2d59813321debf67d5c61fa203908a8')
                    .then(function (response) {
                        return response.json()
                    }).then(function (data) {
                    for (let i = 0; i <= 3; i++) {
                        imageView += `
                                <div class="col-sm-2">
                                    <img src="${data.images_results[Math.floor(Math.random() * 9) + 1].thumbnail}">
                                </div>
                       `
                    }
                    suggestImageButton.innerHTML = imageView;
                });
            } else {
                alert('فیلد عنوان خالی است');
                suggestImageButton.innerHTML = '';
            }

        })
    </script>
    <script src="{{ asset('modules/blog/js/persian-date.min.js') }}"></script>
    <script src="{{ asset('modules/blog/js/persian-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#published_at").pDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                altField: '#published_at_timestamp'
            });
        });
    </script>
    <script>
        published_at.addEventListener("change", function (){
            published_at_timestamp.value = "";

        });
    </script>
@endsection
