@extends('layouts.app')

@section('content')

<div class="page-content">

    <div class="container">
        <h4 class="py-5">Hi, {{Auth::user()->name}}</h4>
    </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            
            <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">My Deliveries</p>
                            <h4 class="my-1 text-danger">0</h4>
                          
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                            <i class='lni lni-delivery' ></i>
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
                                <p class="mb-0 text-secondary">Delivery Rate</p>
                                <h4 class="my-1 text-success">0%</h4>
                               
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='lni lni-delivery' ></i>
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
                                <p class="mb-0 text-secondary">Submitted</p>
                                <h4 class="my-1 text-warning">0</h4>
                           
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div><!--end row-->

         <div class="row">
        <div class="col-12 col-lg-8 col-xl-8">
          <div class="card radius-10">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0 py-1">Installation Points</h6>
                    </div>
                    
                </div>
               </div>
             <div class="card-body">
                    <div id="dashboard-map" style="height: 250px"></div>
                    
                    <div class="mb-4 d-none">
                        <p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span class="float-end">50%</span></p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 50%"></div>
                        </div>
                    </div>
                    
                    
             </div>
           </div>
        </div>

  
     </div><!--End Row-->
</div>


    
@endsection