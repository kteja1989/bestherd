@inject('request', 'Illuminate\Http\Request')
	<?php
	$controller = "";
	$res = explode('.', $request->route()->getName());
	$controller = $res[0];
	//if($res[0] == 'roles'){ $controller = 'users'; }
	//if($res[0] == 'permissions'){ $controller = 'users'; }
	?>
	<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
		<div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
		@include('layouts.nNavInstitution')
		@include('layouts.nNavSideRight')
		<!-- guard/role check and appropriate menus -->
		<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20" id="nav-content">
			<ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">

				<li class="mr-6 my-2 md:my-0">
					<a href="{{ route('home') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-400 no-underline hover:text-gray-100 border-b-2 border-blue-400 hover:border-blue-400">
						<i class="fas fa-home fa-fw mr-3 text-blue-400"></i>
						<span class="pb-1 md:pb-0 text-sm">Investigator</span>
					</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'view-projects')
						<a href="/show-projects" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-pink-200  hover:border-gray-900">
					@else
						<a href="/show-projects" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-pink-200">
					@endif
							<i class="fas fa-tasks fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Projects</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'view-issuerequests')
						<a href="/show-usage" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-orange-200  hover:border-gray-900">
					@else
						<a href="/show-usage" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-orange-200">
					@endif
							<i class="fas fa-chart-area fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Usage</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'ela-book')
						<a href="/ela-book" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
					@else
						<a href="/ela-book" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
					@endif
							<i class="fas fa-chart-area fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Experiments</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
				@if( $controller == 'ela-book')
					<a href="/manage-samples" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
				@else
					<a href="/manage-samples" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
				@endif
						<i class="fa fa-plus-square" aria-hidden="true"></i>
						<span class="pb-1 md:pb-0 text-sm">Samples</span>
					</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'GroupManagementController')
						<a href="/manage-group" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
					@else
						<a href="/manage-group" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
					@endif
							<i class="fa fa-users" aria-hidden="true"></i>
							<span class="pb-1 md:pb-0 text-sm">Group</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'manage-reports')
						<a href="/manage-reports" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
					@else
						<a href="/manage-reports" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
					@endif
							<i class="fa fa-file" aria-hidden="true"></i>
							<span class="pb-1 md:pb-0 text-sm">Reports</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'manage-tasks')
						<a href="/manage-tasks" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
					@else
						<a href="/manage-tasks" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
					@endif
							<i class="fas fa-tasks"></i>
							<span class="pb-1 md:pb-0 text-sm">Tasks</span>
						</a>
				</li>
				
			</ul>
			<!-- guard/role check and appropriate menus -->
			</div>
		</div>
	</nav>
