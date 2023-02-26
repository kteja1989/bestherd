@inject('request', 'Illuminate\Http\Request')
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
    							No Role
    						</span>
    					</a>
    				</li>
				</ul>
			</div>

		</div>
	</nav>
