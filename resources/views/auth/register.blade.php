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
                                Register to start your session
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" action="{{ route('post-register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    <p class="mb-0">{{ Session::get('error') }}</p>
                                </div>
                            @endif
                            <div class="py-3">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg form-control-alt" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg form-control-alt" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg form-control-alt" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="form-control form-control-lg form-control-alt" name="avatar" accept="image/png, image/gif, image/jpeg" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg form-control-alt" name="address" placeholder="Full address" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg form-control-alt" name="contact_number" placeholder="Contact number" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg form-control-alt" name="pet_name" placeholder="Pet name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg form-control-alt" name="pet_category" placeholder="Pet category" required>
                                </div>
                                <div class="form-group">
                                    <div class="d-md-flex align-items-md-center justify-content-md-between">
                                        <div class="py-2">
                                            <span class="font-size-sm font-w500">Already have account? </span><a class="font-size-sm font-w500" href="{{ route('login') }}">Login now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center mb-0">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Register
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