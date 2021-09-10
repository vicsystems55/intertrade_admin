@extends('layouts.app')


@section('content')


<div class="page-content">
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
            <div class="container py-2">
                <h2 class="font-weight-light text-center text-muted py-3">Truck Routes</h2>


                <div class="card">
                    <div class="card-body">
                        <h6>Sort Routes By Deployments</h6>
                    </div>
                </div>
                <!-- timeline item 1 -->
               
                <!--/row-->
                <!-- timeline item 2 -->
                <div class="row g-0">

                    <div class="col-sm py-2">
                        <div class="card border-primary shadow radius-15">
                            <div class="card-body">
                                <div class="float-end text-primary small">Jan 10th 2019 8:30 AM</div>
                                <h4 class="card-title text-primary">Day 2 Kaduna Delivery</h4>
                                <p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
                                
                            </div>
                        </div>
                    </div>

                        <!-- timeline item 1 center dot -->
                        @include('general.line_dot')
                        <!-- timeline item 1 event content -->

                        <div class="col-sm">
                            <!--spacer-->
                        </div>

                        
                </div>
                <!--/row-->
                <!-- timeline item 3 -->
              
                <!--/row-->
                <!-- timeline item 4 -->
                
                <!--/row-->
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