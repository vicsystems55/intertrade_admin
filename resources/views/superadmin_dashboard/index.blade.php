@extends('layouts.app')

@section('content')

<div class="page-content white-dashboard">

    <div class="dashboard-welcome mb-4">
        <div>
            <span class="welcome-badge">Dashboard Overview</span>
            <h3>Hi, {{ Auth::user()->name }}</h3>
            <p>Welcome back. Here’s a quick summary of your store activity.</p>
        </div>

        <div class="welcome-date">
            <i class="bx bx-calendar"></i>
            {{ now()->format('D, M d, Y') }}
        </div>
    </div>

    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3 mb-4">

        <div class="col">
            <a href="{{ route('admin.all_products') }}" class="stat-card border border-2 border-primary">
                <div class="stat-content">
                    <div class="stat-icon soft-blue">
                        <i class="bx bxs-cart"></i>
                    </div>

                    <div>
                        <p>Products</p>
                        <h4>{{ $products->count() }}</h4>
                        <span>View all products</span>
                    </div>
                </div>

                <i class="bx bx-right-arrow-alt stat-arrow"></i>
            </a>
        </div>

        <div class="col">
            <a href="{{ route('admin.transactions') }}" class="stat-card border border-2 border-success">
                <div class="stat-content">
                    <div class="stat-icon soft-green">
                        <i class="bx bxs-wallet"></i>
                    </div>

                    <div>
                        <p>Total Sales</p>
                        <h4 class="mb-0"><strong>{{ \App\Helpers\Helpers::formatCurrencySuffix($yearTotal) }}</strong></h4>
                        <span class="small text-muted">All time: {{ \App\Helpers\Helpers::formatCurrencySuffix($total) }}</span>
                    </div>
                </div>

                <i class="bx bx-right-arrow-alt stat-arrow"></i>
            </a>
        </div>

        <div class="col">
            <a href="/admin/customer" class="stat-card border border-2 border-warning">
                <div class="stat-content">
                    <div class="stat-icon soft-orange">
                        <i class="bx bxs-group"></i>
                    </div>

                    <div>
                        <p>Customers</p>
                        <h4>{{ $customers->count() }}</h4>
                        <span>Manage customers</span>
                    </div>
                </div>

                <i class="bx bx-right-arrow-alt stat-arrow"></i>
            </a>
        </div>

    </div>

    <div class="card modern-chart-card">
        <div class="card-body">
            <div class="chart-title-wrap">
                <div>
                    <h5>Sales Analytics</h5>
                    <p>Overview of recent sales performance</p>
                </div>

                <span class="chart-pill">
                    <i class="bx bx-line-chart"></i>
                    Report
                </span>
            </div>

            <div class="d-flex justify-content-end mb-3">
                <div class="btn-group" role="group" aria-label="Sales period selector">
                    <button type="button" class="btn btn-outline-primary sales-period-button active" data-period="week">Week</button>
                    <button type="button" class="btn btn-outline-primary sales-period-button" data-period="month">Month</button>
                    <button type="button" class="btn btn-outline-primary sales-period-button" data-period="year">Year</button>
                    <button type="button" class="btn btn-outline-primary sales-period-button" data-period="day">Day</button>
                </div>
            </div>
            <div class="chart-area">
                <div id="chart3"></div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('script-content')

<script src="{{ config('app.url') }}assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="{{ config('app.url') }}assets/plugins/apexcharts-bundle/js/apex-custom.js"></script>

@endsection
