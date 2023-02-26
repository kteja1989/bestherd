@extends('layouts.nGlobal')
@section('content')

<!--Container-->
<div class="container min-h-screen mx-auto pt-20">
	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

		<!--Console Content-->
		<div class="flex flex-wrap">
    		<!--Metric Card-->
        	<div class="w-full md:w-1/2 xl:w-1/3 p-3">
          		<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
            		<div class="flex flex-row items-center">
              			<div class="flex-shrink pr-4">
                			<div class="rounded p-3 bg-yellow-600">
    							<a href="/infrastructure/create">
    								<i class="fas fa-user-plus fa-1x fa-fw fa-inverse"></i>
    							</a>
    						</div>
              			</div>
              			<div class="flex-1 text-right md:text-center">
                			<h5 class="font-bold uppercase text-gray-900">New</h5>
              			</div>
            		</div>
          		</div>
        	</div>
    		<!--/Metric Card-->
    
    		<!--Metric Card -->
    		<div class="w-full md:w-1/2 xl:w-1/3 p-3">
        		<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
              		<div class="flex flex-row items-center">
            			<div class="flex-shrink pr-4">
                  			<div class="rounded p-3 bg-green-600">
        						<a href="/maintenance">
        							<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
        						</a>
        					</div>
            			</div>
            			<div class="flex-1 text-left md:text-center">
              			    <h5 class="font-bold uppercase text-gray-900">Maintenance</h5>
                        </div>
              		</div>
        		</div>
    		</div>
    		<!--/End Metric Card -->
		</div>
		<!--End of Console content-->

		<!--Divider-->
		<hr class="border-b-2 border-gray-600 my-2 mx-4">
		<!--Divider-->

      	<div class="flex flex-row flex-wrap flex-grow mt-2">
			<!--Table Card-->
			<div class="w-full p-3">
          		<div class="bg-orange-100 border border-gray-800 rounded shadow">
            		<div class="border-b border-gray-800 p-3">
              			<h5 class="font-bold uppercase text-gray-900">Infrastructure @lang('global.app_list')</h5>
            		</div>
            		<div class="p-5">
            		    @if(count($infra) > 0 )
            			    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
								<thead class="bg-gray-900">
									<tr class="text-white text-left">
										<th class="font-semibold text-sm uppercase px-4 py-2"> Name </th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Date </br> Acquired </th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Make</br>Model</th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Vendor</br>Address</br>Mail</th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Location </th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> AMC </th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Supervisor</th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Status</th>
										<th class="font-semibold text-sm uppercase px-2 py-2"> Action</th>
									</tr>
								</thead>
              			        <tbody>
									@foreach($infra as $val)
                        			    <tr  class="text-xs text-gray-900 py-3" data-entry-id="{{ $val->infra_id }}">
                              				<td class="px-4 py-4 text-sm text-gray-900">{{ $val->name }}</td>
                              				<td class="px-2 py-4 text-sm text-gray-900">{{ date('d-m-Y', strtotime($val->date_acquired)) }}</td>
							 				<td class="px-2 py-4 text-sm text-gray-900">{{ $val->make }} / {{ $val->model }}</td>
							 				<td class="px-2 py-4 text-sm text-gray-900">{{ $val->vendor_address}}</br>{{ $val->vendor_phone }}</br>{{ $val->vendor_email }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->building}}</br>{{ $val->floor }}</br>{{ $val->room }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->amc}}</br>{{ $val->amc_start }}</br>{{ $val->amc_end }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->supervisor}}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->status }}</td>
                      				        <td class="px-2 py-4 text-sm text-gray-900">
												<a href="{{ route('infrastructure.edit',[$val->infra_id]) }}"> <x-button class="btn btn-xs bg-grey-800 hover:bg-orange-700 btn-info">Edit</x-button></a>
                      				        </td>
                    			        </tr>
								    @endforeach
								</tbody>
            			    </table>
						@else
                    		<table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
								<thead class="bg-gray-900">
									<tr class="text-white text-left">
										<th class="font-semibold text-sm uppercase px-4 py-2"> No Data Available </th>
									</tr>
								</thead>
              			        <tbody>		
              			            <tr>
                      				    <td colspan="9" class="px-4 py-2">@lang('global.app_no_entries_in_table')</td>
                    				</tr>
                				</tbody>
            			    </table>
						@endif
            		</div>
          		</div>
        	</div>
				<!--/table Card-->
      	</div>
			<!--/ Console Content-->
		</div>
	</div>
	<!--/container-->
