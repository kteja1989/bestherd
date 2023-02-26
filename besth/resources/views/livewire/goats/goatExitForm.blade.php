<table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
    <thead class="bg-orange-500">
        <tr class="text-white text-left">
            <th colspan="2" class="font-semibold text-sm uppercase px-4 py-4"> Caution: Potential Bulk Operation </th>
        </tr>
    </thead> 
    <tbody>
    </tbody>
</table>

<table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-orange-200 divide-y divide-gray-300 overflow-hidden'>
    <thead>
        <thead class="bg-gray-900">
            <tr class="text-white text-left">
                <th colspan="3" class="font-semibold text-sm uppercase px-4 py-4">Exit Details: Operation Cannot be undone, Select Reason</th>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($herdInfo))
        {
            foreach($herdInfo as $row)
            {
                $category = $row->category;
            }
        }
        else {
            $category = "free";
        }
    ?>
    @if($category == "quarantine" || $category == "sick" || $category == "free")
        <tr>
            <td colspan="2" class="px-8 py-4">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="newherd" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                    Move to Herd 
                </label>
            </td>
            <td colspan="2" class="px-8 py-2">
                <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="species">Destination Herd</label>
                <select class="form-select appearance-none
					block	w-full px-3 py-1.5 text-base
					font-normal text-gray-700	bg-white bg-clip-padding
					bg-no-repeat border border-solid border-gray-300
					rounded transition ease-in-out m-0
					focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="newherd_id" aria-label="Default select example">
					<option selected>Select Herd</option>
						@foreach($allHerds as $row)
							<option value="{{ $row->herd_id }}">Herd {{ $row->herd_id }}: {{ $row->description }}</option>
						@endforeach
				</select>
            </td>
        </tr>
    @endif
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="non_responder" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Non-Responder
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="under_weight" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Under Weight
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="vices" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Vices
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="limb_deformities" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Limb Deformities
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="nervous_disorder" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Nervine Disorder
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="retired" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                    Retired/Rehabiltated/Age Above
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="unknownCI" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                    Unknown Reason/Chronic illness
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="goat_exit" value="dead" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                Dead
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                Exit Reason
                </label>
                <input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title"  wire:model="exit_remark" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('exit_remark') <span class="error">{{ $message }}</span> @enderror
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="px-8 py-2">
                <label class="error text-orange-900 text-lg font-normal pt-3 mb-2" for="usercode">
                    @error('goat_exit') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label class="block text-orange-900 text-lg font-normal pt-3 mb-2" for="exptdesc">
                    {{ $exitFormMessage }}
                </label>
            </td>
        </tr>
    </tbody>    
</table>
