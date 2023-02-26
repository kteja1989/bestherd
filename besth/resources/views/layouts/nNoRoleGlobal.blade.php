<!DOCTYPE html>
	<html lang="en">
		<head>
			<!-- header -->
			@include('layouts.nHeader')
			<!--end of header -->
			@livewireStyles
		</head>

		<body class="bg-black-alt font-sans leading-normal tracking-normal">
			<!-- navbar -->
			<!--end of navbar-->
			@include('layouts.nNavbarNoRole')
			<!--Container-->
			@yield('content')
			<!--end of container-->

			<!--begin footer-->
			@include('layouts.nFooter')
			<!--end of footer-->

			<!--scripts-->
			@livewireScripts
			@include('layouts.nScripts')

			<!--end of scripts-->
		</body>
	</html>
