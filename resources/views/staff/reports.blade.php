@extends('staff.components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Reports
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may view the reports monthly.
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="col-xl-12 d-flex flex-column">
        <!-- Earnings Summary -->
        <div class="block block-rounded flex-grow-1 d-flex flex-column">
            <div class="block-header block-header-default">
                <h3 class="block-title">Appointment Reports</h3>
                <div class="block-options">
                    <a href="{{ route('staff.reports') }}" class="btn-block-option">
                        <i class="si si-refresh"></i>
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full flex-grow-1 d-flex align-items-center">
                <!-- Earnings Chart Container -->
                <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
                <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                <canvas id="reports" height="500px"></canvas>
            </div>
        </div>
        <!-- END Earnings Summary -->
    </div>
</div>
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = {!! $labels !!}

    const data = {
        labels: labels,
        datasets: [{
            label: 'Approved',
            backgroundColor: 'rgba(0, 247, 64, 0.8)',
            borderColor: 'rgba(0, 247, 64, 0.8)',
            data: {!! $approved !!},
        },{
            label: 'Rejected',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: {!! $rejected !!},
        },{
            label: 'Pending',
            backgroundColor: 'rgba(41, 35, 235, 0.8)',
            borderColor: 'rgba(41, 35, 235, 0.8)',
            data: {!! $pendings !!},
        }]
    };

    new Chart($('#reports'), {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
<!-- END Page Content -->
@endsection