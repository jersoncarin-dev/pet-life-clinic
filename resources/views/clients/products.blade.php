@extends('components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Products
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may browse our products.
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
            <h3 class="block-title">Products</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom {{ request()->has('q') ? '' : 'd-none' }}">
            <!-- Search Form -->
            <form action="{{ route('client.products') }}" method="GET">
                <div class="form-group push">
                    <div class="input-group">
                        <input type="text" class="form-control" id="one-ecom-orders-search" value="{{ request()->q }}" name="q" placeholder="Search products..">
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
                            <th class="d-none d-sm-table-cell">Name</th>
                            <th class="d-none d-xl-table-cell">Category</th>
                            <th>Available</th>
                            <th class="d-none d-xl-table-cell text-center">Description</th>
                            <th class="d-none d-sm-table-cell text-center">Thumbnail</th>
                            <th class="d-none d-sm-table-cell text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">{{ $product->name }}</td>
                                <td class="d-none d-xl-table-cell font-size-sm">
                                    <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success-light text-success">{{ $product->type }}</span>
                                </td>
                                @if($product->is_available)
                                    <td>
                                        <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-success text-white">Yes</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="font-size-sm font-w600 px-2 py-1 rounded  bg-danger text-white">No</span>
                                    </td>
                                @endif
                                <td class="d-none d-xl-table-cell text-center font-size-sm">
                                    <a class="font-w600" href="javascript:void(0)">{{ $product->description }}</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="font-size-sm font-w600 px-2 py-1 rounded bg-body-dark" target="_blank" href="{{ $product->thumbnail }}">View</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-right font-size-sm">
                                    <strong>₱{{ $product->price }}</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END Recent Orders Table -->

            <!-- Pagination -->
            {!! $products->links() !!}
        </div>
    </div>
    <!-- END Recent Orders -->
</div>
<!-- END Page Content -->
@endsection