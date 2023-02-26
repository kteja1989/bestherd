@extends('layouts.nGlobal')
@section('content')
<!--Container-->
<div class="container min-h-screen w-full mx-auto pt-20">
	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
	<!--Console Content-->
	<h5 class="font-normal uppercase text-gray-900">Facility Home</h5>
	<hr class="border-b-2 border-gray-600 my-2 mx-4">
		<div class="flex flex-wrap">
			@hasanyrole('herdmanager')
				<!--Metric Card-->
				<div class="w-full md:w-1/2 xl:w-1/4 sm:w-1/4 p-3">
					<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
						<div class="flex flex-row items-center">
							<div class="flex-shrink pr-4">
								<div class="rounded p-3 bg-indigo-600">
									<a href="/infrastructure" >
										<i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
									</a>
								</div>
							</div>
							<div class="flex-1 text-right md:text-center">
								<h5 class="font-bold uppercase text-gray-900">Infrastructure</h5>
								<h3 class="font-normal text-left text-1xl text-gray-600">Total Items {{ $totInfraItems }} </h3>
							</div>
						</div>
					</div>
				</div>
				<!--/Metric Card-->
				<!--Metric Card-->
				<div class="w-full md:w-1/2 xl:w-1/4 sm:w-1/4 p-3">
					<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
						<div class="flex flex-row items-center">
							<div class="flex-shrink pr-4">
								<div class="rounded p-3 bg-red-600">
									<a href="/maintenance" >
										<i class="fas fa-inbox fa-2x fa-fw fa-inverse"></i>
									</a>
								</div>
							</div>
							<div class="flex-1 text-right md:text-center">
								<h5 class="font-bold uppercase text-gray-900">Maintenance</h5>
								<h5 class="font-bold text-sm text-gray-600"></h5>
							</div>
						</div>
					</div>
				</div>
				<!--/Metric Card-->
				@endhasanyrole

				@hasanyrole('herdmanager')
				<!--Metric Card-->
				<div class="w-full md:w-1/2 xl:w-1/4 sm:w-1/4 p-3">
					<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
						<div class="flex flex-row items-center">
							<div class="flex-shrink pr-4">
								<div class="rounded p-3 bg-red-600">
									<a href="/manage-goats" >
										<i class="fas fa-paw fa-2x fa-fw fa-inverse"></i>
									</a>
								</div>
							</div>
							<div class="flex-1 text-right md:text-center">
								<h5 class="font-bold uppercase text-gray-900">Goat Profile</h5>
								<h5 class="font-bold text-sm text-gray-600"></h5>
							</div>
						</div>
					</div>
				</div>
				<!--/Metric Card-->
				<!--Metric Card-->
				<div class="w-full md:w-1/2 xl:w-1/4 sm:w-1/4 p-3">
					<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
						<div class="flex flex-row items-center">
							<div class="flex-shrink pr-4">
								<div class="rounded p-3 bg-red-600">
									<a href="/daily-records" >
										<i class="fas fa-inbox fa-2x fa-fw fa-inverse"></i>
									</a>
								</div>
							</div>
							<div class="flex-1 text-right md:text-center">
								<h5 class="font-bold uppercase text-gray-900">Daily Records</h5>
								<h5 class="font-bold text-sm text-gray-600"></h5>
							</div>
						</div>
					</div>
				</div>
				<!--/Metric Card-->
			@endhasanyrole
		</div>
		<!--End of Console content-->

	<!--Divider-->
	<hr class="border-b-2 border-gray-600 my-8 mx-4">
	<!--Divider-->

	<div class="flex flex-row flex-wrap flex-grow mt-2">
	<!-- Left Panel Graph Card-->
		<div class="w-full md:w-1/3 p-3">
			<div class="bg-orange-100 border border-gray-800 rounded shadow">
				<div class="border-b border-gray-800 p-3">
					<h5 class="font-bold uppercase text-gray-900">List</h5>
				</div>
				<div class="p-5">
					<canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
				</div>
			</div>
		</div>
		<!-- / End of Left Panel Graph Card-->

		<!-- Right Panel Graph Card-->
		<div class="w-full md:w-2/3 p-3">
			<div class="bg-orange-100 border border-gray-800 rounded shadow">
				<div class="border-b border-gray-800 p-3">
					<h5 class="font-bold uppercase text-gray-900">Details</h5>
				</div>
				<div class="p-5">
					<canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
				</div>
			</div>
		</div>
	<!-- Right Panel Graph Card-->
	</div>
	</div>
</div>
<!--/container-->
