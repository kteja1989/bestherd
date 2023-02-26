<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-900">Immunization of Herd Id: {{ $herd_id }}, Input Fields with * Mandatory</h5>
    </div>
    <div class="p-5">
    <!-- insert table -->
      @if($herdStrength > 0)
        <table class="w-full p-5 text-gray-700">
          <thead>
            <tr>
              <th align="center"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
            	<td colspan="3">
            		<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="sopid">SOP ID*</label>
            		<div class="flex justify-left">
            			<div class="mb-3 w-full xl:w-96">
            				<select class="form-select appearance-none
            					block	w-full px-3 py-1.5 text-base
            					font-normal text-gray-700	bg-white bg-clip-padding
            					bg-no-repeat border border-solid border-gray-300
            					rounded transition ease-in-out m-0
            					focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="imsopid" wire:model="imsop_id" aria-label="Default select example">
            					<option selected>Select SOP</option>
            						@foreach($imsop2_id as $sop)
            							<option value="{{ $sop->sop_id }}">{{ $sop->description }}</option>
            						@endforeach
            				</select>
            			</div>
            		</div>
            		<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            			@error('imsop_id') <span class="error">{{ $message }}</span> @enderror
            		</label>
            	</td>
            </tr>
            <tr>
            	<td colspan="3">
            		<label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="immcode">Immunogen Code*</label>
            		<input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="imngencode" wire:model="imngen_code" type="text">
            		<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            			@error('imngen_code') <span class="error">{{ $message }}</span> @enderror
            		</label>
            	</td>
            </tr>

            <tr>
                
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="adjcode">Adjuvant Code*</label>
                  <div class="flex justify-left">
                    <div class="mb-1 w-full xl:w-96">
                      <select class="form-select appearance-none
                        block	w-full px-3 py-2 text-base
                        font-normal text-gray-700	bg-white bg-clip-padding
                        bg-no-repeat border border-solid border-gray-300
                        rounded transition ease-in-out m-0
                        focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="imadjcode" wire:model="imadjuvent_code" aria-label="Default select example">
                        <option selected>Select Adjuvant</option>
                      	@foreach($adjuvants as $adj)
                      		<option value="{{ $adj->nick_name }}">{{ $adj->adjuvant_name }}</option>
                      	@endforeach
                      </select>
                    </div>
                  </div>
                <label class="error text-orange-900 text-sm font-normal pt-3 mb-2" for="erradjcode">
                @error('imadjuvent_code') <span class="error">{{ $message }}</span> @enderror
                </label>
              </td>
              
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="freqnum">Frequency Number*</label>
                <input  class="shadow appearance-none border border-red-500 rounded w-full py-2 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="imfreqnum" wire:model="imfreqnumber" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errimfreqnum">
                  @error('imfreqnumber') <span class="error">{{ $message }}</span> @enderror
                </label>
              </td>

              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="frequnit">Frequency unit*</label>
                <div class="flex justify-left">
                  <div class="mb-1 w-full xl:w-96">
                    <select class="form-select appearance-none
                      block	w-full px-3 py-2 text-base
                      font-normal text-gray-700	bg-white bg-clip-padding
                      bg-no-repeat border border-solid border-gray-300
                      rounded transition ease-in-out m-0
                      focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="imunitfreq" wire:model="imfrequnit" aria-label="Default select example">
                      <option selected>Frequency Unit</option>
                      <option value="days" selected="selected">Days</option>
                    </select>
                  </div>
                </div>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errimfrequnit">
                @error('imfrequnit') <span class="error">{{ $message }}</span> @enderror
                </label>
              </td>
            </tr>

            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="imngvol">Immunogen Volume* (ml)</label>
                <input  class="shadow appearance-none border border-red-500 rounded w-auto py-2 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="imngnvol" wire:model="immunoge_volume" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errimngnvol">
            			@error('immunoge_volume') <span class="error">{{ $message }}</span> @enderror
            		</label>
              </td>
              
              <td>
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="site">Site*</label>
                <input size="20" class="shadow appearance-none border border-red-500 rounded w-auto py-2 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="imngnsite" wire:model="immunogen_site" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errsite">
            		@error('immunogen_site') <span class="error">{{ $message }}</span> @enderror
            	</label>
              </td>
              
              <td>
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="route">Route*</label>
                <div class="mb-1 w-full xl:w-96">
                    <select class="form-select appearance-none
                      block	w-full px-3 py-2 text-base
                      font-normal text-gray-700	bg-white bg-clip-padding
                      bg-no-repeat border border-solid border-gray-300
                      rounded transition ease-in-out m-0
                      focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="imngnroute" wire:model="immunogen_route" aria-label="Default select example">
                      <option value="">Select</option>
                      <option value="sc" selected="selected">Sub Cuteneous</option>
                      <option value="im" selected="selected">Intra Muscular</option>
                      <option value="ip" selected="selected">Intra Peritoneal</option>
                      <option value="multi" selected="selected">Multi Route</option>
                      
                    </select>
                  </div>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errroute">
            			@error('immunogen_route') <span class="error">{{ $message }}</span> @enderror
            	</label>
              </td>
            </tr>

            <tr>
              <td colspan="3">
                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="immdesc">Immunogen Description*</label>
                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1.5 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="imsampdesc" wire:model.defer="imsample_desc"></textarea>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errimngndesc">
            			@error('imsample_desc') <span class="error">{{ $message }}</span> @enderror
            		</label>
              </td>
            </tr>

            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="sampvol">Sample Volume</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="samplvol" wire:model="sample_volume" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            			@error('sample_volume') <span class="error">{{ $message }}</span> @enderror
            		</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="bulkcode">Batch/Lot Id</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="sampbatchid" wire:model="sampbatch_id" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            			@error('sampbatch_id') <span class="error">{{ $message }}</span> @enderror
            		</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="seriescode">Source</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="sampsource" wire:model="sample_source" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            			@error('sample_source') <span class="error">{{ $message }}</span> @enderror
            		</label>
              </td>
            </tr>

            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="supby">Supplied By</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="suppliedby" wire:model="supplied_by" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
            	   @error('supplied_by') <span class="error">{{ $message }}</span> @enderror
            	</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="bookref">Book Ref</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="sampref" wire:model="sample_ref" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="erbookref">
            		@error('sample_ref') <span class="error">{{ $message }}</span> @enderror
            	</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="authcode">Authorized By</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="authBy" wire:model="auth_by" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errauthcode">
            		@error('auth_by') <span class="error">{{ $message }}</span> @enderror
            	</label>
              </td>
            </tr>

            <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
              <td>
                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="idrem">
                  IDs Remaining
                </label>
              </td>
              <td colspan="2">
                @foreach($remainingGoats as $row)
                  {{ $row }};
                @endforeach
              </td>
            </tr>

            <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
              <td>
                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" id="immall" wire:model.lazy="immunizeAll" type="checkbox" value="1" id="">
                <label class="block text-gray-900 text-sm font-normal font-bold mb-2" for="type">Immunize All</label>
              </td>
              <td colspan="2">

              </td>
            </tr>

            @if($hideScanField)
                <div class="hide">
                  <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                    <td>
                      <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="scanids">
                        Scanned IDs
                      </label>
                    </td>
                    <td colspan="2">
                      {{ $scannedGoatIds }}
                    </td>
                  </tr>
    
                  <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                    <td>
                      <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="idstype">
                        ID (Type or Scan)
                      </label>
                    </td>
                    <td>
                      <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="scgoatid2" wire:model.lazy="scanGoatId2" type="text">
                    </td>
                    <td>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mx-3 mb-0" for="errsgid2">
                        {{ $scanError2 }}	@error('scanGoatId2') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>
                </div>
            @endif

            <tr>
              <td colspan="3">
                <label class="block text-gray-900 text-sm pt-3 mb-2" for="remark">
                    Remarks, If any
                </label>
                <input placeholder="Sample remarks, if any" class="h-17 shadow appearance-none border border-red-500 rounded w-full py-1 px-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="remarks" wire:model="remark">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="errremarks">
					@error('remark') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                <label class="block text-red-700 text-lg font-bold pt-3 mb-2" for="errmsgs">
                    {{ $immErrorMsg }}
                </label>
              </td>
            </tr>

            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                </br>
                @hasanyrole('herdmanager|veterinarian')
                    <button wire:click="saveImmunizationDetails({{ $herd_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save Details</button>
                @endhasanyrole
              </td>
            </tr>
          </tbody>
      	</table>
      @else
        <table class="w-full p-5 text-gray-700">
            <thead>
              <tr>
                <th>Goat(s) Not Found</th>
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
