@extends('layouts.app')

@section('content')
    <style>
        .sticky-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .page-content {
            padding-bottom: 100px;
            /* Add padding to prevent content from being hidden behind sticky footer */
        }

        .stock-item {
            cursor: pointer;
            transition: all 0.2s;
        }

        .stock-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }

        .tab-pane {
            padding: 15px 0;
        }
    </style>

    <div class="page-content">
        <div class="p-1"></div>
        <h4>Stock Management</h4>
        <div class="p-1"></div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            <!-- Your existing dashboard cards here -->
            <!-- ... -->
        </div><!--end row-->

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0"></h5>
    <form action="" method="GET" class="d-flex">
        <select name="filter" class="form-select form-select-sm me-2">
            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Time</option>
            <option value="last_week" {{ request('filter') == 'last_week' ? 'selected' : '' }}>Last Week</option>
            <option value="last_30_days" {{ request('filter') == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
            <option value="last_60_days" {{ request('filter') == 'last_60_days' ? 'selected' : '' }}>Last 60 Days</option>
            <option value="last_month" {{ request('filter') == 'last_month' ? 'selected' : '' }}>Last Month</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
    </form>
</div>



        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Orders</p>
                                <h4 class="my-1 text-info">{{ $orders->count() }}</h4>
                                <p class="mb-0 font-13 d-none">+2.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Sales</p>
                                <h4 title="N {{ number_format($total, 2) }}" class="my-1 text-success">N
                                    {{ number_format($total, 2) }} </h4>
                                <p class="mb-0 font-13 d-none">-4.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col ">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Stock</p>
                                <h4 class="my-1 text-success">N {{ Str::limit(number_format($total_stock, 2), 20) }}</h4>
                                <p class="mb-0 font-13 d-none">-4.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Customers</p>
                                <h4 class="my-1 text-warning">{{ $customers->count() }}</h4>
                                <p class="mb-0 font-13 d-none">+8.4% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                    class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        @if (session('msg-add'))
            <div class="alert alert-success">
                {{ session('msg-add') }}
            </div>
        @endif

        @if (session('msg-remove'))
            <div class="alert alert-danger">
                {{ session('msg-remove') }}
            </div>
        @endif

        <div class="py-2 d-flex justify-content-end">
            <button class="btn btn-outline-primary btn-sm float-right me-2">Export PDF</button>
            <a href="/export-stock" class="btn btn-outline-primary btn-sm float-right">Export EXCEL</a>
        </div>

        <div class="card p-1">
            <div class="row">
                <div class="col-2">
                    <h6 class="text-muted">Status</h6>
                </div>
                <div class="col-3">
                    <h6 class="text-muted">Products</h6>
                </div>
                <div class="col-1">
                    <h6 class="text-muted">Sold</h6>
                </div>
                <div class="col-1">
                    <h6 class="text-muted">In stock</h6>
                </div>
                <div class="col-2">
                    <h6 class="text-muted">Unit Price</h6>
                </div>
                <div class="col-2">
                    <h6 class="text-muted">Total Price</h6>
                </div>
            </div>
        </div>

        @foreach ($products as $product)
            @php
                $stockIn = $product->stock->where('type', 'in')->sum('quantity');
                $stockOut = $product->stock->where('type', 'out')->sum('quantity');
                $totalStock = $stockIn + $stockOut; // net stock (outs are negative)
            @endphp

            @if ($totalStock > 1)
                <div class="py-1 stock-item" data-bs-toggle="modal" data-bs-target="#stockModal"
                    data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                    data-product-image="{{ $product->featured_image }}" data-current-stock="{{ $totalStock }}"
                    data-stock-in="{{ $stockIn }}" data-stock-out="{{ $stockOut * -1 }}"
                    data-unit-price="{{ $product->price }}">

                    <div
                        class="card {{ optional($product->stock->first())->status == 'not confirmed' ? 'border border-danger' : '' }}">
                        <div class="card-body position-relative">
                            {{-- Show "Not Confirmed" badge at top right --}}
                            @if (optional($product->stock->first())->status == 'not confirmed')
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">Not Confirmed</span>
                            @endif

                            <div class="row d-flex align-items-center">
                                <div class="col-2">
                                    <img src="{{ $product->featured_image }}" style="height: 50px;" alt="">
                                </div>
                                <div class="col-3">
                                    <h6>{{ $product->name }}</h6>
                                    <span class="badge bg-primary rounded-pill">{{ $product->category->name }}</span>
                                    <p>In Stock</p>
                                </div>
                                <div class="col-1">
                                    <h6 class="text-danger"><i class="bx bx-share"></i> {{ $stockOut * -1 }}</h6>
                                </div>
                                <div class="col-1">
                                    <h6 class="text-success"><i class="bx bx-archive-in"></i> {{ $totalStock }}</h6>
                                </div>
                                <div class="col-2">
                                    <h6>N {{ number_format($product->price, 2) }}</h6>
                                </div>
                                <div class="col-2">
                                    <h6>N {{ number_format($totalStock * $product->price, 2) }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        @endforeach

    </div>

    <!-- Sticky Footer -->
    <div class="sticky-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 me-3 text-primary">Total Stock Value:</h5>
                        <h4 class="mb-0 text-primary">N {{ number_format($total_stock, 2) }}</h4>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('stockManagement.create') }}" class="btn btn-primary btn-lg">Add Stock</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Adjustment Modal -->
    <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockModalLabel">Stock Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <img id="modalProductImage" src="" style="height: 60px;" class="img-thumbnail">
                        </div>
                        <div class="col-md-10">
                            <h4 id="productName" class="mb-1"></h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="mb-1"><strong>Current Stock:</strong> <span id="currentStock"
                                            class="badge bg-success"></span></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><strong>Stock In:</strong> <span id="stockIn"
                                            class="badge bg-primary"></span></p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><strong>Stock Out:</strong> <span id="stockOut"
                                            class="badge bg-danger"></span></p>
                                </div>
                            </div>
                            <p class="mb-0"><strong>Unit Price:</strong> N<span id="unitPrice"></span></p>
                        </div>
                    </div>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation ">
                            <button class="btn btn-primary active " id="pills-in-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-in" type="button" role="tab">Add Stock</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-danger" id="pills-out-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-out" type="button" role="tab">Remove Stock</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn btn-warning" id="pills-status-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-status" type="button" role="tab">Update Status</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Stock In Form -->
                        <div class="tab-pane fade show active" id="pills-in" role="tabpanel">
                            <form id="stockInForm" method="POST" action="{{ route('adjustAddStock') }}">
                                @csrf
                                <input type="hidden" name="product_id" id="inProductId">
                                <input type="hidden" name="type" value="in">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="inQuantity" class="form-label">Quantity to Add</label>
                                        <input type="number" class="form-control" id="inQuantity" name="quantity"
                                            min="1" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inDate" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="inDate" name="date"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inNotes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="inNotes" name="notes" rows="2"></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Add Stock</button>
                                </div>
                            </form>
                        </div>

                        <!-- Stock Out Form -->
                        <div class="tab-pane fade" id="pills-out" role="tabpanel">
                            <form id="stockOutForm" method="POST" action="{{ route('adjustRemoveStock') }}">
                                @csrf
                                <input type="hidden" name="product_id" id="outProductId">
                                <input type="hidden" name="type" value="out">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="outQuantity" class="form-label">Quantity to Remove</label>
                                        <input type="number" class="form-control" id="outQuantity" name="quantity"
                                            min="1" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="outDate" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="outDate" name="date"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="outReason" class="form-label">Reason</label>
                                    <select class="form-select" id="outReason" name="reason">
                                        <option value="sold">Sold</option>
                                        <option value="damaged">Damaged</option>
                                        <option value="expired">Expired</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="outNotes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="outNotes" name="notes" rows="2"></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-danger">Remove Stock</button>
                                </div>
                            </form>
                        </div>

                        <!-- Update Stock Status Form -->
                        <div class="tab-pane fade" id="pills-status" role="tabpanel">
                            <form id="updateStatusForm" method="POST" action="{{ route('updateStockStatus') }}">
                                @csrf
                                <input type="hidden" name="product_id" id="productId">

                                <div class="mb-3">
                                    <label for="stockStatus" class="form-label">Select Status</label>
                                    <select class="form-select" id="stockStatus" name="status" required>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="not confirmed">Not Confirmed</option>
                                    </select>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning">Update Status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set today's date as default for both forms
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('inDate').value = today;
            document.getElementById('outDate').value = today;

            // Set up modal with product data when a stock item is clicked
            var stockModal = document.getElementById('stockModal');
            stockModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                // Update product info
                document.getElementById('modalProductImage').src = button.getAttribute(
                    'data-product-image');
                document.getElementById('productName').textContent = button.getAttribute(
                    'data-product-name');
                document.getElementById('productId').value = button.getAttribute(
                    'data-product-id');
                document.getElementById('currentStock').textContent = button.getAttribute(
                    'data-current-stock');
                document.getElementById('stockIn').textContent = button.getAttribute('data-stock-in');
                document.getElementById('stockOut').textContent = button.getAttribute('data-stock-out');
                document.getElementById('unitPrice').textContent = button.getAttribute('data-unit-price');

                // Set product ID in both forms
                const productId = button.getAttribute('data-product-id');
                document.getElementById('inProductId').value = productId;
                document.getElementById('outProductId').value = productId;

                // Reset forms
                document.getElementById('stockInForm').reset();
                document.getElementById('stockOutForm').reset();
                document.getElementById('inDate').value = today;
                document.getElementById('outDate').value = today;
            });
        });
    </script>
@endsection
