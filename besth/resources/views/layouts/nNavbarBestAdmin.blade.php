@inject('request', 'Illuminate\Http\Request')
    <?php
      $controller = "";
      $res = explode('.', $request->route()->getName());
      $controller = $res[0];
      $facility = array('strains','roomsnracks');
      if($res[0] == 'roles'){ $controller = 'users'; }
      if($res[0] == 'permissions'){ $controller = 'users'; }
      if(in_array($res[0], $facility)) {$controller = 'facility'; }
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
							  <span class="pb-1 md:pb-0 text-sm">BEST-User Admin</span>
            </a>
          </li>
          <!--
					<li class="mr-6 my-2 md:my-0">
    					@if( $controller == 'createuser')
                <a href="{{ route('createuser.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-pink-200  hover:border-gray-900">
    					@else
    						<a href="{{ route('createuser.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900  hover:border-pink-200">
    					@endif
							  <i class="fas fa-tasks fa-fw mr-3"></i>
							    <span class="pb-1 md:pb-0 text-sm">New User</span>
                </a>
          </li>
          -->
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
				</ul>
			</div>
			<!-- End of guard/role check and appropriate menus -->
			<!--
			<div class="relative pull-right pl-4 pr-4 md:pr-0">
          <input type="search" placeholder="Search" class="w-full bg-gray-900 text-sm text-gray-400 transition border border-gray-800 focus:outline-none focus:border-gray-600 rounded py-1 px-2 pl-10 appearance-none leading-normal">
          <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
              <svg class="fill-current pointer-events-none text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
              </svg>
          </div>
      </div>
			-->
		</div>
	</nav>
