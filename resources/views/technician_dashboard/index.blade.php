@extends('layouts.app')

@section('content')



<div class="page-content">

    <div class="container">

    </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 d-none">
            <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Installations</p>
                            <h4 class="my-1 text-info">0</h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Reports</p>
                            <h4 class="my-1 text-danger">0</h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
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
                                <p class="mb-0 text-secondary">Total Assigned</p>
                                <h4 class="my-1 text-warning">0</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->


        <div class="row card-box row-eq-height">
            <div class="col-md-6 px-5">
                <div style="height: 450px;"  class=" card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{Auth::user()->avatar}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110">
                            <div class="mt-3">
                                <h4>{{Auth::user()->name}}</h4>
                                <p class="text-secondary mb-1 badge badge-primary">
                                    <span class="badge rounded-pill bg-primary">Staff</span>
                                </p>
                                <p class="text-muted font-size-sm">Abuja</p>

                                @if (Auth::user()->employee_data != null)
                                <a href="{{route('technician.profile')}}" class="btn btn-success">
                                  <i class="fadeIn animated bx bx-check-circle"></i>

                                    Update Completed</a>

                                @else
                                <a href="{{route('technician.profile')}}" class="btn btn-primary">
                                    <i class="fadeIn animated bx bx-edit"></i>

                                    Update Profile</a>

                                @endif


                            </div>
                        </div>
                        <ul class="list-group list-group-flush pt-2">

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone text-primary"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    Phone</h6>
                                <span class="text-secondary">{{Auth::user()->employee_data?Auth::user()->employee_data->phone:'--'}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail text-primary"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    Email</h6>
                                <span class="text-secondary">{{Auth::user()->email}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star text-primary"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    Designation</h6>
                                <span class="text-secondary">Staff</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-5">
                <div style="height: 450px;" class=" card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id='calendar'></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 px-5">
                <div style="min-height: 300px;" class=" card">
                    <div class="card-body">
                        <h6>Notifications</h6>
                        <div class="list-group">

                            @forelse ($notifications as $notification)
                            <a href="javascript:;" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-between">
									<h6 class="mb-1">{{$notification->title}}</h6>
									<small class="text-muted">3 days ago</small>
								</div>
								<p class="mb-1">
                                {{$notification->body}}
                                </p>	<small class="text-muted">{{$notification->created_at}}</small>
							</a>
                            @empty

                            <h6 class="py-3 text-center">No new notifications.</h6>

                            @endforelse



						</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-5">
                <div style="height: 300px;" class=" card">
                    <div class="card-body">

                        <h6>Assignments</h6>


                        <p class="py-5 text-center text-secondary">No assignments.</p>

                    </div>
                </div>
            </div>
        </div>





</div>



@endsection
