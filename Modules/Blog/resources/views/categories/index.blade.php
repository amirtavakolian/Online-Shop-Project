@extends('blog::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container-fluid">
        @include('blog::partials.messages')
        <div class="row">
            <div class="col-sm-6 w-100">
                <div class="single_post">
                    <div class="col-md-12">
                        <div class="post_content">
                            <table class="table table-striped" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>نام دسته بندی</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
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

                    <form method="POST" action="{{ route('blog.categories.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="post_content text-center">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">عنوان دسته بندی:</label>
                                    <input type="text" name="name" class="form-control ">
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
@section('script')
    <script>
        const table = document.getElementsByTagName('table');
        table[0].addEventListener('click', function (e) {
            if (e.target.hasAttribute('data-tag-id')) {
                e.preventDefault();
                if (confirm('آیا مطمئن هستید؟')) {
                    let route = `{{ route('blog.tags.destroy', ['tag' => ':tag']) }}`
                    route = route.replace(':tag', e.target.attributes[1].nodeValue);

                    const token = document.querySelector('meta[name="csrf-token"]').content;
                    const xhr = new XMLHttpRequest();
                    xhr.open('DELETE', route);
                    xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    xhr.send();

                    xhr.addEventListener('load', function (response) {
                        if (xhr.status == 200) {
                            window.location.reload();
                        }
                    });
                }
            }
        });
    </script>
@endsection
