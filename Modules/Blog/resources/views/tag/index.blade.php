@extends('blog::layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 w-100">
                <div class="single_post">
                    <div class="col-md-12">
                        <div class="post_content">
                            <table class="table table-striped" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>نام تگ</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <a href="#">ویرایش</a>
                                            <a href="#">حذف</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 w-100">
                <div class="single_post">

                    <form method="POST" action="{{ route('blog.tags.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="post_content text-center">
                                <div class="form-group">
                                    @include('blog::partials.messages')
                                    <label for="exampleInputEmail1">عنوان تگ:</label>
                                    <input type="text" name="name" class="form-control ">
                                </div>
                                <input type="submit" value="ثبت تگ" class="btn btn-danger mb-2">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
