@extends('layouts.nNoRoleGlobal')
@section('content')
  <!--Container-->
  <div class="container w-full mx-auto pt-20">
  	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
  		<!--Console Content-->
  		<div class="flex flex-wrap">
  	  </div>
	    <!--End of Console content-->

    	<!--Divider-->
    	<hr class="border-b-2 border-gray-600 my-8 mx-4">
    	<!--Divider-->

  		<div class="flex flex-row flex-wrap flex-grow mt-2">
  			<!-- Left Panel Graph Card-->
  			<!-- / End of Left Panel Graph Card-->
  			<!-- Right Panel Graph Card-->
  			<div class="w-full md:w-full p-3">
  				<div class="bg-orange-100 border border-gray-800 rounded shadow">
  					<div class="border-b border-gray-800 p-3">
  						<h5 class="font-bold uppercase text-gray-600">General Information</h5>
  					</div>
  					<div class="p-5">
  						<h5> <strong>Note</strong>: {{ $slot }}</h5>
  					</div>
  				</div>
  			</div>
  			<!-- / End of right Panel Graph Card-->
  			<!--Table Card-->
  			<!--/table Card-->
  		</div>
  	<!--/ Console Content-->
  	</div>
  </div>
  <!--/container-->
