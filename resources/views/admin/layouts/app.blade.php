<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Badya VMS, Vehicle Management System">
		<meta name="Author" content="SBadya">
		<meta name="Keywords" content="Badya VMS, Vehicle Management System"/>
		@include('admin.includes.head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('admin.includes.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('admin.includes.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('content')
				@include('admin.includes.sidebar')
				@include('admin.includes.models')
            	{{-- @include('admin.includes.footer') --}}
				@include('admin.includes.footer-scripts')
				@toastr_render
			</div>
	</body>
</html>
