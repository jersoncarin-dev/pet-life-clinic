@extends('components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    My Pets
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may see your pets.
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Recent Orders -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">My Pets</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#add-pet">
                    <i class="fa fa-plus"></i> Add pet
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('client.pets') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search pets..">
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
                            <th class="d-none d-sm-table-cell text-center">Name</th>
                            <th class="d-none d-xl-table-cell text-center">Category</th>
                            <th class="d-none d-sm-table-cell text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pets as $pet)
                            <tr>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-center">{{ $pet->name }}</td>
                                <td class="d-none d-xl-table-cell font-size-sm text-center">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success-light text-success">{{ $pet->category }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded bg-danger text-white" href="{{ route('client.pets',['action' => 'delete','id' => $pet->id]) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            {!! $pets->links() !!}
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<div class="modal fade" id="add-pet" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add pet</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('client.create.pet') }}">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <input class="form-control form-control-lg form-control-alt" name="pet_name" placeholder="Pet name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg form-control-alt" name="pet_category" placeholder="Pet category" required>
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
@endsection