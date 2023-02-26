<div class="container w-full mx-auto pt-20">
	<div class="w-full px-4 md:px-0 md:mt-8 mb-0 text-gray-800 leading-normal">
		<!--Console Content-->
		<div class="flex flex-wrap">

		    @hasanyrole('herdmanager|herdasstimmun')
		    <!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-indigo-600">
								<a href="manage-immunizations">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Immunizations</h5>
							<h5 class="font-normal text-left text-sm text-gray-900"> </h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->
			@endhasanyrole

			@hasanyrole('herdmanager|herdasstserum')
			<!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-orange-400">
								<a href="manage-serumrecords">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Serum</h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->
			@endhasanyrole

			@hasanyrole('herdmanager|herdvet')
			<!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-green-500">
								<a href="manage-healthrecords">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Health</h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->
			@endhasanyrole

			<!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-green-600">
								<a href="upload-goatimages">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Upload Images</h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->

			@hasanyrole('herdmanager')
			<!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-green-600">
								<a href="bulk-entries">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Bulk Entries</h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->
			@endhasanyrole

			<!--Metric Card -->
			<div class="w-full md:w-1/3 xl:w-1/3 p-3">
				<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
					<div class="flex flex-row items-center">
						<div class="flex-shrink pr-4">
							<div class="rounded p-3 bg-green-600">
								<a href="search-herds">
									<i class="fa fa-wallet fa-1x fa-fw fa-inverse"></i>
								</a>
							</div>
						</div>
						<div class="flex-1 text-left md:text-center">
							<h5 class="font-bold uppercase text-gray-900">Searches</h5>
						</div>
					</div>
				</div>
			</div>
			<!--/End Metric Card -->
	    </div>
		<!-- End of Console Content-->
	</div>
</div>
