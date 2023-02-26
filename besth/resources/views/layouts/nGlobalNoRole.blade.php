<!DOCTYPE html>
	<html lang="en">
		<head>
		<!-- header -->
		@include('layouts.nHeaderNoRole')
		<!--end of header -->
		@livewireStyles
		</head>

		<body class="bg-black-alt font-sans leading-normal tracking-normal">
		<!-- navbar -->
			@include('layouts.nNavbarNoRole')
		<!--Container-->
			@yield('content')
		<!--end of container-->
		<!--begin footer-->
			@include('layouts.nFooter')
		<!--end of footer-->
		<!--scripts-->
			@include('layouts.nScripts')
			@livewireScripts
		<!--end of scripts-->
		</body>
	</html>
