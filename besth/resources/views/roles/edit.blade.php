@extends('layouts.nGlobal')
@section('content')
	<!--Container-->
	<div class="container min-h-screen mx-auto pt-20">
		<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
						
			<!--Divider-->
			<hr class="border-b-2 border-gray-600 my-2 mx-4">
			<!--Divider-->
			
      <div class="flex flex-row flex-wrap flex-grow mt-2">
				<!--Table Card-->
				<div class="w-full p-3">
          <div class="bg-gray-900 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-200">Edit Roles</h5>
            </div>
            <div class="p-5">
							{!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
								<div class="form-group">
                    <h5 class="font-bold uppercase text-gray-200">Name*</h5>
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
								<div class="form-group">
								<h5 class="font-bold uppercase text-gray-200">Permissions*</h5>
                    
                    {!! Form::select('permission[]', $permissions, old('permission') ? old('permission') : $role->permissions()->pluck('name', 'id'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('permission'))
                        <p class="help-block">
                            {{ $errors->first('permission') }}
                        </p>
                    @endif
                </div>
							{!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
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

