@extends('layouts.app')


@section('content')


<div class="page-content">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">💰 Cash Request</h3>
        <a href="#requestForm" class="btn btn-outline-primary btn-sm">+ New Request</a>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Amount Requested</h6>
                    <h4 class="fw-bold text-dark">
                        ₦{{ number_format($cash_requests->where('status', 'pending')->sum('amount_requested'), 2) }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Amount Approved</h6>
                    <h4 class="fw-bold text-success">
                        ₦{{ number_format($cash_requests->where('status', 'approved')->sum('amount_requested'), 2) }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Amount Refunded</h6>
                    <h4 class="fw-bold text-danger">
                        ₦{{ number_format($cash_requests->where('status', 'refunded')->sum('amount_requested'), 2) }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Form -->
    <div class="card shadow-sm border-0 rounded-3 mb-4" id="requestForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Submit a Cash Request</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="alert alert-warning">{{ $error }}</p>
                @endforeach
            @endif

            @if(Session::has('cashMsg'))
                <p class="alert alert-info">{{ Session::get('cashMsg') }}</p>
            @endif

            <form action="{{ route('cash_request.store') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                               placeholder="Give a title for the request" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount_requested" class="form-control"
                               placeholder="0.00" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control"
                                  placeholder="Enter detailed description of cash request"></textarea>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary px-4 shadow-sm">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

    <!-- All Requests -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">📋 All Requests</h4>
    </div>

    <div class="row g-3">
        @forelse ($cash_requests as $cash_request)
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100 rounded-3 hover-shadow">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 text-truncate">{{ $cash_request->title }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-2">{{ Str::limit($cash_request->description, 80) }}</p>

                        @php
                            $statusClass = match(strtolower($cash_request->status)) {
                                'pending' => 'primary',
                                'approved' => 'success',
                                'refunded' => 'danger',
                                default => 'secondary'
                            };
                        @endphp

                        <span class="badge bg-{{ $statusClass }} mb-2 text-capitalize">
                            {{ $cash_request->status }}
                        </span>

                        <h6 class="fw-bold">₦{{ number_format($cash_request->amount_requested, 2) }}</h6>

                        <a href="{{ route('cash_request_details', $cash_request->id) }}"
                           class="btn btn-outline-primary btn-sm mt-2 w-100">
                            View Details
                        </a>
                    </div>
                    <div class="card-footer bg-light small text-muted">
                        By: <strong>{{ $cash_request->requestby->name }}</strong>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No cash requests found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $cash_requests->render("pagination::bootstrap-4") }}
    </div>

</div>



@endsection
