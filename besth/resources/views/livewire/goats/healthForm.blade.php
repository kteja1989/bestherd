<!--Table Card-->
<div class="w-full md:w-1/3 p-3">
    <div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Update Health of Herd Id: {{ $herd_id }}, Input Fields with * Mandatory</h5>
        </div>
        <div class="p-5">
            <!-- insert table -->
            <table class="w-full p-5 text-gray-700">
                <thead>
                    <tr>
                    <th align="center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sops = array();
                        foreach($imsop3_id as $sop)
                        {
                            $sopId['sop_id'] = $sop->sop_id;
                            $sopId['sop_desc'] = $sop->description;
                            array_push($sops,$sopId );
                            unset($sopId);
                        }
                    ?>
                    @if( $goatNum > 0 )
                        <tr>
                            <td class="p-3" colspan="3">
                                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="hesopid">SOP ID*</label>
                                <div class="flex justify-left">
                                    <div class="mb-1 w-full xl:w-96">
                                        <select class="form-select appearance-none
                                        	block
                                        	w-full
                                        	px-3
                                        	py-1.5
                                        	text-base
                                        	font-normal
                                        	text-gray-700
                                        	bg-white bg-clip-padding bg-no-repeat
                                        	border border-solid border-gray-300
                                        	rounded
                                        	transition
                                        	ease-in-out
                                        	m-0
                                        	focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="sopidhealth" wire:model="healthsop_id" aria-label="Default select example">
                                                <option selected>Select SOP</option>
                                                    @foreach($sops as $row)
                                                    	<option value="{{ $row['sop_id'] }}">{{ $row['sop_desc'] }}</option>
                                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errhealthsopid">
                                @error('healthsop_id') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td class="p-3">
                                <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="hschedure">Schedule*</label>
                                <div class="flex justify-left">
                                    <div class="mb-1 w-full xl:w-96">
                                        <select class="form-select appearance-none
                                        	block
                                        	w-full
                                        	px-3
                                        	py-1.5
                                        	text-base
                                        	font-normal
                                        	text-gray-700
                                        	bg-white bg-clip-padding bg-no-repeat
                                        	border border-solid border-gray-300
                                        	rounded
                                        	transition
                                        	ease-in-out
                                        	m-0
                                        	focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="hcodesch" wire:model="sch_code" aria-label="Default select example">
                                                <option selected>Select Schedule</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="BiWeekly">Bi Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Yearly">Yearly</option>
                                                <option value="Special">Special</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errhcodesch">
                                @error('sch_code') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="3">
                                <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="hphyvir">Physical/Virtual*</label>
                                <div class="flex justify-left">
                                    <div class="mb-1 w-full xl:w-96">
                                        <select class="form-select appearance-none
                                        	block
                                        	w-full
                                        	px-3
                                        	py-1.5
                                        	text-base
                                        	font-normal
                                        	text-gray-700
                                        	bg-white bg-clip-padding bg-no-repeat
                                        	border border-solid border-gray-300
                                        	rounded
                                        	transition
                                        	ease-in-out
                                        	m-0
                                        	focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="phyinsp" wire:model="physical_inspection" aria-label="Default select example">
                                                <option selected>Select Type</option>
                                                <option value="Physical">Physical</option>
                                                <option value="Virtual">Virtual</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errphyinsp">
                                @error('physical_inspection') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="3">
                                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="obsnotes">Observations/Notes*</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="noteshealth" wire:model.defer="health_notes"></textarea>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errhealthnotes">
                                @error('health_notes') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="3">
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="hdiags">Diagnosis</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="hdiagnosis" wire:model.defer="diagnosis"></textarea>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errhdiags">
                                @error('diagnosis') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="3">
                                <label class="block text-gray-900 text-sm font-bold font-normal mb-2" for="htreatsugs">Treatment/Suggestions</label>
                                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="hsuggests" wire:model.defer="suggestions"></textarea>
                                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errhtreatsugs">
                                @error('suggestions') <span class="error">{{ $message }}</span> @enderror
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3" colspan="3">
                            <label class="block text-gray-900 text-sm pt-3 mb-2" for="heremark">Remarks, If any</label>
                            <input placeholder="Sample remarks, if any" class="h-17 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="remarkhealth" wire:model="healthremark">
                            <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="heremarks">
                            @error('healthremark') <span class="error">{{ $message }}</span> @enderror
                            </label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3" class="text-sm text-gray-900">
                                </br>
                                @hasanyrole('manager|herdmanager|veterinarian')
                                <button wire:click="saveHealthInfoDetails({{ $herd_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save Details</button>
                                @endhasanyrole
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">
                                <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                                	Goats Not Found
                                </label>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="w-full md:w-2/3 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">        
        <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-900">Goat List: Health Parameters on {{ date('d-m-Y') }}</h5>
        </div>
        <div class="p-5">
            <!-- insert table -->
            <!-- insert table -->
            @if( $goatNum > 0 )
            <table class="w-full p-5 text-gray-700">
              <thead>
                <tr>
                  <th colspan="3">
                    <div class="flex justify-left">
                        <div class="mb-1 w-full xl:w-96">
                            <select class="form-select appearance-none
                              block
                              w-full
                              px-3
                              py-1.5
                              text-base
                              font-normal
                              text-gray-700
                              bg-white bg-clip-padding bg-no-repeat
                              border border-solid border-gray-300
                              rounded
                              transition
                              ease-in-out
                              m-0
                              focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="hsop2id" wire:model="healthsop2_id" aria-label="Default select example">
                                <option value="selected" selected>Select SOP</option>
                                    @foreach($sops as $row)
                                      <option value="{{ $row['sop_id'] }}">SOP: {{ $row['sop_id'] }} - {{ $row['sop_desc'] }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <label class="error text-left text-orange-900 text-lg font-bold pt-0 mb-0" for="errsopid">
                        @error('healthsop2_id') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <label class="block text-gray-900 text-sm font-normal mb-2" for="morning">Morning</label>
                    <input class="form-check-input appearance-none h-8 w-15 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" id="morning" wire:model.lazy="morning" type="datetime-local" value="1" id="">
                    </br>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('morning') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </td>
                  <td>

                  </td>
                  <td class="float-right">
                    <label class="block text-gray-900 text-sm font-normal mb-2" for="evening">Evening</label>
                    <input class="form-check-input appearance-none  h-8 w-15 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" id="evening" wire:model.lazy="evening" type="datetime-local" value="1" id="">
                    </br>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errevening">
                        @error('evening') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr class="border-b-2 border-gray-600 rounded-3xl my-2 mx-1">
                <table class="w-full bg-red-200 p-5 text-gray-700">
                    <thead>
                        <tr>
                            <th colspan="5" align="center">Errors if any:</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if(!empty($messagex) || $messagex != null || $messagex != "")
                            <tr>
                                <td>
                                  <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="usercode">
                                    <span class="error">{{ $messagex }}</span>
                                  </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx1">
                                    @error('health.*.1') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>    
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx2">
                                    @error('health.*.2') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any()) 
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx3">
                                    @error('health.*.3') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.4') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>   
                        @endif  
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.5') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.6') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.7') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.8') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.9') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.10') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.11') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                        
                        @if($errors->any())
                            <tr>
                                <td>
                                    <label class="error text-orange-900 text-lg font-bold mx-3 pt-0 mb-0" for="hx4">
                                    @error('health.*.12') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            
    	    <!-- end of table -->
    	    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    	    <!-- List of samples found as table -->
    	    <table class="w-full p-5 text-gray-700">
                <thead>
                    <tr>
                        <th align="center">Goat ID</th>
                        <th align="center">Status</th>
                        <th colspan="5" align="center">After Entry, click Goat ID to save</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($gidArray as $key => $row)
                    <tr class="border-b content-center bg-purple-100 border-purple-200" rowspan="2">
                        <td>
                            @if($row)
                  			    <button wire:click="postGoatHealthInfos({{ $key }})" class="bg-green-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">{{ str_pad($key,2,'0',STR_PAD_LEFT) }}</button>
                            @else
                              	<button wire:click="postGoatHealthInfos({{ $key }})" class="bg-orange-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">{{ str_pad($key,2,'0',STR_PAD_LEFT) }}</button>
                            @endif
                        </td>
                        <td>
                            @if($row)
                            	<i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            @endif
                        </td>
                    
                        <td>
                            <input id="hex1" wire:model="health.{{ $key }}.1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Hb">
                        </td>
                        <td>
                            <input id="hex2" wire:model="health.{{ $key }}.2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Weight">
                        </td>
                        <td>
                            <input id="hex3" wire:model="health.{{ $key }}.3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Temp">
                        </td>
                        <td>
                            <input id="hex4" wire:model="health.{{ $key }}.4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Resp Rate">
                        </td>
                        <td>
                            <input id="hex5" wire:model="health.{{ $key }}.5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Muc Memb">
                        </td>
                        <td>
                            <input id="hex6" wire:model="health.{{ $key }}.6" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Rum Cont">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex7" wire:model="health.{{ $key }}.7" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="RBC">
                        </td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex8" wire:model="health.{{ $key }}.8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Platelet">
                        </td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex9" wire:model="health.{{ $key }}.9" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="PCV">
                        </td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex10" wire:model="health.{{ $key }}.10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="LFT">
                        </td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex11" wire:model="health.{{ $key }}.11" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="KFT">
                        </td>
                        <td class="border-b pb-4 content-center">
                            <input id="hex12" wire:model="health.{{ $key }}.12" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="RT-PCR">
                        </td>
                    </tr>
                  @endforeach
                </tbody>
    	    </table>
    	    @else 
        	    <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                        </tr>
                    </thead>
                    <tbody>
        	        <tr>
                        <td colspan="3">
                            <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                            	Goats Not Found
                            </label>
                        </td>
                    </tr>
        	        </tbody>
        	    </table>
    	    @endif
    	    <!--  -->
        	<hr class="border-b-2 border-gray-600 my-2 mx-1">
        </div>
    </div>
</div>
<!--/table Card-->
