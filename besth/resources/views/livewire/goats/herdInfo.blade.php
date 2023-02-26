	<!--Table Card-->
	<div class="w-full md:w-1/2 p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Details of Herd Id: {{ $herd_id }}</h5>
            </div>
            <div class="p-5">
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                          <th class="text-left text-gray-900">Color-Id</th>
                          <th class="text-left text-gray-900">Location</th>
                          <th class="text-left text-gray-900">Assigned End-Use</th>
                          <th class="text-left text-gray-900">Size</th>
                          <th class="text-left text-gray-900">Count</th>
                          <th class="text-left text-gray-900">Vacancy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($herdInfo as $row)
						<?php
							$ccs = "bg-".$row->color."-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 rounded";
						?>
                        <?php $category = $row->category; ?>
                            <tr>
                                <td class="text-sm text-gray-900" align="left">
                                    <button wire:click="editHerdInfo({{$row->herd_id}})" class="{{ $ccs }}">Edit</button>
                                    <!-- button class="{{ $ccs }}" >{{ $row->herd_id }}</button -->
                                </td>
                                <td class="text-sm text-gray-900">
                                    {{ $row->location }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                   {{ $row->description }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ $row->total_size }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ $row->total_count }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ ($row->total_size-$row->total_count) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- insert table -->
                <!-- insert table -->
                <div class="p-2">
                    <table class="table-auto w-full rounded-lg  p-5 text-gray-700">
                        <thead></thead>
                        <tbody>
                            @if( $viewGoatList)
                                <tr class="bg-orange-200 border-b dark:bg-gray-200 dark:border-gray-700">
                            		<td class="bg-orange-200">
                            			<label class="block text-gray-900 text-sm font-bold px-5 pt-3 mb-2" for="exptdesc">
                            				ID (Type or Scan)
                            			</label>
                            		</td>
                            		<td class="px-2 py-2">
                            			<input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.lazy="scanGoatId" type="text">
                            		</td>
                            	</tr>
                            	<tr class="bg-orange-200 border-b dark:bg-gray-200 dark:border-gray-700">
                            	    <td></td>
                            		<td>
                            			<label class="error text-orange-900 text-center text-sm font-bold mx-4 pt-0 mb-2" for="usercode">
                            				{{ $scanError }}	@error('scanGoatId') <span class="error">{{ $message }}</span> @enderror
                            			</label>
                            		</td>
                            	</tr>
                        	@endif
                            <tr>
                                <td colspan="3">
                                    <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                                        Herd Member List
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end of table -->
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <!-- List of samples found as table -->
                @if( $viewGoatList)
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                                <th align="left">Action</th>
                                <th align="left">Gender</th>
                                <th align="left">DoB</th>
                                <th align="left">Cur. Age</th>
                                <th align="left">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($curGoatList as $row)
                                <?php
                                    $ts1 = strtotime($row->dob);
                                    $ts2 = strtotime(date('Y-m-d'));
                                    
                                    $year1 = date('Y', $ts1);
                                    $year2 = date('Y', $ts2);
                                    
                                    $month1 = date('m', $ts1);
                                    $month2 = date('m', $ts2);
                            
                                    $age = (($year2 - $year1) * 12) + ($month2 - $month1);
                                ?>
                            
                                @if( $age > 50 )
                                    <tr class="border-b px-3 bg-indigo-100 border-indigo-200">
                                @else
                                    <tr>
                                @endif
                                        <td>
                                            <button wire:click="viewGoatDetails({{$row->goat_id}})" class="{{ $ccs }}" >ID: {{ str_pad($row->goat_id,3,'0',STR_PAD_LEFT) }}</button>
                                        </td>
                                        <td>
                                            {{ $row->gender }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($row->dob)) }}
                                        </td>
                                        <td>
                                            {{ $age }} {{ $row->age_unit }}
                                        </td>
                                        <td>
                                            {{ $row->source }}
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                        
                                    <th align="left">Goat(s) Not Found</th>
                     
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                @endif

                <hr class="border-b-2 border-gray-600 my-2 mx-1">

                @if($showAddMemberForm)
                    <div class="p-5">
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                  <th colspan="2" class="text-left text-gray-900">
                                      {{ $messagesHerdMemberForm }}
                                  </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2 pt-3" for="species">Herd ID* </label>
                                        <input disabled class="shadow appearance-none border border-red-500 rounded cursor-not-allowed w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="hmem_herdId" type="text">
                                    </td>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-bold font-normal mb-2 pt-3" for="gender">Gender*</label>
                                        <input disabled class="shadow appearance-none border border-red-500 rounded cursor-not-allowed w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="hmem_gender" type="text">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-bold font-normal mb-2 pt-3" for="nsc">Genetic Background*</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="hmem_genback" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_genback') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2 pt-3" for="species">Date of Birth*</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="hmem_DoB" type="date">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_DoB') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        {{ $dobmsg }}
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2 pt-3" for="type">Source*</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="hmem_source" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_source') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>

                                    <td>
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2 pt-3" for="ref">Source Reference*</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="hmem_sourceref" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_sourceref') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="qstart">Quarantine Start*</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="quarstart" wire:model="hmem_quarstart" type="date">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_quarstart') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>

                                    <td>
                                        <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="qend">Quarantine End*</label>
                                        <input disabled class="shadow appearance-none border border-red-500 rounded w-full cursor-not-allowed py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="quartend" wire:model="hmem_quarend" type="date">
                                        
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_quarend') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        {{ $quarmsg }}
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <label class="block text-gray-900 text-sm font-normal font-bold mb-2 pt-3" for="type">Source Reference File Notes</label>
                                        <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="hmem_sourcefile" type="text">
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_sourcefile') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                      <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="username">
                                        Upload File Reference (optional)
                                      </label>
                                      <input type="file" placeholder="Upload File" wire:model="fileref" multiple>
                                      </br>
                                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('fileref.*') <span class="text-danger error">{{ $message }}</span>@enderror
                                      </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                      <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="username">
                                        Upload Image File (optional)
                                      </label>
                                      <input type="file" placeholder="Upload File" wire:model="goatImages" multiple>
                                      </br>
                                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('goatImages.*') <span class="text-danger error">{{ $message }}</span>@enderror
                                      </label>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2">
                                        <label class="block text-gray-900 text-sm font-bold pt-3 mb-2 pt-3" for="sampdesc">Remarks*</label>
                                        <input placeholder="Remarks" class="shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="hmem_remarks"></textarea>
                                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('hmem_remarks') <span class="error">{{ $message }}</span> @enderror
                                        </label>
                                    </td>
                                </tr>

       							<tr>
    								<td colspan="2" class="text-left text-gray-900 pt-3">
    									<input class="form-check-input appearance-none pt-3 h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model.defer="hmem_multiple" type="checkbox" value="" id="">
    									<label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="type">Add Multiple</label>
    								</td>
    							</tr>
    
    							<tr>
    								<td colsapn="2">
    									</br>
    									<label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="type">{{ $addHerdMessage }}</label>
    									</br>
    								</td>
    							</tr>
    
    							<tr>
    								<td colspan="2">
    									<button wire:click="addMemberToHerd({{ $herd_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save</button>
    								</td>
    							</tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="border-b-2 border-gray-600 my-2 mx-1">
                @endif
                
                @if(!$showAddMemberForm)
                    @if($category == "quarantine")
                        <table class="w-full p-5 text-gray-700">
                            <thead>
                                <tr>
                                    <th align="left"><button wire:click="showAddToHerdForm({{ $herd_id }})" class="bg-blue-800 w-22 hover:bg-blue-800 text-white font-normal py-1 px-2 rounded">Add To Herd</button></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
		</div>
	</div>
	<!--/table Card-->
