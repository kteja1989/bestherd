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
							{!! Form::model($infra, ['method' => 'PUT', 'route' => ['infrastructure.update', $infra->infra_id]]) !!}
							<label class="block text-gray-900 text-sm font-bold mb-2" for="username">
								Name* / Nick Name
							</label>
							{{ $infra->name }} ( Nick Name:
							{{ $infra->nickName }} )

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Description
							</label>
			              	{{ $infra->description }}
			                <p class="help-block">

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Date Acquired/Make/Model
							</label>
							{{ $infra->date_acquired }} / {{ $infra->make }} / {{ $infra->model }}

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Vendor & Address
							</label>
			              	{{ $infra->vendor_address }}

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Vendor Phone/Email
							</label>
			              	{{ $infra->vendor_phone }} / {{ $infra->vendor_email }}

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Location Building/Floor/Room
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="building" value="{{ $infra->building }}" type="text" placeholder="Building">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="floor" type="text" value="{{ $infra->floor }}" placeholder="Floor">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="room" type="text" value="{{ $infra->room }}" placeholder="Room">
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
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amc" type="text" value="{{ $infra->amc }}" placeholder="AMC">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amcstart" type="text" value="{{ $infra->amcstart }}" placeholder="AMC Start">/
							<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="amcend" type="text" value="{{ $infra->amcend }}" placeholder="AMC End">
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
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="supervisor" type="text" value="{{ $infra->user->name }}" placeholder="Supervisor">
			                <p class="help-block">
			                @if($errors->has('supervisor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('supervisor') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Status
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="status" type="text" value="{{ $infra->status }}" placeholder="Status">
			                <p class="help-block">
			                @if($errors->has('supervisor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('supervisor') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Date of Disposal
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="date_disposal" type="text" value="" placeholder="Disposal Date">
			                <p class="help-block">
			                @if($errors->has('supervisor'))
			                  	<p class="help-block text-red-900">
			                    	{{ $errors->first('supervisor') }}
			                  	</p>
			                @endif
							</p>

							<label class="block text-gray-900 text-sm pt-4 font-bold mb-2" for="email">
								Disposal Description
							</label>
			              	<input class="shadow appearance-none border border-red-500 rounded w-1/4 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="disposal_mode" type="text" value="" placeholder="Disposal Mode">
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
