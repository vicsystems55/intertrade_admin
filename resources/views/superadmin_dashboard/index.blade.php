@extends('layouts.app')

@section('content')

<div class="page-content">

    <div class="container">
        <h4 class="py-5">Hi, {{Auth::user()->name}}</h4>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
       <a href="{{route('admin.all_products')}}">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Products</p>
                            <h4 class="my-1 text-info">{{$products->count()}}</h4>
                            <p class="mb-0 font-13">+2.5% from last week</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
            </div>
            </div>
       </a>
      <a href="{{route('admin.transactions')}}">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Sales</p>
                            <h4 class="my-1 text-success">N {{number_format(($total),2)}}  </h4>
                            <p class="mb-0 font-13">N {{number_format(($total),2)}} </p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
            </div>
      </a>
        <div class="col d-none">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Bounce Rate</p>
                            <h4 class="my-1 text-success">34.6%</h4>
                            <p class="mb-0 font-13">-4.5% from last week</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <a href="/admin/customer">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Customers</p>
                            <h4 class="my-1 text-warning">{{$customers->count()}}</h4>
                            <p class="mb-0 font-13">+8.4% from last week</p>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </a>
    </div><!--end row-->


    <div class="row">
        <div class="col-md-12 ">
            <div class="card overflow-auto">
                <div class="card-body">
                    <div style="min-width: 500px;" id="chart3"></div>
                </div>
            </div>
        </div>
    </div>

         <div class="row d-none">
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

        <div class="col-12 col-lg-4 col-xl-4">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0 py-1">Sales This Week</h6>
                        </div>

                    </div>
                   </div>
                <div class="card-body">
                 <div id="chart11" style="height:250px;"></div>
               </div>
           </div>




        </div>
     </div><!--End Row-->
</div>



@endsection


@section('script-content')

<script src="{{config('app.url')}}assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/apexcharts-bundle/js/apex-custom.js"></script>

@endsection
