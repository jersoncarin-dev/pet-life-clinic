@extends('staff.components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    List appointments
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may view all list of appointments via table.
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
            <h3 class="block-title">List appointments</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('staff.appointments.list') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search archive appointments..">
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
                            <th class="d-none d-sm-table-cell text-left">Owner</th>
                            <th class="d-none d-xl-table-cell text-left" style="width: 500px">Purpose</th>
                            <th class="d-none d-xl-table-cell text-left">Status</th>
                            <th class="d-none d-xl-table-cell text-left">Date</th>
                            <th class="d-none d-xl-table-cell text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="d-none d-xl-table-cell font-size-sm text-left">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded bg-success-light text-success">{{ $appointment->owner->name }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-left">{{ $appointment->purpose }}</td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-left">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded bg-info text-white">{{ $appointment->is_approved ? 'Approved' : ($appointment->trashed() ? 'Rejected' : 'Pending') }}</span>
                                </td>
                                <td class="d-none d-xl-table-cell font-size-sm text-left">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded bg-info text-white">{{ \Carbon\Carbon::parse($appointment->date)->diffForHumans() }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted text-left">
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded bg-success text-white add-note" data-id="{{ $appointment->id }}" href="#">Add note</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            {!! $appointments->links() !!}
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<!-- END Page Content -->
<div class="modal fade" id="add-note" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add Note</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.appointments.note') }}">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-alt" name="note" placeholder="Add note to the appointment of client" required></textarea>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $('.add-note').click(function() {
        const id = $(this).data('id')
        $('#add-note').modal('show')
        $('#id').val(id)
    })
</script>
@endsection

@endsection