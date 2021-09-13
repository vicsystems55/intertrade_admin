@extends('layouts.app')


@section('content')


<div class="page-content card">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Truck Routes</div>
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
                <a href="{{route('superadmin.create_truck_route')}}" class="btn btn-primary col-md-6 shadow">Create Truck Route</a>
            </div>

            <div class="row">
                <div class="  {{Auth::user()->role=='driver'?'col-md-12':'col-md-6'}}">

                    <div class="container py-2">
                        <h2 class="font-weight-light text-center text-muted py-3">
                            <img style="height: 40px;" src="{{config('app.url')}}inventory_images/truck_a.png" alt="">
                            Truck A Routes</h2>
        
        
                        <!-- timeline item 1 -->
                       
                        <!--/row-->
                        <!-- timeline item 2 -->
                        @foreach ($trucka_routes as $trucka)

                        <div class="row g-0">
        
                            <div class="col-sm py-2">
                                <div class="card border-primary shadow radius-15">
                                    <div class="card-body">
                                        <div class="float-en text-primary small">Take Off:<br>  <strong>- - - </strong></div>
                                        <div class="float-en text-success small">Drop Off:<br> <strong>- - -</strong></div>
                                        <div class="">

                                            <h4 class="card-titl text-primary">{{$trucka->deployments->facility_name}}</h4>
                                            <p class="card-text">{{$trucka->deployments->facility_address}}</p>

                                            {{-- <h6 class="card-text ml-2">0 / {{$trucka->deployments->no_ucc}}</h6> --}}
                                            <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-warning text-dark">
                                               DELIVERED : 0
                                            </span> 

                                            /

                                            <span style="font-weight: bold;" class="font-weight-bold badge rounded-pill bg-warning text-dark">
                                                REQUIRED : {{$trucka->deployments->no_ucc}}
                                            </span>

                                            <a href="" class="{{Auth::user()->role=='admin'?'':'d-none'}}  btn btn-primary btn-sm">View Report</a>

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
                                   
                                        <img src="{{$trucka->drivers->avatar}}" style="height: 50px;" class="shadow rounded rounded-circle" alt=""> <br>

                                        <strong class="mt-2" >Driver: <br> {{$trucka->drivers->name}}</strong>
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

                <div class="    {{Auth::user()->role=='driver'?'col-md-12':'col-md-6'}}">

                    <div class="container py-2">
                        <h2 class="font-weight-light text-center text-muted py-3">
                            <img style="height: 40px;" src="{{config('app.url')}}inventory_images/truck_a.png" alt="">
                            Truck B Routes</h2>
        
        
                        <!-- timeline item 1 -->
                       
                        <!--/row-->
                        <!-- timeline item 2 -->
                        @foreach ($truckb_routes as $truckb)

                        <div class="row g-0">
        
                            <div class="col-sm py-2">
                                <div class="card border-primary shadow radius-15">
                                    <div class="card-body">
                                        <div class="float-en text-primary small">Take Off:<br>  <strong>Jan 10th 2019 8:30 AM</strong></div>
                                        <div class="float-en text-success small">Drop Off:<br> <strong>Jan 10th 2019 8:30 AM</strong></div>
                                        <div class="">

                                            <h4 class="card-titl text-primary">{{$truckb->deployments->facility_name}}</h4>
                                            <p class="card-text">{{$truckb->deployments->facility_address}}</p>
                                            <p class="card-text text-danger">{{$trucka->deployments->status}}</p>

                                        </div>
                                       

                                        
                                    </div>
                                </div>
                            </div>
        
                                <!-- timeline item 1 center dot -->
                                @include('general.line_dot')
                                <!-- timeline item 1 event content -->
        
                                <div class="col-sm pt-5">
                                    <!--spacer-->

                                   
                                        <img src="{{$truckb->drivers->avatar}}" style="height: 90px;" class="shadow rounded rounded-circle" alt=""> <br>

                                        <p style="font-weight: bold" class="mt-2" >Driver: <br> {{$truckb->drivers->name}}</p>
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