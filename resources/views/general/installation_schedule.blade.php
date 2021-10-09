@extends('layouts.app')


@section('content')


<div class="page-content card">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Installation Schedule</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Timeline</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
           
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="">
        <div class="">
            
            <!--container-->
            <hr>

            <div class=" {{Auth::user()->role =='superadmin'?'':'d-none'}} c text-center">
                <a href="{{route('superadmin.create_installation_schedule')}}" class="btn btn-primary col-md-6 shadow">Create Schedule</a>
            </div>

            <div class="col-md-6 mx-auto p-md-3">
                <form action="{{route('superadmin.installation_schedule')}}" method="get">
                    <label for="">Select Technician</label>
                    <select name="technician_assigned" id="" class="form-control mb-3">
             
                        <option value="{{old('technician_assigned')}}">All</option>
                        @foreach ($users as $user)
    
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @endforeach
                       
                      
                    </select>

                    <div class="form-group mb-3 text-center">
                        <button class="btn btn-primary col-md-6 mx-auto">Filter</button>
                    </div>
                
                </form>
             
            </div>
            <div class="row">
                <div class="  {{Auth::user()->role=='driver'?'col-md-12':'col-md-12'}}">

                    <div class="container py-2">
                     
        
                        <!-- timeline item 1 -->
                       
                        <!--/row-->
                        <!-- timeline item 2 -->
                        @foreach ($installation_schedules as $trucka)

                        <div class="row g-0">
        
                            <div class="col-sm py-2">
                                <div class="card border-primary shadow radius-15">
                                    <div class="card-body">
                                        <div class="float-en text-primary small">Installation Date:<br>  <strong>- - - </strong></div>
                                      
                                        <div class="">

                                            <h4 class="card-titl text-primary">{{$trucka->deployments->facility_name}}</h4>
                                            <p class="card-text">{{$trucka->deployments->facility_address}}</p>

                                            {{-- <h6 class="card-text ml-2">0 / {{$trucka->deployments->no_ucc}}</h6> --}}
                                            <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-warning text-dark">
                                               INSTALLED : 0
                                            </span> 

                                            /

                                            <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-warning text-dark">
                                                REQUIRED : {{$trucka->deployments->no_ucc}}
                                            </span>

                                                <div class="py-2">
                                                    <a href="" class="float-right  btn btn-primary btn-sm">View Report</a>
                                                </div>

                                            

                                        </div>

                                       

                                        
                                    </div>
                                </div>
                            </div>
        
                                <!-- timeline item 1 center dot -->
                                @include('general.line_dot')
                                <!-- timeline item 1 event content -->
        
                                <div class="col-sm">
                                    <!--spacer-->
                                    <div class="p-5"></div>
                                   
                                        <img src="{{$trucka->technicians->avatar}}" style="height: 50px;" class="shadow rounded rounded-circle" alt=""> <br>

                                        <strong class="mt-2" >Technician: <br> {{$trucka->technicians->name}}</strong>
                                </div>
        
                                
                        </div>
                            
                        @endforeach
                        <!--/row-->
                        <!-- timeline item 3 -->
                      
                        <!--/row-->
                        <!-- timeline item 4 -->
                        
                        <!--/row-->
                    </div>

                </div>

        
                
            </div>
            
        </div>
    </div>
</div>

@section('script-content')


<script src="{{config('app.url')}}assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{config('app.url')}}assets/js/jquery.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="{{config('app.url')}}assets/js/app.js"></script>
    
@endsection
    
@endsection