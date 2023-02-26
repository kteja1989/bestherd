<!--Table Card-->
<div class="w-full md:w-full p-3">
  <div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-900">Edit Immunization details: {{ $imm_id }}, Input Fields with * Mandatory</h5>
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
			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">SOP ID*</label>
					<div class="flex justify-left">
						<div class="mb-3 w-full xl:w-96">
							<select class="form-select appearance-none
								block	w-full px-3 py-1.5 text-base
								font-normal text-gray-700	bg-white bg-clip-padding
								bg-no-repeat border border-solid border-gray-300
								rounded transition ease-in-out m-0
								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="editimsop_id" aria-label="Default select example">
								<option selected>Select SOP</option>
									@foreach($imsops as $sop)
										<option value="{{ $sop->sop_id }}">{{ $sop->description }}</option>
									@endforeach
							</select>
						</div>
					</div>
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editimsop_id') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="species">Immunogen Code*</label>
					<input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="editimngen_code" type="text">
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editimngen_code') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>
			<tr>
                <td>
                    <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Adjuvant Code*</label>
					<div class="flex justify-left">
						<div class="mb-1 w-full xl:w-96">
							<select class="form-select appearance-none
								block	w-full px-3 py-1.5 text-base
								font-normal text-gray-700	bg-white bg-clip-padding
								bg-no-repeat border border-solid border-gray-300
								rounded transition ease-in-out m-0
								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="editimadjuvent_code" aria-label="Default select example">
								<option selected>Select Adjuvant</option>
									@foreach($adjuvants as $adj)
										<option value="{{ $adj->nick_name }}">{{ $adj->adjuvant_name }}</option>
									@endforeach
							</select>
						</div>
					</div>
					<label class="error text-orange-900 text-sm font-normal pt-3 mb-2" for="usercode">
						@error('editimadjuvent_code') <span class="error">{{ $message }}</span> @enderror
					</label>
                </td>
              	<td>
					<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="nsc">Frequency Number*</label>
					<input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="editimfreqnumber" type="text">
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editimfreqnumber') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
				
				<td>
					<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="nsc">Frequency unit*</label>
					<div class="flex justify-left">
						<div class="mb-1 w-full xl:w-96">
							<select class="form-select appearance-none
								block	w-full px-3 py-1.5 text-base
								font-normal text-gray-700	bg-white bg-clip-padding
								bg-no-repeat border border-solid border-gray-300
								rounded transition ease-in-out m-0
								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="editimfrequnit" aria-label="Default select example">
								<option selected>Frequency Unit</option>
								<option value="days" selected="selected">Days</option>	
							</select>
						</div>
					</div>
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editimfrequnit') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
            </tr>
            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="nsc">Immunogen Volume*</label>
                <input  class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="editimmunoge_volume" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editimmunoge_volume') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="species">Immunogen Site*</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="editimmunogen_site" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editimmunogen_site') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="type">Immunogen Route*</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="editimmunogen_route" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editimmunogen_route') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="sampdesc">Immunogen Description*</label>
                <textarea placeholder="Description" class="h-20 shadow appearance-none border border-red-500 rounded w-full py-1.5 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="editimsample_desc"></textarea>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editimsample_desc') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Sample Volume</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="editsample_volume" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editsample_volume') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="bulkcode">Sample Batch Id</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedDate" wire:model="editsampbatch_id" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editsampbatch_id') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="seriescode">Sample Source</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="editsample_source" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editsample_source') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Sample Supplied By</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="editsupplied_by" type="text">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editsupplied_by') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="bulkcode">Sample Book Ref</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedDate" wire:model="editsample_ref" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editsample_ref') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="seriescode">Sample Authorized By</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="editauth_by" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editauth_by') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Full Herd</label>
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model="editfullpartial" value="1" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1"></label>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editfullpartial') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="bulkcode">Partial Herd</label>
                <input class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model="editfullpartial" value="0" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1"></label>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editfullpartial') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="seriescode">From Id</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="editfrom_id" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editfrom_id') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
              <td>
                <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="seriescode">To Id</label>
                <input size="15" class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="editto_id" type="text">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editto_id') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                    Remarks, If any
                </label>
                <input placeholder="Sample remarks, if any" class="h-17 shadow appearance-none border border-red-500 rounded w-full py-1 px-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model="editremark">
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
					@error('editremark') <span class="error">{{ $message }}</span> @enderror
				</label>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="text-sm text-gray-900">
                </br>
                @hasanyrole('herdmanager')
                <button wire:click="saveImmunizationDetails({{ $herd_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save Details</button>
                @endhasanyrole
              </td>
            </tr>
          </tbody>
      	</table>
    </div>
  </div>
</div>
<!--/table Card-->
