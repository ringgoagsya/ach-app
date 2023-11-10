@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto" style="margin-top: -60px">
        <h3 class="mb-5">Welcome to the ACH SPH Calculator Application (ASCA)</h3>
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto" style="margin-top: -10px">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="{{ asset('black') }}/img/card-primary.png" alt="">
                    <h1 style="margin-left: 10px" class="card-title">{{ __('Log in') }}</h1>
                </div>
                <div class="card-body">

                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-email-85"></i>
                            </div>
                        </div>
                        <input type="email" name="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="tim-icons icon-lock-circle"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="{{ __('Password') }}" name="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>
                <div class="card-footer" style="margin-top: -50px">
                    <button type="submit" href=""
                        class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
                    {{-- <div class="pull-left">
                        <h6>
                            <a href="{{ route('pasien.create') }}" class="link footer-link">{{ __('Create Account') }}</a>
                        </h6>
                    </div>
                    <div class="pull-right">
                        <h6>
                            <a href="{{ route('password.request') }}"
                                class="link footer-link">{{ __('Forgot password?') }}</a>
                        </h6>
                    </div> --}}
                    <div>
                        <a style="color: black; text-align:center; " center href="https://www.linkedin.com/in/ringgoagsya/">
                            {{ 'Please log In to Manage Data' }}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
