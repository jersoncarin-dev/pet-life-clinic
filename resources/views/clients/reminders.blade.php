@extends('components.html')
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
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may see the doctor's reminder for you.
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
            <form action="{{ route('client.reminders') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search reminders..">
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
                            <th class="d-none d-sm-table-cell">Title</th>
                            <th class="d-none d-xl-table-cell">Body</th>
                            <th class="d-none d-xl-table-cell text-left">Read</th>
                            <th class="d-none d-xl-table-cell">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reminders as $reminder)
                            <tr>
                                <td class="d-none d-xl-table-cell font-size-sm">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success-light text-success">{{ $reminder->title }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">{{ $reminder->body }}</td>
                                @if($reminder->is_read)
                                    <td>
                                        <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success text-white">Yes</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-danger text-white">No</span>
                                    </td>
                                @endif
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted"">
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded  bg-success-light text-success" target="_blank" href="{{ $reminder->link }}">View link</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            {!! $reminders->links() !!}
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<!-- END Page Content -->
@endsection