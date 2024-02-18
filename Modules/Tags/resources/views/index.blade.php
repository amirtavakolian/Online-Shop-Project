@extends('panel::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">

                <h5 class="font-weight-bold">لیست تگ ها ({{ $attributesCount }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="#">

                    <i class="fa fa-plus"></i>
                    ایجاد تگ
                </a>
            </div>

            @include('attributes::partials.messages')

            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($attributes as $attribute)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $attribute->name }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-success mr-3" href="#">ویرایش</a>
                                <a class="btn btn-sm btn-danger mr-3" href="#">حذف</a>
                                <a class="btn btn-sm btn-success mr-3"
                                   href="{{ route('attributes.edit', ['attribute'=>$attribute->id]) }}">ویرایش</a>
                                <a class="btn btn-sm btn-danger mr-3" data-attribute-id="{{ $attribute->id }}" href="#">حذف</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<<<<<<< HEAD
=======
@endsection

@section('scripts')
    <script>
        const action = document.querySelector('tbody');
        action.addEventListener("click", function (e) {
            if (e.target.hasAttribute('data-attribute-id')) {
                e.preventDefault();
                if (confirm('آیا مطمئن هستید؟')) {
                    {
                        let route = '{{route('attributes.destroy', ['attribute'=>':attribute'])}}'
                        route = route.replace(':attribute', e.target.attributes[1].value);
                        const xhr = new XMLHttpRequest();
                        xhr.open('DELETE', route);
                        const token = document.querySelector('meta[name="csrf-token"]').content;
                        xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        xhr.send();
                        xhr.addEventListener('load', function (response) {
                            if (response.srcElement.status == 200) {
                                window.location.reload();
                            }
                        })
                    }
                }
            }
        });
    </script>
>>>>>>> feature/AttributeModule
@endsection

