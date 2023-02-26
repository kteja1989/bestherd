<div>
  {{-- Stop trying to control. --}}
  {{-- Care about people's approval and you will be their prisoner. --}}
  <div class="container w-full mx-auto pt-20 pb-20">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--begin from here-->
      <!--End of Console content-->
    	@include('livewire.reports.reportGenFlexwrap')
    	<!--Divider-->
      <?php $id = 1; ?>
    	<hr class="border-b-2 border-gray-600 my-2 mx-4">
    	<!--Divider-->
    	<div class="flex flex-row flex-wrap flex-grow mt-2">
      	<!-- Left Panel Graph Card-->
      	<div class="w-1/3 md:w-1/3 p-3">
      		<div class="bg-orange-100 border border-gray-800 rounded shadow">
				<div class="border-b border-gray-800 p-3">
					<h5 class="font-bold uppercase text-gray-900">Reports: Active Herds</h5>
				</div>
				<div class="errors text-left text-red-900 mx-3">
					@if (session()->has('formmessage'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
				</div>
      			<div class="p-5 content-center">
      			 @if( count($activeHerds) > 0 )
                    <table class="w-full  p-5 text-gray-700">
                      <thead>
                      	<tr>
                      		<th class="text-center text-gray-900">Select</th>
                      		<th class="text-left  text-gray-900">Description</th>
                      	</tr>
                      </thead>
                      <tbody>
                      	@foreach($activeHerds as $row)
                      		<tr>
                      			<td class="text-sm p-2 text-gray-900" align="center">
                      				<input type="radio" class="form-radio" id="herd_id" wire:model.lazy="herdIdVal" type="radio" value="{{ $row->herd_id }}">
                      			</td>
                    
                      			<td class="text-sm text-gray-900">
                      				{{ $row->description }}
                      			</td>
                      		</tr>
                      	@endforeach
                      	<tr>
                      		<td class="text-sm text-gray-900" align="center"> <strong>From</strong></td>
                      		<td class="text-sm p-2 text-gray-900">
                      		<input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="fromDate" wire:model="fromDate" type="date">
                      		</td>
                      	</tr>
                      	<tr>
                      		<td class="text-sm text-gray-900" align="center"> <strong>To</strong></td>
                      		<td class="text-sm p-2 text-gray-900">
                      		<input size="5" class="shadow appearance-none border border-red-500 rounded w-auto py-1  text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="toDate" wire:model="toDate" type="date"></td>
                      	</tr>
                      	<tr>
                          <td colspan="2">
                          <div class="text-sm text-left text-red-900 mx-10">
                            @if($updateMsgs)
                              <strong>{{ $repMessage }}</strong>
                            @endif
                          </div>
                          </td>
                      	</tr>
                      	<tr class=" mt-10 ">
                      		<td colspan="2" class="text-sm p-5 mt-10 text-gray-900">
                          @hasanyrole('herdmanager')
                            <button wire:click="herdReports()" class="bg-pink-500  w-45 hover:bg-blue-800 text-white font-normal py-2 px-3 mx-1 mt-4 rounded">Herds</button>
                            <button wire:click="immunizationReports()" class="bg-green-500  hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Immunizations </button>
                            <button wire:click="seraCollectReports()" class="bg-orange-500  hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Serum</button>
                            <button wire:click="formCReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Form C</button>
                            <button wire:click="processExitReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Exit Report</button>
                            <button wire:click="formCReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Daily Record</button>
                            <button wire:click='$emit("openModal", "confirm-modal", @json(["name" => "KKrishnaTeja"]) )' class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Modal Test</button>
                          @endhasrole
                      		</td>
                      	</tr>
                      </tbody>
                    </table>
                @else    
                    <table class="w-full  p-5 text-gray-700">
                      <thead>
                      	<tr>
                      		<th class="text-center text-gray-900">No Herd Data Retrieved</th>
                      	</tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                @endif    
      			</div>
      		</div>
      	</div>
      	<!--/table Card-->
        @if($showHerdInfoPrint)
            @include('livewire.reports.printHerdInfo')
        @endif
        <!--/table Card-->
        @if($showImmunInfoPrint)
            @include('livewire.reports.printImmuneInfo')
        @endif
        <!--/table Card-->
        @if($showSeraInfoPrint)
            @include('livewire.reports.printSeraInfo')
        @endif
        <!--/table Card-->
        @if($showExitedgoatInfoPrint)
            @include('livewire.reports.printGoatExitInfo')
        @endif
      </div>
    </div>
  </div>


</div>
