<!--Metric Card 1 -->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-teal-600">
  				<a href="/manage-herd" >
  					<i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
  				</a>
  			</div>
  		</div>
        <div class="flex-1 text-left md:text-center">
  			<h4 class="font-bold uppercase text-gray-900">Herds</h4>
  			<h5 class="font-normal text-left text-sm text-gray-900">Active  {{ $herdCount }}; Goats Alive: {{ $goatsAlive }}; Dead {{ $goatsDead }}; Ret {{ $goatsRet }}; </h5>
		</div>
  	</div>
  </div>
</div>
<!--/End Metric Card 1-->

<!--Metric Card-->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-indigo-600">
                <a href="terms-base" >
                    <i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                </a>
            </div>
  		</div>
  		<div class="flex-1 text-right md:text-center">
  			<h5 class="font-bold uppercase text-gray-900">Terms Base</h5>
  			<h5 class="font-normal text-left text-1xl text-gray-600">
                Colors: {{ $colors }} SOP: {{ $sops }} Feeds: {{ $feeds }} Adjuvants: {{ $adjuvants }}
            </h5>
  		</div>
  	</div>
  </div>
</div>
<!--/Metric Card-->

<!--Metric Card 2 -->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-orange-600">
  				<a href="search-herds" >
  					<i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
  				</a>
  			</div>
  		</div>
  		<div class="flex-1 text-right md:text-center">
  			<h5 class="font-bold uppercase text-gray-900">Searches</h5>
  			<h5 class="font-normal text-left text-sm text-gray-800">Herds, Goats, Health Etc. </h5>
  		</div>
  	</div>
  </div>
</div>
<!--/End Metric Card 2-->

<!--Metric Card-->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-indigo-500">
  				<a href="manage-immunizations" >
  					<i class="fas fa-inbox fa-2x fa-fw fa-inverse"></i>
  				</a>
  			</div>
  		</div>
  		<div class="flex-1 text-right md:text-center">
  			<h5 class="font-bold uppercase text-gray-900">Immunizations</h5>
  			<h5 class="font-normal text-left text-sm text-gray-600">
  			    Completed: {{ $activeImms }}; Incomplete: {{ $incompImms }}
  			</h5>
  		</div>
  	</div>
  </div>
</div>
<!--/Metric Card-->

<!--Metric Card-->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-orange-500">
  				<a href="manage-serumrecords" >
  					<i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
  				</a>
  			</div>
  		</div>
  		<div class="flex-1 text-right md:text-center">
  			<h5 class="font-bold uppercase text-gray-900">Serum</h5>
  			<h3 class="font-normal text-left text-1xl text-gray-600">Incomplete: {{ $seraIncomp }} Completed: {{ $seraComp }}</h3>
  		</div>
  	</div>
  </div>
</div>
<!--/Metric Card-->

<!--Metric Card-->
<div class="w-full md:w-1/2 xl:w-1/3 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
  	<div class="flex flex-row items-center">
  		<div class="flex-shrink pr-4">
  			<div class="rounded p-3 bg-yellow-600">
  				<a href="manage-titers" >
  					<i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
  				</a>
  			</div>
  		</div>
  		<div class="flex-1 text-right md:text-center">
  			<h5 class="font-bold uppercase text-gray-900">Titers</h5>
  			<h5 class="font-normal text-left text-1xl text-gray-600"></h5>
  		</div>
  	</div>
  </div>
</div>
<!--/Metric Card-->

