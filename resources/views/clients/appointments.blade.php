@extends('components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Appointments
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, please check you're appointments.
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
            <h3 class="block-title">Appointments</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#add-appointment">
                    <i class="fa fa-plus"></i> Add appointment
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('client.appointments') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search appointments..">
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
                            <th class="text-center" style="width: 160px;">Appointment</th>
                            <th class="d-none d-sm-table-cell">Purpose</th>
                            <th class="d-none d-xl-table-cell" style="width: 120px;">Notes</th>
                            <th class="d-none d-xl-table-cell" style="width: 120px;">Approved</th>
                            <th class="d-none d-xl-table-cell text-left" style="width: 180px;">Date</th>
                            <th class="d-none d-sm-table-cell text-left" style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>APM.00{{ $appointment->id }}</strong>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">{{ $appointment->purpose }}</td>
                            <td class="d-none d-sm-table-cell text-left">
                                <a class="font-size-sm font-w600 px-2 py-1 rounded bg-body-dark" href="#" onclick="viewNote(`{{ $appointment->note ?? 'No Doctor notes.' }}`)">View note</a>
                            </td>
                            @if($appointment->is_approved)
                            <td class="d-none d-sm-table-cell text-center">
                                <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success text-white">Yes</span>
                            </td>
                            @else
                            <td class="d-none d-sm-table-cell text-center">
                                <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-danger text-white">No</span>
                            </td>
                            @endif
                            <td class="d-none d-sm-table-cell text-left">
                                <a class="font-size-sm font-w600 px-2 py-1 rounded bg-body-dark">{{ date('F j, Y', strtotime($appointment->date)) }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell text-left">
                                <a class="font-size-sm font-w600 px-2 py-1 rounded {{ $appointment->is_approved ? 'bg-success' : ($appointment->trashed() ? 'bg-success' : 'bg-danger') }} text-white" {!! $appointment->is_approved ? 'style="pointer-events:none;"' : ($appointment->trashed() ? 'style="pointer-events:none;"' : '') !!} href="{{ route('client.appointments',['action' => 'cancel','id' => $appointment->id]) }}">{{ $appointment->is_approved ? 'Appointed' : ($appointment->trashed() ? 'Cancelled' : 'Cancel') }}</a>
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
<div class="modal fade" id="view-note" tabindex="-1" role="dialog" aria-labelledby="view-note" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">View note</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                   <p id="note"></p>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fade In Block Modal -->
<div class="modal fade" id="add-appointment" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add appointment</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('client.create.appointment') }}">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-alt" name="purpose" placeholder="Purpose of appointment" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control form-control-lg form-control-alt" name="date" placeholder="Appointment date" required>
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
<script>
    function viewNote(note) {
        $('#view-note').modal('show')
        $('#note').text(note)
    }
</script>
<!-- END Page Content -->
@endsection