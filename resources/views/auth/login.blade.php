@extends('components.html')
@section('auth')
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Sign In Section -->
        <div class="">
            <div class="content content-full">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                        <!-- Header -->
                        <div class="text-center">
                            <h2 class="mb-2">
                                {{ config('app.name') }}
                            </h2>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                Signin to start your session
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" action="{{ route('post-login') }}" method="POST">
                            @csrf
                            @if(Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    <p class="mb-0">{{ Session::get('error') }}</p>
                                </div>
                            @endif
                            <div class="py-3">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg form-control-alt" id="login-username" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg form-control-alt" id="login-password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="d-md-flex align-items-md-center justify-content-md-between">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="login-remember" name="remember">
                                            <label class="custom-control-label font-w400" for="login-remember">Remember Me</label>
                                        </div>
                                        <div class="py-2">
                                            <span class="font-size-sm font-w500">Don't have account yet? </span><a class="font-size-sm font-w500" href="{{ route('register') }}">Register now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center mb-0">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Login
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Section -->

        <!-- Footer -->
        <div class="font-size-sm text-center text-muted py-3">
            <strong>{{ config('app.name') }}</strong> &copy; {{ date('Y') }}</span>
        </div>
        <!-- END Footer -->
    </div>
</div>
<!-- END Page Content -->
@endsection