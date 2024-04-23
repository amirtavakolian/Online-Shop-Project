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
                            <a class="active" >
                                <h4> عضویت </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    @include('auth::partials.messages')
                                    <div class="login-register-form">
                                        <form action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <input name="name" placeholder="نام و نام خانوادگی" type="text">
                                            <input name="email" placeholder="ایمیل" type="email">
                                            <input type="password" name="password" placeholder="رمز عبور">
                                            <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور">
                                            <div class="button-box">
                                                <button type="submit"  class="btn btn-google btn-block mt-4">عضویت</button>
                                                <a href="#" class="btn btn-google btn-block mt-4">
                                                    <i class="sli sli-social-google"></i>
                                                    ایجاد اکانت با گوگل
                                                </a>
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
