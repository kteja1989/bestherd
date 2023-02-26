<div>
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
              <h5 class="font-bold uppercase text-gray-900">Immunogen Base</h5>
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
                @if(count($immunogens) > 0 )
                    <table class='table-auto  mx-auto px-8 w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900 ">
                            <tr class="text-white text-left">
                                <th class="font-semibold text-sm uppercase px-8 py-5"> Name </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Code </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Description </th>
                                <th class="font-semibold text-sm uppercase px-1 py-5"> Posted By </th>
                                <th class="font-semibold text-sm uppercase px-1 py-5"> Date Posted </th>
                                <th class="font-semibold text-sm uppercase px-2 py-5"> Status </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($immunogens as $row)
                                <tr>
                                    <td class="px-8 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->name) }}
                                    </td>  
                                    <td class="px-2 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->code) }}
                                    </td>
                                    <td class="px-3 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->description) }}
                                    </td>
                                    <td class="px-2 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->posted_by) }} 
                                    </td>
                                    <td class="px-2 py-2 text-sm text-gray-900">
                                        {{ date('m-d-Y', strtotime($row->created_at)) }}
                                    </td>
                                    <td class="px-2 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->status) }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                    @hasanyrole('herdmanager')
                                      <button wire:click="editImngnData({{$row->immunogen_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Edit</button>
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
                            Name*
                        </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="nameImngn" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('nameImngn') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                            Code*
                        </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="codeImngn" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('codeImngn') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username"> Description* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model="descImngn" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('descImngn') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                @if(!$addNew)
                <div class="flex justify-left">
                  <div class="mb-3 xl:w-96">
                    <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                        Status*
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
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="status" aria-label="Default select example">
                        <option value="">Select</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('status') <span class="error">{{ $message }}</span> @enderror
                    </label>
                  </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Posted By* </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="postedBy" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('postedBy') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                @endif
                
              </br></br>
              <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                @hasanyrole('pisg|pilg|piblg|pient|investigator|herdmanager')
                    @if($addNew)
                        <button wire:click="addNewImmunogen()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
                    @else
                        <button wire:click="updateImngnData({{ $immunogen_id }})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Update</button>
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
