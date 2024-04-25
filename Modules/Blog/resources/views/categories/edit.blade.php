@extends('blog::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 w-100">
                <div class="single_post">

                    <form method="POST" action="{{ route('blog.categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="post_content text-center">
                                <div class="form-group">
                                    @include('blog::partials.messages')
                                    <label for="exampleInputEmail1">عنوان دسته بندی:</label>
                                    <input type="text" value="{{ $category->name }}" name="name" class="form-control ">
                                </div>
                                <input type="submit" value="ثبت دسته بندی" class="btn btn-danger mb-2">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
