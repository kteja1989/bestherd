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
              <h5 class="font-bold uppercase text-gray-900">Procedures</h5>
            </div>
            <div class="errors">
              @if (session()->has('formmessage'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif
              @if (!empty($lwMessage))
                <div class="alert alert-success">
                  {{ $lwMessage }}
                </div>
              @endif
            </div>
            <div class="p-5">
                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Activity </th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Title </th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Description </th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Validity </th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Status</th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> File</th>
                            <th class="font-semibold text-sm uppercase px-4 py-2"> Action</th>
                        </tr>
                    </thead>
                <tbody>
                  @if(count($procedures) > 0 )
                    @foreach($procedures as $row)
                      <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">
                            {{ ucfirst($row->activits->activity) }}
                        </td>  
                        <td class="px-4 py-2 text-sm text-gray-900">
                        {{ $row->title }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">
                        {{ ucfirst($row->description) }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">
                        {{ date('m-d-Y', strtotime($row->validity_date)) }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">
                        {{ ucfirst($row->status) }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900">
                        {{ ucfirst($row->filename) }}
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-900" align="left">
                        {{ $row->protocol_id }}
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td class="text-sm text-gray-900">
                        None to diplay!
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
              <!--Divider-->
              </br>
              <hr class="border-b-2 border-gray-600 my-2 mx-4">
              <!--Divider-->
            </br>
                <div class="flex justify-left">
                  <div class="mb-3 xl:w-96">
                    <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                        Department
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
                        Activity Group
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
                            <option value="{{ $row->activity_id }}">{{ $row->activity }}</option>
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
                            Title
                        </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="title" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('title') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username"> Description </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="description" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('description') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Version Id </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="versionId" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('versionId') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approved By </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="approvedBy" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedBy') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Date Approved </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedDate" wire:model="approvedDate" type="date">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedDate') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approval Reference </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="approvedRef" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('approvedRef') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Approval Authority </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="authority" wire:model="authority" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('authority') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Valid Till </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="validTill" wire:model="validTill" type="date">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('validTill') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

              </br></br>
              <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                @hasanyrole('pisg|pilg|piblg|pient|investigator|herdmanager')
                  <button wire:click="addNew()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
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
