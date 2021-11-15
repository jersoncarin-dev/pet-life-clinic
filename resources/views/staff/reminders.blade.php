@extends('staff.components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Reminders
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may send reminders to the clients.
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
            <h3 class="block-title">Reminders</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('staff.reminders') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search users..">
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
                            <th class="d-none d-sm-table-cell text-center">Client Name</th>
                            <th class="d-none d-xl-table-cell text-center">Contact Number</th>
                            <th class="d-none d-xl-table-cell text-center">Address</th>
                            <th class="d-none d-xl-table-cell text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="d-none d-xl-table-cell font-size-sm text-center">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded bg-success-light text-success">{{ $user->name }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-center">{{ $user->detail->contact_number }}</td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-center">{{ $user->detail->address }}</td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-center">
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded bg-success text-white send" data-id="{{ $user->id }}" href="#">Send</a>
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
<div class="modal fade" id="add-reminder" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Send reminder</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.send.reminder') }}">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-alt" name="message" placeholder="Send reminder message to the end client" required></textarea>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $('.send').click(function() {
        const id = $(this).data('id')
        $('#add-reminder').modal('show')
        $('#id').val(id)
    })
</script>
@endsection

@endsection