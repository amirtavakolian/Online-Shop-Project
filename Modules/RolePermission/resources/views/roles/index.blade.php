@extends('panel::layouts.master')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="d-flex justify-content-between mb-4">

                <h5 class="font-weight-bold">لیست نقش های کاربری({{ $roles->count() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('roles.create') }}">

                    <i class="fa fa-plus"></i>
                    ایجاد نقش کاربری
                </a>
            </div>
            @include('attributes::partials.messages')
            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>اسلاگ</th>
                        <th>سطوح دسترسی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <th>
                                {{ $loop->index+1 }}
                            </th>
                            <th>
                                {{ $role->name }}
                            </th>
                            <th>
                                {{ $role->slug }}
                            </th>
                            <th style="direction: ltr">
                                @foreach($role->permissions as $permission)
                                    <span>{{ $permission->name }}</span> -
                                    @if(($loop->index+1) % 3 == 0)
                                    <br>
                                    @endif
                                @endforeach
                            </th>
                            <th>
                                <a class="btn btn-sm btn-success mr-3" href="#">ویرایش</a>
                                <a class="btn btn-sm btn-danger mr-3" href="#">حذف</a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

