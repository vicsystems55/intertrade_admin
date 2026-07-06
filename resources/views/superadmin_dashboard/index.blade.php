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

@section('index-css')

<style>

/* ================================
   White Modern Dashboard Theme
================================ */

.white-dashboard {
    background: #f8fafc;
    min-height: calc(100vh - 60px);
    padding: 1.8rem;
}

.dashboard-welcome {
    background: #ffffff;
    border: 1px solid #edf2f7;
    border-radius: 24px;
    padding: 1.6rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.05);
}

.welcome-badge {
    display: inline-block;
    background: #eef6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 700;
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    margin-bottom: 0.6rem;
}

.dashboard-welcome h3 {
    margin: 0;
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
}

.dashboard-welcome p {
    margin: 0.35rem 0 0;
    color: #64748b;
}

.welcome-date {
    background: #f8fafc;
    border: 1px solid #edf2f7;
    color: #334155;
    padding: 0.75rem 1rem;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    font-weight: 600;
}

.stat-card {
    background: #ffffff;
    border: 1px solid #edf2f7;
    border-radius: 24px;
    padding: 1.4rem;
    min-height: 150px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    color: #0f172a;
    text-decoration: none;
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.05);
    transition: all 0.25s ease;
}

.stat-card:hover {
    color: #0f172a;
    transform: translateY(-5px);
    box-shadow: 0 22px 50px rgba(15, 23, 42, 0.09);
}

.stat-content {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
}

.stat-icon {
    width: 58px;
    height: 58px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
}

.soft-blue {
    background: #eff6ff;
    color: #2563eb;
}

.soft-green {
    background: #ecfdf5;
    color: #10b981;
}

.soft-orange {
    background: #fff7ed;
    color: #f97316;
}

.stat-card p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    font-weight: 600;
}

.stat-card h4 {
    margin: 0.25rem 0;
    font-size: 27px;
    font-weight: 800;
    color: #0f172a;
}

.stat-card span {
    color: #94a3b8;
    font-size: 13px;
}

.stat-arrow {
    font-size: 24px;
    color: #cbd5e1;
    transition: all 0.25s ease;
}

.stat-card:hover .stat-arrow {
    color: #2563eb;
    transform: translateX(4px);
}

.modern-chart-card {
    background: #ffffff;
    border: 1px solid #edf2f7 !important;
    border-radius: 24px;
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.05);
    overflow: hidden;
}

.modern-chart-card .card-body {
    padding: 1.5rem;
}

.chart-title-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.2rem;
}

.chart-title-wrap h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
}

.chart-title-wrap p {
    margin: 0.3rem 0 0;
    color: #64748b;
}

.chart-pill {
    background: #f8fafc;
    border: 1px solid #edf2f7;
    color: #2563eb;
    padding: 0.55rem 0.85rem;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}

.chart-area {
    overflow-x: auto;
}

.chart-area #chart3 {
    min-width: 500px;
}
</style>

@endsection


@section('script-content')

<script src="{{ config('app.url') }}assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="{{ config('app.url') }}assets/plugins/apexcharts-bundle/js/apex-custom.js"></script>

@endsection
