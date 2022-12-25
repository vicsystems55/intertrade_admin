<!doctype html>

@auth

    @if(Auth::user()->role == 'superadmin')

    <html lang="en" class="semi-dark">
    @else 
    <html lang="en" class="">
    
    @endif

@else 
<html lang="en" class="">
@endauth
<html lang="en" class="">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{config('app.url')}}assets/images/favicon-32x32.png" type="image/png" />
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

	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>InterTrade Admin</title>
</head>

<body>
	<!--wrapper-->
	<div id="app" class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{config('app.url')}}assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">InterTrade</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<div class="p-5"></div>



            @if (Auth::user()->role == 'superadmin')

                @include('layouts.sidebars.superadmin')

                
            @elseif(Auth::user()->role == 'admin')

                @include('layouts.sidebars.admin')


            @elseif(Auth::user()->role == 'driver')

                @include('layouts.sidebars.driver')


            @elseif(Auth::user()->role == 'technician')

                @include('layouts.sidebars.technician')


            @elseif(Auth::user()->role == 'secretary')

                @include('layouts.sidebars.secretary')


            @elseif(Auth::user()->role == 'accounts')

                 @include('layouts.sidebars.accounts')

            
        @endif
			
            


			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
        @include('layouts.inc.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			@yield('content')

           
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


	
    <script src="{{asset('js/app.js')}}"></script>

	


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 


	@yield('script-content')


</body>

</html>