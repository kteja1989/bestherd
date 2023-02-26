	<!--Table Card-->
	<div class="w-full md:w-1/2 p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">ATR Update Herd Id: {{ $herd_id }}, Input Fields with * Mandatory</h5>
            </div>
            <div class="p-5">

                <!-- insert table -->
                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-green-400">
                        <tr class="text-white text-left">
                            <th align="center" class="px-8 py-3">
                                Action Taken Report
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="px-8 py-3">
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="usercode">Health Observations/Notes*</label>
                                {{ $healthInfATR->health_notes }}
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="3" class="px-8 py-3">
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="usercode">Diagnosis*</label>
                                {{ $healthInfATR->diagnosis }}
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="3" class="px-8 py-3">
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="usercode">Suggestions*</label>
                                {{ $healthInfATR->suggestions }}
                            </td>
                        </tr> 
                        <!--
                        <tr>
                            <td colspan="3">
                                </br></br></br>
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="usercode">Diagnosis*</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="atr_diagnosis"></textarea>
                            </td>
                        </tr> 
                        -->
                        
                        <tr>
                            <td colspan="3" class="px-8 py-3">
                                </br>
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="bulkcode">Treatment/Medication*</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="atr_medication"></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3" class="px-8 py-2">
                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="atr_option" value="1" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                All
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-8 py-2">
                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="atr_option" value="2" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                Select Few
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-8 py-2">
                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="atr_option" value="3" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                Select Few and Move to Sick herd
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-8 py-2">
                                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" wire:model="atr_option" value="4" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                Clear Selection
                                </label>
                            </td>
                        </tr>
                        
                        @if($openInpIds)
                            <tr>
                                <td colspan="3" class="px-6 py-2">
                                    <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
                                        ID (separated by ; )
                                    </label>
                                    </br>
                                    <input placeholder="Goat IDs separated by colon" class="h-17 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model="atr_goatids">
                                </td>
                            </tr>
                        @endif
                        @if($herdSelect)
                            <tr>
                                <td colspan="3" class="px-8 py-2">
                                    <div class="flex justify-left">
                                      <div class="mb-3 xl:w-full">
                                        <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
                                            Destination Herd
                                        </label>
                                        <select class="form-select appearance-none
                                          block w-full px-3 py-1.5
                                          text-base font-normal text-gray-700
                                          bg-white bg-clip-padding bg-no-repeat
                                          border border-solid border-gray-300
                                          rounded transition ease-in-out m-0
                                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                                          wire:model="select_herd" aria-label="Default select example">
                                            <option value="0" >Select Destination Herd</option>
                                            <option value="{{ $herdGender->herd_id }}" selected>Herd {{ $herdGender->herd_id }} - {{ $herdGender->description }} </option>
                                        </select>
                                      </div>
                                    </div>
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('select_herd') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        <tr>
                            <td colspan="3" class="px-6 py-2">
                                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="sampdesc">Action Taken Report*</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="atr_notes"></textarea>
                           </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-2">
                                <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                                    Remarks, If any
                                </label>
                                <input placeholder="Sample remarks, if any" class="h-17 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model="atr_remark">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-2">
                                
                                <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                                   Note Errors, If any:
                                </label>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('atr_medication') <span class="error">{{ $message }}</span> @enderror
                                </label>
                                </br>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('atr_notes') <span class="error">{{ $message }}</span> @enderror
                                </label>
                                </br>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('atr_goatids') <span class="error">{{ $message }}</span> @enderror
                                </label>
                                </br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-4 mb-6 text-sm text-gray-900">
                                </br>
                                @hasanyrole('herdmanager|veterinarian')
                                <button wire:click="saveATRDetails({{ $health_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save Details</button>
                                @endhasanyrole
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="mb-6 text-sm text-gray-900">
                                </br>
                            </td>
                        </tr>
                    </tbody>    
                </table>
            </div>
		</div>
	</div>
	<!--/table Card-->