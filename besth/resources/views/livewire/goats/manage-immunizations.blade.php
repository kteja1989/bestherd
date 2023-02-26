<div>
  <!--End of Console content-->
   @hasanyrole('herdmanager|herdasstimmun|herdserum|herdvet')
    @include('livewire.goats.flexwrapGoat')
  @endhasanyrole
  <div class="container w-full mx-auto pb-40">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--Divider-->
      <hr class="border-b-2 border-gray-600 my-2 mx-4">
      <!--Divider-->
      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!-- Left Panel Graph Card-->
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Immunizations</h5>
            </div>
            <div class="errors">
              @if (session()->has('formmessage'))
                <div class="alert alert-success">
                  {{ session('message') }}
              </div>
              @endif
            </div>
            <div class="p-5">
              <body class="antialiased font-sans bg-gray-200">
                <div class="container mx-auto px-4 sm:px-2">
                  <div class="py-1">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight"></h2>
                    </div>
                      @if(count($immunizations) > 0 )
                      <div class="-mx-4 sm:-mx-4 px-4 sm:px-4 py-4 overflow-x-auto">
                          <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                              <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                  <thead>
                                      <tr>
                                          <th class="px-8 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Imm. ID:
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Herd ID: </br> Immunized </br> Date
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Antigen/Adj
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Vol/Site/Route
                                            </br>
                                              Sample/Batch/Source
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Frequency
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Booster Due
                                          </th>
                                          <th class="px-2 py-3 border-b-2 border-gray-200 bg-indigo-400 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                              Actions
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($immunizations as $row)
                                      <tr>
                                        <td class="px-8 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-13 h-10">
                                                    Imm ID: {{ $row->immunization_id }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                              Herd ID: {{ $row->herd_id }}
                                                </br>
                                                Total: {{ $row->total_immunized}} 
                                                </br>{{ date('d-m-Y', strtotime($row->immunization_date)) }}
                                            </p>
                                          <p class="text-gray-900 whitespace-no-wrap">
                                          </p>
                                        </td>
                                        <td class="px-2 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span class="relative inline-block px-3 py-3 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">{{ $row->immunogen_code }} / {{ $row->adjuvent_code }}</span>
                                            </span>
                                        </td>
                                        <td class="px-2 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                              {{ $row->immunogen_volume }}/{{ $row->immunogen_site }}/{{ $row->immunogen_route }}
                                            </p>
                                            </br>
                                            <p class="text-gray-900 whitespace-no-wrap">
                                              {{ $row->sample_volume }}/{{ $row->batch_id }}/{{ $row->sample_source }}
                                            </p>
                                        </td>
                                        <td class="px-2 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ $row->frequency }} Days</p>
                                        </td>
                                        <td class="px-2 py-5 border-b border-gray-200 bg-white text-sm">
                                          <p class="text-gray-900 whitespace-no-wrap">
                                            {{ date('d-m-Y', strtotime(date('Y-m-d', strtotime($row->created_at)). "+ ".$row->frequency." days")) }}
                                          </p>
                                        </td>
                                        <td class="px-2 py-5 border-b border-gray-200 bg-white text-sm">
                                          @hasanyrole('herdmanager|herdasstimmun')
                                            @if($row->status == "complete")
                                                <button wire:click="fullDetails({{ $row->immunization_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                                            @else
                                                <button wire:click="fullDetails({{ $row->immunization_id }})" class="bg-orange-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                                                <button wire:click="editImmunizationInfo({{ $row->immunization_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Edit</button>
                                            @endif
                                                
                                          @endhasanyrole
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      @else
                        <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                            <thead class="bg-indigo-600">
                                <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-4 py-2"> No Immunization Records</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      @endif
                  </div>
                </div>
              </body>
            </div>

            <!--Divider-->
            <hr class="border-b-2 border-gray-600 my-2 mx-4">
            <!--Divider-->
            @if($showDetails)
              <div class="p-5">
                <table class="w-full p-5 text-gray-700">
                  <thead>
                    <tr>
                      <th class="px-3 text-left text-gray-900">Posted By</th>
                      <th class="px-3 text-left text-gray-900">SOP Id</th>
                      <th class="px-3 text-left text-gray-900">Sample</th>
                      <th class="px-5 text-left text-gray-900">Supplied By/Ref</th>
                      @if($imDet->status == "incomplete")
                      <th class="px-5 text-left text-orange-600">Status</th>
                      @else 
                      <th class="px-5 text-left text-gray-900">Status</th>
                      @endif
                      <th class="px-4 text-left text-gray-900">Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="px-3 text-sm text-gray-900" align="left">
                        {{ $imDet->posted_by }}
                      </td>
                      <td class="px-3 text-sm text-gray-900">
                        {{ $imDet->sop_id }}
                      </td>

                      <td class="px-3 w-1/3 text-sm text-gray-900" align="left">
                        {{ $imDet->sample_desc }}
                      </td>
                      <td class="px-5 text-sm text-gray-900" align="left">
                        {{ $imDet->supplied_by }} / {{ $row->sample_ref }}
                      </td>
                      @if($imDet->status == "incomplete")
                          <td class="px-5 text-sm text-orange-600" align="left">
                            {{ ucfirst($imDet->status) }}
                          </td>
                      @else 
                          <td class="px-5 text-sm text-gray-900" align="left">
                            {{ ucfirst($imDet->status) }}
                          </td>
                      @endif
                      <td class="px-4 w-1/4 text-sm text-gray-900" align="left">
                        {{ ucfirst($imDet->remark) }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            @endif
            <!-- insert table -->
            @if($viewEditImmInfo)
              <!--Table Card-->
              <div class="w-full md:w-1/2 p-3">
                <div class="bg-orange-100 border border-gray-800 rounded shadow">
                  <div class="border-b border-gray-800 p-3">
                    <h5 class="font-bold uppercase text-gray-900">Edit Immunization Data Id: {{ $immunization_id }}, Input Fields with * Mandatory</h5>
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
                            <label class="block text-gray-900 text-sm font-normal font-bold pt-3 mb-2" for="species">Date Immunized*</label>
                            <input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="editimm_date" type="date">
                            <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                              @error('editimm_date') <span class="error">{{ $message }}</span> @enderror
                            </label>
                          </td>
                        </tr>

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
                            <input  class="shadow appearance-none border border-red-500 rounded w-full py-1.5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="editimmgen_code" type="text">
                            <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                              @error('editimmgen_code') <span class="error">{{ $message }}</span> @enderror
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
                                  focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="editimadjuvant_code" aria-label="Default select example">
                                  <option selected>Select Adjuvant</option>
                                    @foreach($adjuvants as $adj)
                                      <option value="{{ $adj->nick_name }}">{{ $adj->adjuvant_name }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <label class="error text-orange-900 text-sm font-normal pt-3 mb-2" for="usercode">
                            @error('editimadjuvant_code') <span class="error">{{ $message }}</span> @enderror
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
                                focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model="imfrequnit" aria-label="Default select example">
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
                            <input  class="shadow appearance-none border border-red-500 rounded w-auto py-1.5 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="editimmunogen_volume" type="text">
                            <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                              @error('editimmunogen_volume') <span class="error">{{ $message }}</span> @enderror
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

                        @if( $imm_status == 'incomplete')
                        <tr>
                          <td colspan="3">
                            <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Enter or Scan Goat Id</label>
                          </td>
                        </tr>
                          <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                            <td>
                              <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                                ID Done
                              </label>
                            </td>
                            <td colspan="2">
                                @foreach($idsDone as $row)
                                    {{ $row }};
                                @endforeach
                            </td>
                          </tr>

                          <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                            <td>
                              <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                                ID Remaining
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
                              <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                              Scanned ID
                              </label>
                            </td>
                            <td colspan="2">
                              {{ $scannedGoatIds }}
                            </td>
                          </tr>

                          <tr class="bg-blue-100 border-b dark:bg-gray-200 dark:border-gray-700">
                            <td>
                              <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                                ID (Type or Scan)
                              </label>
                            </td>
                            <td>
                              <input size="15" class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.lazy="scanGoatId2" type="text">
                            </td>
                            <td>
                              <label class="error text-orange-900 text-sm font-normal pt-0 mx-3 mb-0" for="usercode">
                                {{ $scanError2 }}	@error('scanGoatId2') <span class="error">{{ $message }}</span> @enderror
                              </label>
                            </td>
                          </tr>
                        @endif

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
                            <label class="block text-red-700 text-lg font-bold pt-3 mb-2" for="sampdesc">
                                {{ $immErrorMsgEdit }}
                            </label>
                          </td>
                        </tr>
                        
                        <tr>
                          <td colspan="3">
                            <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                              Immunization Status: {{ ucfirst($imm_status) }}
                            </label>
                            <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                              Date Record Created: {{ date('d-m-Y H:i:s', strtotime($imDet->created_at)) }}
                            </label>
                            <label class="block text-gray-900 text-sm pt-3 mb-2" for="sampdesc">
                              Date Last Updated: {{ date('d-m-Y H:i:s', strtotime($imDet->updated_at)) }}
                            </label>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="3" class="text-sm text-gray-900">
                            </br>
                            @hasanyrole('manager|herdmanager')
                                @if($imm_status != 'complete')
                                    <button wire:click="saveImmunizationDetails({{ $immunization_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Save Details</button>
                                @endif
                            @endhasanyrole
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif
            </br></br>
          </div>
        </div>
        <!--/table Card-->
      </div>
      <!-- panel opening/closing -->
      <!-- panel opening/closing -->
      <!--/ Console Content-->
    </div>
  </div>
</div>
