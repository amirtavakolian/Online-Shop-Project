@extends('auth::layouts.master')

@section('content')
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
                                <h4> تایید ایمیل </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    @include('auth::partials.messages')
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('email.active.send', ['user' => auth()->user()->email]) }}">
                                        @csrf
                                        <input name="email" placeholder="ایمیل" type="email" value="{{ auth()->user()->email }}">
                                        <div class="button-box">
                                            <button type="submit" class="btn btn-google btn-block mt-4">ارسال ایمیل
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
