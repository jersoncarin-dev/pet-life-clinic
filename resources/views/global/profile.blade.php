@extends('components.html')
@section('content')
<!-- Hero -->
<div class="bg-image" style="background-image: url('assets/media/photos/photo8@2x.jpg');">
    <div class="bg-black-75">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar-thumb" src="{{ auth()->user()->detail->avatar }}">
            </div>
            <h1 class="h2 text-white mb-0">{{ auth()->user()->name }} </h1>
            <h2 class="h4 font-w400 text-white-75">
                {{ auth()->user()->role }} 
            </h2>
            <a class="btn btn-light" href="/">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to dashboard
            </a>
        </div>
    </div>
</div>
<!-- END Hero -->
@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <p class="mb-0">{{ Session::get('error') }}</p>
    </div>
@endif
<!-- Page Content -->
<div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">User Profile</h3>
        </div>
        <div class="block-content">
            <form action="{{ route('update.profile',['type' => 'basic']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Your account’s vital info. Your name will be publicly visible.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-name">Name</label>
                            <input type="text" class="form-control" id="one-profile-edit-name" name="name" placeholder="Enter your name.." value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="one-profile-edit-email">Email Address</label>
                            <input type="email" class="form-control" id="one-profile-edit-email" name="email" placeholder="Enter your email.." value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Your Avatar</label>
                            <div class="push">
                                <img class="img-avatar" src="{{ auth()->user()->detail->avatar }}">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="avatar"  accept="image/png, image/gif, image/jpeg">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new avatar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="one-profile-edit-name">Contact Number</label>
                            <input type="text" class="form-control" id="one-profile-edit-name" name="contact_number" placeholder="Enter your contact number.." value="{{ auth()->user()->detail->contact_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="one-profile-edit-name">Address</label>
                            <input type="text" class="form-control" id="one-profile-edit-name" name="address" placeholder="Enter your address.." value="{{ auth()->user()->detail->address }}" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END User Profile -->

    <!-- Change Password -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Change Password</h3>
        </div>
        <div class="block-content">
            <form action="{{ route('update.profile',['type' => 'password']) }}" method="POST">
                @csrf
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Changing your sign in password is an easy way to keep your account secure.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-password">Current Password</label>
                            <input type="password" class="form-control" id="one-profile-edit-password" name="current_password">
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="one-profile-edit-password-new">New Password</label>
                                <input type="password" class="form-control" id="one-profile-edit-password-new" name="new_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Change Password -->
</div>
<!-- END Page Content -->
@endsection