<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
    <div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Details of Goat Id: {{ $goat_id }}</h5>
        </div>
        <div class="p-5">
            @include('livewire.goats.goatInfoFull')
            
			<hr class="border-b-2 border-gray-600 my-2 mx-1">
			
			<div class="p-2">
			    <div class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-2  ">
			      Statistics Till {{ date('d-m-Y', strtotime($singleGoatHealthParams['date_observed'])) }}
				</div>
			</div>
			
			@include('livewire.goats.graphGoatData')
			
			<hr class="border-b-2 border-gray-600 my-2 mx-1">
            <!--  -->
            @if($goatDetails->status == 'active')
                @include('livewire.goats.goatExitForm')
            @endif
            
            @hasanyrole('herdmanager|veterinarian')
                <button wire:click="saveExitDetails({{ $goat_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mt-2 mx-6  rounded">Exit Goat</button>
            @endhasanyrole
        </div>
	</div>
</div>
<!--/table Card-->