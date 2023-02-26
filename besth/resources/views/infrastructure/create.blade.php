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
              				<h5 class="font-bold uppercase text-gray-900">Form: Create New Infrastructure</h5>
            			</div>
            			<div class="w-full p-5">
							{!! Form::open(['method' => 'POST', 'route' => ['infrastructure.store']]) !!}
							<label class="block text-gray-900 text-sm font-bold mb-2" for="username">
								Name* / Nick Name
							</label>
							<input class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" type="text" placeholder="Name" value="Isolator-4">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/3 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="nickname" type="text" value="Iso-4" placeholder="Nick Name">
							<p class="help-block">
								@if($errors->has('name'))
                  					<p class="help-block text-red-900">
                    					{{ $errors->first('name') }}
                  					</p>
								@endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Description
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="desc" type="text" value="Isolator for KO mice" placeholder="Description">
			                <p class="help-block">
			                @if($errors->has('desc'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('email') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Date Acquired/Make/Model
							</label>
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="dateacqrd" type="date" value="2020-10-01" placeholder="Date Acquired">/
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="make" type="text" value="ABC iso "placeholder="Make">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="model" type="text" value="iso-Abc-f023" placeholder="Model">
			                <p class="help-block">
			                @if($errors->has('dateacqrd'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('dateacqrd') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Vendor & Address
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="vendor" type="text" value="ABC Iso limited" placeholder="Vendor & Address">
			                <p class="help-block">
			                @if($errors->has('vendor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('vendor') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Vendor Phone/Email
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/3 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="phone" type="text" value="434556743" placeholder="Phone">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/3 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="email" type="email" value="abc@info.ltd" placeholder="Email">
			                <p class="help-block">
			                @if($errors->has('phone'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('phone') }}
			                  	</p>
			                @endif
							</p>
							<p class="help-block">
			                @if($errors->has('email'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('email') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Location Building/Floor/Room
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="building" value="Main Building" type="text" placeholder="Building">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="floor" type="text" value="First floor" placeholder="Floor">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="room" type="text" value="Room-1" placeholder="Room">
			                <p class="help-block">
			                @if($errors->has('building'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('building') }}
			                  	</p>
			                @endif
							</p>
							<p class="help-block">
			                @if($errors->has('floor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('floor') }}
			                  	</p>
			                @endif
							</p>
							<p class="help-block">
			                @if($errors->has('room'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('room') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								AMC/Strat/End
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amc" type="text" value="AMC" placeholder="AMC">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amcstart" type="text" value="2021-10-01" placeholder="AMC Start">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amcend" type="text" value="2022-09-30" placeholder="AMC End">
			                <p class="help-block">
			                @if($errors->has('amc'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('amc') }}
			                  	</p>
			                @endif
							</p>
							<p class="help-block">
			                @if($errors->has('amcstart'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('amcstart') }}
			                  	</p>
			                @endif
							</p>
							<p class="help-block">
			                @if($errors->has('amc'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('amcend') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Supervisor
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="supervisor" type="text" value="2" placeholder="Supervisor">
			                <p class="help-block">
			                @if($errors->has('supervisor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('supervisor') }}
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
	</div>
	<!--/container-->
@stop
