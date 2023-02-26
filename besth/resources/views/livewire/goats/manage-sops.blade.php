<div>{{-- Stop trying to control. --}}
    {{-- The whole world belongs to you. --}}
  <div class="container w-full mx-auto pt-20">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--begin from here-->
      <!--End of Console content-->
      <!--Console Content-->
      <div class="flex flex-wrap">

      </div>
      <!-- End of Console Content-->

      <!--Divider-->
      <hr class="border-b-2 border-gray-600 my-2 mx-4">
      <!--Divider-->
      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!-- Left Panel Graph Card-->
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Standard Operating Procedures</h5>
            </div>
            <div class="errors">
                @if (session()->has('formmessage'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
                @endif
                @if (!empty($lwMessage))
                    <div class="alert alert-success font-semibold text-sm uppercase px-4 py-2">
                      {{ $lwMessage }}
                    </div>
                @endif
            </div>
            <div class="p-5 px-12">
                @if(count($sops) > 0 )
                    <table class='table-auto  mx-auto px-8 w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900 ">
                            <tr class="text-white text-left">
                                <th class="font-semibold text-sm uppercase px-8 py-5"> Activity </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Title </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Description </th>
                                <th class="font-semibold text-sm uppercase px-1 py-5"> Repetition </th>
                                <th class="font-semibold text-sm uppercase px-2 py-5"> Validity </th>
                                <th class="font-semibold text-sm text-center uppercase px-4 py-5"> File</th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sops as $row)
                                <tr>
                                    <td class="px-8 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->activits->activity) }}
                                    </td>  
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ $row->title }}
                                    </td>
                                    <td class="w-60 px-3 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->description) }}
                                    </td>
                                    <td class="w-20 px-2 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->repeat_time) }} {{ ucfirst($row->repeat_unit) }}
                                    </td>
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ date('m-d-Y', strtotime($row->validity_date)) }}
                                    </td>
                                    
                                    @if($row->filename !=  null)
                                    <?php $file = $row->path.'/'.$row->filename; ?>
                                    <td class="px-3 py-2 text-sm text-gray-900">
                                        <button wire:click="downloadSOP({{$row->sop_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">View</button>
                                    </td>
                                    @else
                                        <td class="px-2 py-2 text-center text-sm text-gray-900">
                                            -
                                        </td>
                                    @endif
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                    @hasanyrole('herdmanager')
                                      <button wire:click="editSOP({{$row->sop_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Edit</button>
                                    @endhasanyrole
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class='table-auto  mx-auto px-8 w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                                <th class="font-semibold text-sm uppercase px-4 py-2"> No Data Available </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td class="text-sm text-gray-900">
                                
                              </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <!--Divider-->
                </br>
                <hr class="border-b-2 border-gray-600 my-2 mx-4">
                <!--Divider-->
                </br>
                
                <div class="flex justify-left">
                  <div class="mb-3 xl:w-96">
                    <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                        Department*
                    </label>
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
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="dept" aria-label="Default select example">
                        <option selected>Select Department</option>
                        @foreach($depts as $row)
                            <option value="{{ $row->department_id }}">{{ $row->description }}</option>
                        @endforeach
                    </select>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('dept') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </div>
                </div>
                
                <div class="flex justify-left">
                  <div class="mb-3 xl:w-96">
                    <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                        Activity Group*
                    </label>
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
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="actvits" aria-label="Default select example">
                        <option selected>Select Activity Group</option>
                        @foreach($activities as $row)
                            <option value="{{ $row->activity_id }}">{{ ucfirst($row->activity) }}</option>
                        @endforeach
                    </select>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('actvits') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                            Title*
                        </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="title" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('title') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username"> Description* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="description" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('description') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Repeat Time* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="repeatime" wire:model="repeat_time" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('repeat_time') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                  <div class="mb-3 xl:w-96">
                    <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                        Repeat Time Unit*
                    </label>
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
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="repeat_time_unit" aria-label="Default select example">
                        <option value="">Select</option>
                        <option value="days">Days</option>
                        <option value="week">Weeks</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('repeat_time_unit') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Version Id* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="versionId" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('versionId') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approved By* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="approvedBy" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedBy') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Date Approved* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedDate" wire:model="approvedDate" type="date">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedDate') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approval Reference* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="approvedRef" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedRef') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approval Authority* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="authority" wire:model="authority" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('authority') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Valid Till* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="validTill" wire:model="validTill" type="date">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('validTill') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                      <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="username">
                        Upload SOP File*
                      </label>
                      <input type="file" placeholder="Upload File" wire:model="fileref" multiple>
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('fileref.*') <span class="text-danger error">{{ $message }}</span>@enderror
                      </label>
                    </div>
                </div>

              </br></br>
              <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                @hasanyrole('pisg|pilg|piblg|pient|investigator|herdmanager')
                    @if($addNew)
                        <button wire:click="addNewSop()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
                    @else
                        <button wire:click="updateSop({{$edsop_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Update</button>
                    @endif
                @endhasanyrole
              </label>
              <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>

            </div>
          </div>
        </div>
        <!--/table Card-->
      </div>
      <!--/ Console Content-->
    <!--end of the block-->
    </div>
  </div>
</div>
