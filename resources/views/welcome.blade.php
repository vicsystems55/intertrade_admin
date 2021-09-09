<!doctype html>
<html lang="en" class="semi-dar">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{config('app.url')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{config('app.url')}}assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{config('app.url')}}assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{config('app.url')}}assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{config('app.url')}}assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{config('app.url')}}assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{config('app.url')}}assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{config('app.url')}}assets/css/app.css" rel="stylesheet">
	<link href="{{config('app.url')}}assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{config('app.url')}}assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{config('app.url')}}assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{config('app.url')}}assets/css/header-colors.css" />
	<title>InterTrade Admin</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">InterTrade</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<div class="p-5"></div>
			
            @include('layouts.sidebars.admin')
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
        @include('layouts.inc.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

                <div class="container">
                    <h4 class="py-5">Hi, Eghosa Udegbe</h4>
                </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                        <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Orders</p>
                                        <h4 class="my-1 text-info">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
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
                                        <p class="mb-0 text-secondary">Contracts</p>
                                        <h4 class="my-1 text-danger">$84,245</h4>
                                        <p class="mb-0 font-13">+5.4% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
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
                        <div class="col">
                            <div class="card radius-10 border-start border-0 border-3 border-warning">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary">Staff</p>
                                            <h4 class="my-1 text-warning">8.4K</h4>
                                            <p class="mb-0 font-13">+8.4% from last week</p>
                                        </div>
                                        <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
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
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
            @include('layouts.inc.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{config('app.url')}}assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{config('app.url')}}assets/js/jquery.min.js"></script>
	<script src="{{config('app.url')}}assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{config('app.url')}}assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{config('app.url')}}assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{config('app.url')}}assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{config('app.url')}}assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{config('app.url')}}assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{config('app.url')}}assets/plugins/chartjs/js/Chart.extension.js"></script>
	<script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<!--Morris JavaScript -->
	<script src="{{config('app.url')}}assets/plugins/raphael/raphael-min.js"></script>
	<script src="{{config('app.url')}}assets/plugins/morris/js/morris.js"></script>
	<script src="{{config('app.url')}}assets/js/index2.js"></script>
	<!--app JS-->
	<script src="{{config('app.url')}}assets/js/app.js"></script>
</body>

</html>