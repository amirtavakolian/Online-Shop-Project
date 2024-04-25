@extends('blog::layouts.master')

@section('content')
    <div class="single_post">
        <div class="container-fluid">
            <div class="col-md-2"></div>
            <form method="POST" action="{{ route('blog.store') }}">
                @csrf
                <div class="col-md-8">
                    <div class="post_content text-center">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان:</label>
                            <input type="email" name="title" class="form-control ">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">متن:</label>
                            <textarea class="form-control " name="content" id="content"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">دسته بندی:</label>
                            <select class="form-control " name="category_id">
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">آپلود عکس:</label>
                            <input type="file" name="image_url" class="form-control ">
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
                            <select class="form-control " name="related_post_slug">
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">زمان انتشار پست:</label>
                            <input type="text" name="published_at" class="form-control ">
                        </div>
                        <label>محاسبه زمان مطالعه پست:</label>
                        <div class="form-inline ">
                            <button type="submit" class="btn btn-primary mb-2 form-control ">محاسبه</button>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="time_to_read" class="form-control " id="inputPassword2"
                                       placeholder="زمان مطالعه" readonly>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 3%">
                            <input type="checkbox" name="allow_comment">
                            <label for="exampleInputEmail1">امکان ثبت کامنت</label>
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
        ClassicEditor.create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
