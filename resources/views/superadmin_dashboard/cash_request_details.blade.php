@extends('layouts.app')


@section('content')


    <div class="page-content">
        <div class="p-2"></div>

        <h4 class="fw-bold mb-3">💰 Cash Request Details</h4>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body">

                        {{-- Error & Success Messages --}}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endforeach
                        @endif

                        @if (Session::has('cashAppMsg'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                {{ Session::get('cashAppMsg') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Approval Form --}}
                        <form action="{{ route('cash_request.approve') }}" method="post" class="mt-3">
                            @csrf

                            <input type="hidden" name="cash_request_id" value="{{ $cash_request->id }}">

                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" id="title" name="title" class="form-control shadow-sm"
                                    placeholder="Enter request title" value="{{ $cash_request->title }}">
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label fw-semibold">Amount</label>
                                <input type="number" id="amount" name="amount_approved" class="form-control shadow-sm"
                                    placeholder="0.00" value="{{ $cash_request->amount_requested }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea id="description" name="description" rows="5" class="form-control shadow-sm"
                                    placeholder="Enter detailed description of cash request">{{ $cash_request->description }}</textarea>
                            </div>

                            @if (Auth::user()->role == 'superadmin')
                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" name="status" value="Approved" class="btn btn-success shadow">
                                        ✅ Approve Request
                                    </button>
                                    <button type="submit" name="status" value="Disapproved" class="btn btn-danger shadow">
                                        ❌ Disapprove Request
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right Side Info (Optional) --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body">
                        <h6 class="fw-bold">📌 Request Summary</h6>
                        <p><strong>Requested By:</strong> {{ $cash_request->requestby->name }}</p>
                        <p><strong>Status:</strong>
                            @if ($cash_request->status == 'pending')
                                <span class="badge bg-primary">Pending</span>
                            @elseif ($cash_request->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Disapproved</span>
                            @endif
                        </p>
                        <p><strong>Requested Amount:</strong> N {{ number_format($cash_request->amount_requested, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
