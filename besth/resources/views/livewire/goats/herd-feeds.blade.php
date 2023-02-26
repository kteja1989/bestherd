<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    {{-- Stop trying to control. --}}
    {{-- The whole world belongs to you. --}}
  <div class="container w-full mx-auto pt-02">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--begin from here-->
      <!--End of Console content-->
      <!--Console Content-->
      <div class="flex flex-wrap">
        @hasanyrole('manager|herdmanager|pient')
          @include('livewire.goats.flexwrapTermsBase')
        @endhasanyrole
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
              <h5 class="font-bold uppercase text-gray-900">Herd Feeds</h5>
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
                @if(count($feeds) > 0 )
                    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                              <th class="font-semibold text-sm uppercase px-6 py-2"> Description</th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Speciality </th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Supplier ID</th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Supply Date </th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Quantity </br> Batch </br> MFD On </th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Received By</th>
                              <th class="font-semibold text-sm uppercase px-4 py-2"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feeds as $row)
                                <tr>
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ ucfirst($row->description) }}</button>
                                    </td>
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ ucfirst($row->speciality) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ $row->supplier_id }}
                                    </td>
                                   <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ date('d-m-Y', strtotime($row->supply_date)) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ $row->quantity }} {{ $row->quantity_unit }}
                                        <p class="text-gray-500 text-sm font-semibold tracking-wide">{{ $row->batch }}</p>
                                        <p class="text-gray-500 text-sm font-semibold tracking-wide">{{ date('d-m-Y', strtotime($row->mfd_date)) }}</p>
                                    </td>
                                    
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        {{ $row->received_by }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-medium px-6 py-4">
                                        <button wire:click="deleteColor({{ $row->feed_id }})" class="bg-orange-600 text-white font-normal py-2 px-4 rounded rounded" >Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                              <th class="font-semibold text-sm uppercase px-6 py-2"> No Data Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td class="text-sm text-gray-900 font-medium px-6 py-4">
                              </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                
              <!--Divider-->
              <hr class="border-b-2 border-gray-600 my-2 mx-4">
              <!--Divider-->
              <table class="w-1/2 p-5 text-gray-700">
                <thead>
                <tr>
                  <th class="text-left text-gray-900">Description</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-sm text-gray-900">
                      Feed Description
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="feed_desc" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('feed_desc') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Feed Speciality
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="feed_speciality" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('feed_speciality') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr class="pt-4">
                    <td class="text-sm text-gray-900">
                      Feed Supplier
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                        <div class="flex justify-left">
                          <div class="mb-3 xl:w-96">
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
                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model.defer="feed_supplier_id" aria-label="Default select example">
                                <option value="select" selected>Select Supplier</option>
                                @foreach($feedSuppliers as $row)
                                  <option value="{{ $row->feedsupplier_id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div> 
                      
                      
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('feed_supplier_id') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                    </tr>
                  
                 

                  <tr>
                    <td class="text-sm text-gray-900">
                      Supply Date
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="supply_date" type="date">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('supply_date') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Quantity
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="quantity" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('quantity') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Quantity Unit
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="quantity_unit" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('quantity_unit') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Batch
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="batch_id" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('batch_id') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Date Manufactured
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="date_mfd" type="date">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('date_mfd') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                  <tr>
                    <td class="text-sm text-gray-900">
                      Received By
                    </td>
                    <td class="text-sm text-gray-900 pt-2">
                      <input size="45" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model="received_by" type="text">
                      </br>
                      <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                      @error('received_by') <span class="error">{{ $message }}</span> @enderror
                      </label>
                    </td>
                  </tr>

                </tbody>
              </table>
              </br></br>
              <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                @hasanyrole('herdmanager')
                  <button wire:click="addNewFeed()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
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
