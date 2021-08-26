<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('dashboard/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('dashboard/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('dashboard/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('dashboard/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('dashboard/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- TOASTER -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('dashboard/assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('dashboard/assets/img/favicon.png')}}">
	<style media="screen">
	@media screen and (max-width: 1000px) {
	 /* .table{
		 overflow: scroll;
	 } */

	 .panel{
		 overflow: scroll;
	 }
	}
	</style>
	@yield('header')
</head>

<body>
    {{-- @include('sweetalert::alert') --}}
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		@include('layouts/dashboard/includes/_navbar')
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@include('layouts/dashboard/includes/_sidebar')
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
		  <div class="main-content">
		    <div class="row">
		      <div class="col-md-12">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">

				</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>{{asset('dashboard/')}}
	<script src="{{asset('dashboard/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('dashboard/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('dashboard/assets/scripts/klorofil-common.js')}}"></script>
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
	{{-- <script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.16.1/full-all/ckeditor.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	@yield('linkfooter')
</body>

</html>
