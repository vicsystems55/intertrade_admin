@extends('layouts.app')

@section('content')
<div class="page-content">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">🚛 Logistics Dashboard</h4>
        <button class="btn btn-primary shadow">
            + Add New Vehicle
        </button>
    </div>

{{-- Quick Stats --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-primary text-white">
            <div class="card-body text-center">
                <div class="mb-2">
                    <i class="bx bxs-truck fs-1"></i>
                </div>
                <h6>Total Vehicles</h6>
                <h3>12</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body text-center">
                <div class="mb-2">
                    <i class="bx bxs-map-pin fs-1"></i>
                </div>
                <h6>Active Routes</h6>
                <h3>7</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-warning text-dark">
            <div class="card-body text-center">
                <div class="mb-2">
                    <i class="bx bxs-wrench fs-1"></i>
                </div>
                <h6>Pending Maintenance</h6>
                <h3>3</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-info text-white">
            <div class="card-body text-center">
                <div class="mb-2">
                    <i class="bx bxs-user-detail fs-1"></i>
                </div>
                <h6>Logistics Managers</h6>
                <h3>4</h3>
            </div>
        </div>
    </div>
</div>


    {{-- Vehicle List --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold">🚚 Fleet Overview</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Reg. Number</th>
                        <th>Reg. Expiry</th>
                        <th>Current Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Demo row --}}
                    <tr>
                        <td>
                            <img src="{{ asset('inventory_images/truck_a.png') }}" class="rounded me-2" style="width:40px;height:40px;object-fit:cover;">
                            Truck A
                        </td>
                        <td>Mercedes Actros</td>
                        <td>Heavy Duty</td>
                        <td>ABC-123-XY</td>
                        <td>
                            15 Nov, 2025
                        </td>
                        <td><span class="badge bg-secondary">Abuja</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Details</a>
                            <a href="#" class="btn btn-sm btn-primary">Assign Route</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('inventory_images/truck_a.png') }}" class="rounded me-2" style="width:40px;height:40px;object-fit:cover;">
                            Truck B
                        </td>
                        <td>Volvo FH16</td>
                        <td>Container Carrier</td>
                        <td>KJA-889-ZY</td>
                        <td>
                            20 Jan, 2026
                        </td>
                        <td><span class="badge bg-secondary">Lagos</span></td>
                        <td><span class="badge bg-warning">Under Maintenance</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Details</a>
                            <a href="#" class="btn btn-sm btn-primary">Assign Route</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('inventory_images/truck_a.png') }}" class="rounded me-2" style="width:40px;height:40px;object-fit:cover;">
                            Truck C
                        </td>
                        <td>Toyota Hilux</td>
                        <td>Pickup</td>
                        <td>ENU-456-QW</td>
                        <td>
                            5 Dec, 2025
                        </td>
                        <td><span class="badge bg-secondary">Port Harcourt</span></td>
                        <td><span class="badge bg-danger">Inactive</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Details</a>
                            <a href="#" class="btn btn-sm btn-primary">Assign Route</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Active Routes --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold">📍 Active Routes</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Truck A – Abuja ➝ Kano
                    <span class="badge bg-primary">In Progress</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Truck B – Lagos ➝ Ibadan
                    <span class="badge bg-success">Completed</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Truck C – Port Harcourt ➝ Aba
                    <span class="badge bg-warning">Pending</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Logistics Managers --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold">👷 Logistics Managers</h6>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Demo manager --}}
                <div class="col-md-3 mb-3">
                    <div class="card text-center shadow-sm h-100">
                        <div class="card-body">
                            <img src="https://ui-avatars.com/api/?name=Attah+Gideo" class="rounded-circle mb-2" width="60" height="60">
                            <h6 class="fw-bold">Attah Gideo</h6>
                            <p class="text-muted small">okpe.gideon@intertradelt.biz</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Add more demo managers here --}}
            </div>
        </div>
    </div>

</div>
@endsection
