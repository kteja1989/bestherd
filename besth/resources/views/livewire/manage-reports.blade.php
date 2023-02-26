<div><!-- do not alter or delete this tag, important for livewire -->
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container w-full mx-auto pt-20">
        <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
            <!--begin from here-->
            <!--End of Console content-->
            @hasanyrole('herdman|researcher')
          	    @include('livewire.reports.reportGenFlexwrap')
          	@endhasanyrole
          	<!--Divider-->
          	<hr class="border-b-2 border-gray-600 my-2 mx-4">
          	<!--Divider-->
          	<div class="flex flex-row flex-wrap flex-grow mt-2">
          	    <!-- Left Panel Graph Card-->
          		<div class="w-full min-h-screen md:w-full p-3">
          			<div class="bg-orange-100 border border-gray-800 rounded shadow">
          				<div class="border-b border-gray-800 p-3">
          					<h5 class="font-bold uppercase text-gray-900">Reports: Active Projects</h5>
          				</div>
          				<div class="errors">
        				    @if($updateMsgs)
                                @include('livewire.reports.errMsgs')
                            @endif
          					@if (session()->has('formmessage'))
          						<div class="alert alert-success">
          							{{ session('message') }}
          						</div>
          					@endif
          				</div>
          				<div class="p-5">
                            <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                <thead class="bg-gray-900">
                                <tr class="text-white text-left">
                                  <th class="font-semibold text-sm uppercase px-6 py-4"> Select </th>
                                  <th class="font-semibold text-sm uppercase px-6 py-4"> Title </th>
                                </tr>
                                </thead>
          						<tbody>
          							@foreach($actives as $row)
          								<tr class="border-b b border-indigo-200">
          									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap" align="left">
          										<input type="radio" class="form-radio" id="project_id[]" wire:model="project_id" type="radio" value="{{ $row->project->project_id }}">
          									</td>
    
          									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
          										{{ $row->project->title }}
          									</td>
          								</tr>
          							@endforeach
      								<tr class="border-b  border-indigo-200">
      									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap"> From </td>
      									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
      									<input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="fromDate" wire:model="fromDate" type="date">
      									</td>
      								</tr>
      								<tr class="border-b  border-indigo-200">
      									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap"> To </td>
      									<td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
      									<input size="5" class="shadow appearance-none border border-red-500 rounded w-auto py-1  text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="toDate" wire:model="toDate" type="date"></td>
      								</tr>
      								<tr>

      									<td colspan="2" class="text-sm p-5 w-100 mt-10 text-gray-900">
      										@hasanyrole('pisg|pilg|piblg|pient|investigator|researcher')
      											<button wire:click="notebook" class="bg-pink-500 w-30 hover:bg-blue-800 text-white font-normal py-2 px-3 mx-3  rounded">Note Book</button>

      											<button wire:click="consumption" class="bg-green-500 w-30 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Consumption </button>

      											<button wire:click="costs" class="bg-orange-500 w-30 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Billing</button>
      										@endhasrole
      									</td>
      								</tr>
          						</tbody>
          					</table>
          					<canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
          				</div>
          			</div>
          		</div>
          		<!--/table Card-->
          	</div>
            <!--end of the block-->
        </div>
    </div>
</div><!-- do not alter or delete this tag, important for livewire -->
