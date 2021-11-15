@extends('staff.components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    {{ ucfirst($type) }}s
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may manage the {{ ucfirst($type) }}s.
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    @if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <p class="mb-0">{{ Session::get('error') }}</p>
    </div>
    @endif
    <!-- Recent Orders -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ ucfirst($type) }}s</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#add-user">
                    <i class="fa fa-plus"></i> Add {{ ucfirst($type) }}
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('staff.clients') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search admins..">
                        <div class="input-group-append">
                            <button class="input-group-text" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END Search Form -->
        </div>
        <div class="block-content">
            <!-- Products Table -->
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="d-none d-xl-table-cell">Role</th>
                            <th class="d-none d-xl-table-cell text-center">Address</th>
                            <th class="d-none d-sm-table-cell text-center">Contact Number</th>
                            <th class="d-none d-sm-table-cell text-center">Avatar</th>
                            <th class="d-none d-sm-table-cell text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-center">{{ $user->name }}</td>
                            <td class="d-none d-xl-table-cell font-size-sm">
                                {{ $user->email }}
                            </td>
                            <td>
                                <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success text-white">{{ $user->role }}</span>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">{{ $user->detail->address }}</a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">{{ $user->detail->contact_number }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <a class="font-size-sm font-w600 px-2 py-1 rounded bg-body-dark" target="_blank" href="{{ $user->detail->avatar }}">View</a>
                            </td>
                            <td style="width:140px" class="d-none d-sm-table-cell text-left font-size-sm">
                                <a href="#" class="font-size-sm font-w600 px-2 py-1 rounded bg-success text-white mr-1 edit" data-bind="{{ json_encode($user) }}" data-id="{{ $user->id }}" id="edit">Edit</span>
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded  bg-danger text-white" href="{{ route('staff.user.delete',['id' => $user->id]) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            {!! $users->links() !!}
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<!-- END Page Content -->
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add {{ $type }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.user.add') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="ADMIN">
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg form-control-alt" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg form-control-alt" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg form-control-alt" name="contact_number" placeholder="Contact Number" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="avatar" accept="image/png, image/gif, image/jpeg" required>
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose avatar</label>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<!-- END Page Content -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit {{ $type }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.user.edit') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg form-control-alt" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg form-control-alt" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg form-control-alt" name="contact_number" id="contact" placeholder="Contact Number" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="address" id="address" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="avatar" accept="image/png, image/gif, image/jpeg">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose avatar</label>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $('.edit').click(function() {
        const id = $(this).data('id')
        const data = $(this).data('bind')

        $('#edit-user').modal('show')
        $('#name').val(data.name)
        $('#email').val(data.email)
        $('#contact').val(data.detail.contact_number)
        $('#address').val(data.detail.address)
        $('#id').val(id)
    })
</script>
@endSection
@endsection