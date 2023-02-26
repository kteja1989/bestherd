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
              <h5 class="font-bold uppercase text-gray-900">Role Creation Form</h5>
            </div>
            <div class="w-2/4 p-5">
							{!! Form::open(['method' => 'POST', 'route' => ['roles.store']]) !!}
							<label class="block text-gray-900 text-sm font-normal mb-2" for="username">
								Role Name*
							</label>
							<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Name" />
							<p class="help-block"></p>
							@if($errors->has('name'))
                <p class="help-block text-red-200 text-sm font-normal">
                    {{ $errors->first('name') }}
                </p>
							@endif

							<label class="block text-gray-900 text-sm font-normal mt-5 mb-1" for="permissions">
								Permissions*
							</label>
							<div class="p-1">
								<span class="bg-yellow-200">
									<select class="block appearance-none w-full bg-gray-100 border border-gray-200 p-4 text-gray-600 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="permission[]" name="permission[]" multiple>
										@foreach ($permissions as $perm)
											<option>{{ $perm }}</option>
										@endforeach
									</select>
								</span>
							</div>
              <p class="help-block"></p>
              @if($errors->has('permission'))
                <p class="help-block text-red-200 text-sm font-normal">
                  {{ $errors->first('permission') }}
								</p>
              @endif
							<div class="py-4 mt-2">
								<x-button class="btn btn-xs text-xs text-gray-800 btn-info p-1">Save</x-button>
								{!! Form::close() !!}
							</div>
						</div>
						</div>
					</div>
				</div>
				<!--/table Card-->
		</div>
	</div>
	<!--/container-->
@stop
