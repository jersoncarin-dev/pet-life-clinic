@extends('staff.components.html')
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
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may manage the products.
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
                <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#add-product">
                    <i class="fa fa-plus"></i> Add product
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
                            <th class="text-center" style="width: 120px;">Product</th>
                            <th class="d-none d-sm-table-cell">Name</th>
                            <th class="d-none d-xl-table-cell">Category</th>
                            <th>Available</th>
                            <th class="d-none d-xl-table-cell text-center">Description</th>
                            <th class="d-none d-sm-table-cell text-center">Thumbnail</th>
                            <th class="d-none d-sm-table-cell text-right">Price</th>
                            <th class="d-none d-sm-table-cell text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="javascript:void(0)">
                                    <strong>PRD.00{{ $product->id }}</strong>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell font-size-sm font-w600 text-muted">{{ $product->name }}</td>
                            <td class="d-none d-xl-table-cell font-size-sm">
                                {{ $product->type }}
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
                            <td style="width:140px" class="d-none d-sm-table-cell text-left font-size-sm">
                                <a href="#" class="font-size-sm font-w600 px-2 py-1 rounded bg-success text-white mr-1 edit" data-bind="{{ json_encode($product) }}" data-id="{{ $product->id }}" id="edit">Edit</span>
                                <a class="font-size-sm font-w600 px-2 py-1 rounded  bg-danger text-white" href="{{ route('staff.products',['action' => 'delete','id' => $product->id]) }}">Delete</a>
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
<div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add product</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.product.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-alt" name="description" placeholder="Description" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" name="category" placeholder="Category" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg form-control-alt" name="price" placeholder="Price" required>
                        </div>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input" id="available" name="available">
                            <label class="custom-control-label font-w400" for="available">Available</label>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="thumbnail"  accept="image/png, image/gif, image/jpeg">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a thumbnail</label>
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
<div class="modal fade" id="edit-product" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit product</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.product.edit') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-alt" id="desc" name="description" placeholder="Description" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg form-control-alt" id="cat" name="category" placeholder="Category" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg form-control-alt" id="price" name="price" placeholder="Price" required>
                        </div>
                        <div class="custom-control custom-switch mb-2">
                            <input type="checkbox" class="custom-control-input av" id="available-s" name="available">
                            <label class="custom-control-label font-w400" for="available-s">Available</label>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="thumbnail"  accept="image/png, image/gif, image/jpeg">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new thumbnail</label>
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

       $('#edit-product').modal('show')
       $('#name').val(data.name)
       $('#desc').val(data.description)
       $('#price').val(data.price)
       $('#cat').val(data.type)
       $('.av').attr('checked',Boolean(data.is_available))
       $('#id').val(id)
    })
</script>
@endSection
@endsection