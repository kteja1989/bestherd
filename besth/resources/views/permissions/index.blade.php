@extends('layouts.nGlobal')
@section('content')
<!--Container-->
<div class="container min-h-screen mx-auto pt-20">
	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

		<!--Console Content-->
		<div class="flex flex-wrap">

			<!--Metric Card-->
        <div class="w-full md:w-1/4 xl:w-1/3 p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
            <div class="flex flex-row items-center">
              <div class="flex-shrink pr-4">
                <div class="rounded p-3 bg-yellow-600">
									<a href="{{ route('permissions.create') }}">
										<i class="fas fa-user-plus fa-1x fa-fw fa-inverse"></i>
									</a>
								</div>
              </div>
              <div class="flex-1 text-right md:text-center">
                <h5 class="font-bold uppercase text-gray-900">Add</h5>

              </div>
            </div>
          </div>
        </div>
			<!--/Metric Card-->

			<!--Metric Card -->
				<div class="w-full md:w-1/4 xl:w-1/3 p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
            <div class="flex flex-row items-center">
              <div class="flex-shrink pr-4">
                <div class="rounded p-3 bg-green-600">
									<a href="{{ route('roles.index') }}">
										<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
									</a>
								</div>
              </div>
              <div class="flex-1 text-left md:text-center">
                <h5 class="font-bold uppercase text-gray-900">Roles</h5>
                <h5 class="font-normal text-left text-sm text-gray-900">Defined Roles </h5>
              </div>
            </div>
          </div>
				</div>
			<!--/End Metric Card -->

			<!--Metric Card -->
        <div class="w-full md:w-1/4 xl:w-1/3 p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
            <div class="flex flex-row items-center">
              <div class="flex-shrink pr-4">
                <div class="rounded p-3 bg-orange-600">
									<a href="{{ route('users.index') }}">
										<i class="fas fa-users fa-1x fa-fw fa-inverse"></i>
									</a>
								</div>
              </div>
              <div class="flex-1 text-right md:text-center">
                <h5 class="font-bold uppercase text-gray-900">Users</h5>
                <h5 class="font-normal text-left text-sm text-gray-900">{{ Auth::user()->count() }}</h5>
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
            <h5 class="font-bold uppercase text-gray-600">@lang('global.app_list') of Permissions</h5>
          </div>
          <div class="p-5">
            <table class="w-full p-5 text-gray-900">
              <thead class="py-4 text-xs text-gray-900">
                <tr >
                  <th class="py-4 text-left"><input type="checkbox" id="select-all" /></th>
                  <th class="py-4 text-left text-xs">@lang('global.permissions.fields.name')</th>
                  <th class="py-4 text-left text-xs">Operations</th>
                </tr>
              </thead>
                <tbody>
									@if (count($permissions) > 0)
                    @foreach ($permissions as $permission)
                      <tr class="text-xs text-gray-900" py-3data-entry-id="{{ $permission->id }}">
                        <td></td>
                        <td>
													<span class="label label-info label-many">{{ $permission->name }};</span>
                        </td>
												<td>
                          <a href="{{ route('permissions.edit',[$permission->id]) }}">
														<x-button class="btn btn-xs bg-blue-800 hover:bg-green-700 text-xs text-gray-200 btn-info">@lang('global.app_edit')</x-button>
													</a>

                          {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['permissions.destroy', $permission->id])) !!}
                            <x-button class="btn bg-orange-800 hover:bg-red-700 btn-xs btn-danger">Delete</x-button>
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  @else
                      <tr>
                        <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                      </tr>
                  @endif

              </tbody>
            </table>
          </div>
        </div>
      </div>
			<!--/table Card-->
    </div>
		<!--/ Console Content-->
	</div>
</div>
<!--/container-->
@section('javascript')
  <script>
      window.route_mass_crud_entries_destroy = '{{ route('permissions.mass_destroy') }}';
  </script>
@endsection
