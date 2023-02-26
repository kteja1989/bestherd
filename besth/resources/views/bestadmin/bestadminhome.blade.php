@extends('layouts.nGlobal')
@section('content')
	<!--Container-->
	<div class="container w-full mx-auto pt-20">
		<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

			<!--Console Content-->
			<div class="flex flex-wrap">
                @if(tenant('id') == "demo" || tenant('id') == "ybl" ) 
                    
                @endif
				<!--Metric Card 1 -->
				<!--/End Metric Card 1-->

				<!--Metric Card-->
				<!--/Metric Card-->

				<!--Metric Card-->
				<!--/Metric Card-->
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
								<h5 class="font-bold uppercase text-gray-600">List</h5>
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
								<h5 class="font-bold uppercase text-gray-600">Details</h5>
						</div>
						<div class="p-5">
								<h5> This is a first of its kind application that tracks multi species breeding
								and project management that takes the hassle of out labor intensive work. At this stage
								only i.e. Mice and Rat available. Very soon, Rabbit, Zebra Fish and
								Guinea pigs will also be available. In addition, a host of features that makes the management
								easier will be implemented as and when the users wish so. Give us a try to make your life
								easier! </h5>
								<canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
						</div>
					</div>
				</div>
				<!-- / End of right Panel Graph Card-->

				<!--Table Card-->
				<div class="w-full p-3">
					<div class="bg-orange-100 border border-gray-800 rounded shadow">
							<div class="border-b border-gray-800 p-3">
									<h5 class="font-bold uppercase text-gray-600">Actions</h5>
							</div>
							<div class="p-5">
								<table class="w-full p-5 text-gray-700">
									<thead>
										<tr>
											<th class="text-left text-gray-600"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
										</tr>
									</tbody>
								</table>
								<p class="py-2"><a href="#" class="text-white">See More ...</a></p>
							</div>
					</div>
                </div>
				<!--/table Card-->
				
            </div>
			<!--/ Console Content-->
		</div>
	</div>
	<!--/container-->
