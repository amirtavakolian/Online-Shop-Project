@extends('auth::layouts.master')

@section('content')
    {{-- add source here  --}}

    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li><a href="index.html">صفحه ای اصلی</a></li>
                    <li class="active">ورود</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="login-register-area pt-50 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active">
                                <h4> تغییر رمز عبور </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    @include('auth::partials.messages')
                                    <div class="login-register-form">
                                        <form action="{{ route('password.update') }}" method="POST">
                                            @csrf
                                            <input name="user-email" placeholder="ایمیل" type="email" disabled value="{{ $email }}">
                                            <input name="email" placeholder="ایمیل" type="hidden" value="{{ $email }}">
                                            <input name="password" placeholder="" type="password">
                                            <input name="password_confirmation" placeholder="" type="password">
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="button-box">
                                                <button type="submit" class="btn btn-google btn-block mt-4">ارسال
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
