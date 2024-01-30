@extends('layouts.app')


@section('content')

    <div class="page-content">
             <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Payroll</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Summary</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Employees</p>
                            <h4 class="my-1 text-info">{{count($empPaycheckSummary)}}</h4>
                            <p class="mb-0 font-13">Updated: {{\Carbon\Carbon::now()->format('d M, Y')}}</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-group'></i>
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
                            <p class="mb-0 text-secondary">Total Deductions</p>
                            <h4 class="my-1 text-success">N {{number_format($empPaycheckSummary->sum('total_deductions'), 2)}}  </h4>
                            <p class="mb-0 font-13">Updated: {{\Carbon\Carbon::now()->format('d M, Y')}}</p>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col d-none">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Paid</p>
                                <h4 class="my-1 text-success">0</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
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
                                <p class="mb-0 text-secondary">Total paid</p>
                                <h4 class="my-1 text-warning">N {{number_format($empPaycheckSummary->sum('net_pay'),2)}}</h4>
                                <p class="mb-0 font-13">Updated: {{\Carbon\Carbon::now()->format('d M, Y')}}</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->



				<h6 class="mb-0 text-uppercase">Employee Records</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>

										<th>Total Deductions</th>
										<th>Take Home</th>
										<th>Status</th>

									</tr>
								</thead>
								<tbody>
                                    @foreach ($empPaycheckSummary as $summary)

									<tr>
										<td>{{$summary->employee->name}}</td>
										<td>{{$summary->employee->salary_level->designation}}</td>

										<td>{{number_format($summary->total_deductions, 2)}}</td>
										<td>{{number_format($summary->net_pay, 2)}}</td>
										<td>
                                            <button class="btn btn-primary btn-sm">view</button>
                                        </td>
									</tr>
                                    @endforeach


								</tbody>
								
							</table>
						</div>
					</div>
				</div>

                <div class="col-md-6 mx-auto py-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/generate-schedule" method="post">
                                @csrf
                                <div class="py-2">
                                    <label for="date">Enter date:</label>
                                    <input id="date" type="date" name="date" class="form-control">
                                </div>
                                <div class="py-2">
                                    <label for="days">Enter number of days:</label>
                                    <input id="days" type="number" name="days" class="form-control">
                                </div>

                                <div class="py-2">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



    </div>


@endsection
