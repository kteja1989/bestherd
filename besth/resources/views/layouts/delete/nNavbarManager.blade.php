@inject('request', 'Illuminate\Http\Request')
<?php
	$controller = "";
	$res = explode('.', $request->route()->getName());
	$controller = $res[0];
	if($res[0] == 'roles'){ $controller = 'users'; }
	if($res[0] == 'permissions'){ $controller = 'users'; }
?>
<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
	<div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
	@include('layouts.nNavInstitution')
	@include('layouts.nNavSideRight')
	<!-- guard/role check and appropriate menus -->
		<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20" id="nav-content">
			<ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
				<li class="mr-6 my-2 md:my-0">
					<a href="/home" class="block py-1 md:py-3 pl-1 align-middle text-blue-400 no-underline hover:text-gray-100 border-b-2 border-blue-400 hover:border-blue-400">
						<i class="fas fa-home fa-fw mr-3 text-blue-400"></i>
						<span class="pb-1 md:pb-0 text-sm">
							P-Manager
						</span>
					</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'projects')
						<a href="/projectsmanager" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-pink-200  hover:border-gray-900">
					@else
						<a href="/projectsmanager" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-pink-200">
					@endif
							<i class="fas fa-tasks fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Projects</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'issues')
						<a href="/usageapproval" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-orange-200  hover:border-gray-900">
					@else
						<a href="/usageapproval" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-orange-200">
					@endif
							<i class="fa fa-envelope fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Usage</span>
						</a>
				</li>

				<li class="mr-6 my-2 md:my-0">
					@if( $controller == 'facility')
						<a href="/facility" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-blue-200  hover:border-gray-900">
					@else
						<a href="/facility" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-blue-200">
					@endif
							<i class="fas fa-chart-area fa-fw mr-3"></i>
							<span class="pb-1 md:pb-0 text-sm">Facility</span>
						</a>
				</li>

				@hasrole('manager')
	    			<li class="mr-6 my-2 md:my-0">
	    				@if( $controller == 'billing')
	    					<a href="/billing" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-red-200  hover:border-gray-900">
	    				@else
	    					<a href="/billing" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-red-200">
	    				@endif
		    					<i class="fa fa-wallet fa-fw mr-3"></i>
		    					<span class="pb-1 md:pb-0 text-sm">Billing</span>
		    				</a>
	    			</li>
				@endhasrole

				@hasrole('manager')
	  			<li class="mr-6 my-2 md:my-0">
	  				@if( $controller == 'users')
	  					<a href="{{ route('users.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-green-100 border-b-2 border-green-200  hover:border-gray-900">
	  				@else
	  					<a href="{{ route('users.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-green-200">
	  				@endif
		  					<i class="fas fa-chart-area fa-fw mr-3"></i>
		  					<span class="pb-1 md:pb-0 text-sm">Users</span>
		  				</a>
	  			</li>
				@endhasrole

				<!--
				@hasrole('manager')
			    @if(strtoupper(tenant('id')) == "DEMO" || strtoupper(tenant('id')) == "YBL")
			        <li class="mr-6 my-2 md:my-0">
	      				@if( $controller == 'manage-herd')
	      					<a href="/manage-herd" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-yellow-200  hover:border-gray-200">
	      				@else
	      					<a href="/manage-herd" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-yellow-200">
	      				@endif
						        <i class="fas fa-chart-area fa-fw mr-3"></i>
						        <span class="pb-1 md:pb-0 text-sm">Herds</span>
			            </a>
			        </li>
			    @endif
				@endhasrole
				-->

				@hasrole('manager')
	  			<li class="mr-6 my-2 md:my-0">
	  				@if( $controller == 'breeding')
	  					<a href="/bhome" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-yellow-200  hover:border-gray-200">
	  				@else
	  					<a href="/bhome" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-yellow-200">
	  				@endif
		  					<i class="fas fa-chart-area fa-fw mr-3"></i>
		  					<span class="pb-1 md:pb-0 text-sm">Breeding</span>
		  				</a>
	  			</li>
				@endhasrole

			</ul>
		</div>
	</div>
</nav>
