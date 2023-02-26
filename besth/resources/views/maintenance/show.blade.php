@extends('layouts.nGlobal')
@section('content')
	<!--Container-->
<div class="container min-h-screen mx-auto pt-20">
	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
		<!--Divider-->
		<hr class="border-b-2 border-gray-600 my-2 mx-4">
			<!--Divider-->
    <div class="flex flex-row flex-wrap flex-grow mt-2">
			<div class="w-full p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow">
					<div class="border-b border-gray-800 p-3">
						<h5 class="font-bold uppercase text-gray-900">Infrastructure</h5>
					</div>
			  	<div class="w-full p-5">
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
								</tr>
							</thead>
							<tbody>
								@if(!empty($infra))
									<tr  class="text-xs text-gray-900 py-3" data-entry-id="{{ $infra->infra_id }}">
										<td class="px-4 py-4 text-sm text-gray-900">{{ $infra->name }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ date('d-m-Y', strtotime($infra->date_acquired)) }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->make }} / {{ $infra->model }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->vendor_address}}</br>{{ $infra->vendor_phone }}</br>{{ $infra->vendor_email }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->building}}</br>{{ $infra->floor }}</br>{{ $infra->room }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->amc}}</br>{{ $infra->amc_start }}</br>{{ $infra->amc_end }}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->supervisor}}</td>
										<td class="px-2 py-4 text-sm text-gray-900">{{ $infra->status }}</td>
									</tr>
								@else
									<tr>
										<td colspan="9">@lang('global.app_no_entries_in_table')</td>
									</tr>
								@endif
							</tbody>
						</table>
			      </br>
						<!--Divider-->
						<hr class="border-b-2 border-gray-600 my-2 mx-4">
			      </br>
						<h5 class="font-bold uppercase text-gray-900">Maintenance Records</h5>
			      <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
							<thead class="bg-gray-900">
								<tr class="text-white text-left">
									<th class="font-semibold text-sm uppercase px-4 py-2"> Supervisor </th>
									<th class="font-semibold text-sm uppercase px-2 py-2"> Type </th>
									<th class="font-semibold text-sm uppercase px-2 py-2"> Maintenance Date</th>
									<th class="font-semibold text-sm uppercase px-2 py-2"> Description</th>
									<th class="font-semibold text-sm uppercase px-2 py-2"> Last Update On </th>
									<th class="font-semibold text-sm uppercase px-2 py-2"> File </th>
								</tr>
							</thead>
			  			<tbody>
								@if(!empty($mrs))
									@foreach($mrs as $val)
			        			<tr  class="text-xs text-gray-900 py-3" data-entry-id="{{ $val->infra_id }}">
			        				<td class="px-4 py-4 text-sm text-gray-900">{{ $val->supervisor }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->type }}</td>
			        				<td class="px-2 py-4 text-sm text-gray-900">{{ date('d-m-Y', strtotime($val->done_date)) }}</td>
							 				<td class="px-2 py-4 text-sm text-gray-900">{{ $val->description }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">{{ $val->updated_at }}</td>
											<td class="px-2 py-4 text-sm text-gray-900">
												<a href="{{ route('maintenance.report',[$val->filename]) }}">
													<x-button class="btn btn-xs bg-grey-800 hover:bg-orange-700 btn-info">
														Show
													</x-button>
												</a>
			        				</td>
			        			</tr>
									@endforeach
								@else
			    				<tr>
			      				<td colspan="9">@lang('global.app_no_entries_in_table')</td>
			    				</tr>
								@endif
						 	</tbody>
						</table>

			      </br>
						<hr class="border-b-2 border-gray-600 my-2 mx-4">
						<h5 class="font-bold uppercase text-gray-900">Enter New</h5>
						</br>

						{!! Form::open(['method' => 'POST', "enctype" => "multipart/form-data", 'route' => ['maintenance.store']]) !!}
						<label class="block text-gray-900 text-sm font-bold mb-2" for="username">
							Supervisor Name
						</label>
						<input class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="supname" type="text" placeholder="Supervisor Name" value="{{ $infra->user->name }}">
							@if($errors->has('supname'))
								<p class="help-block text-red-900">
			  					{{ $errors->first('supname') }}
								</p>
							@endif
						</p>

						<label class="block text-gray-900 text-sm font-bold mb-2 py-2" for="username">
							Infrastructure Name
						</label>
						<input class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="infname" type="text" placeholder="Name" value="{{ $infra->name }}">
						<p class="help-block">
							@if($errors->has('infname'))
								<p class="help-block text-red-900">
			  					{{ $errors->first('infname') }}
								</p>
							@endif
						</p>

						<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
							Type
						</label>
						<select name="mrsType">
							<option value="Routine">Routine</option>
							<option value="AMC">AMC</option>
							<option value="Emergency">Emergency</option>
						</select>
                        <p class="help-block">
                            @if($errors->has('mrsType'))
                            	<p class="help-block text-red-900">
                              	{{ $errors->first('mrsType') }}
                            	</p>
                            @endif
						</p>

						<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
							Maintenance Date
						</label>
						<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="doneDate" type="date" placeholder="Date Done">
                        <p class="help-block">
                            @if($errors->has('doneDate'))
                            	<p class="help-block text-red-900">
                              	{{ $errors->first('doneDate') }}
                            	</p>
                            @endif
                        </p>

						<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
							Description
						</label>
			    	    <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="desc" type="text" placeholder="Description">
                        <p class="help-block">
                            @if($errors->has('desc'))
                            	<p class="help-block text-red-900">
                              	{{ $errors->first('desc') }}
                            	</p>
                            @endif
						</p>
						
						<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
							Upload Service Report/File (only .pdf)
						</label>
						{!! Form::file('userfile',  ['class'=>"text-gray-900 text-xs font-normal", "file"=>"true", "enctype" => "multipart/form-data"]) !!}
                        <p class="help-block">
                            @if($errors->has('phone'))
                            	<p class="help-block text-red-900">
                              	{{ $errors->first('phone') }}
                            	</p>
                            @endif
						</p>
						
						<div class="py-4 mt-2">
							<x-button class="btn btn-xs text-xs text-gray-100 btn-info p-1">Submit</x-button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/table Card-->
  </div>
	<!--/ Console Content-->
</div>
<!--/container-->
@stop
