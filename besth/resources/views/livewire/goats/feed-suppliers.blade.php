<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
      <!--End of Console content-->
  @hasanyrole('manager|herdmanager')
      @include('livewire.goats.flexwrapAdministration')
  @endhasanyrole
  <div class="container w-full mx-auto pt-2">
  	<div class="w-full px-4 md:px-0 md:mt-2 mb-0 text-gray-800 leading-normal">
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
                        <h5 class="font-bold uppercase text-gray-900">Herd Administration: Feed Suppliers</h5>
                    </div>
                    <div class="errors">
                        @if (session()->has('formmessage'))
                            <div class="alert alert-success">
                            {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        @if(count($feedSuppliers) > 0 )
                            <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                <thead class="bg-gray-900">
                                  <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Date </br> Registered</th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Name </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Address </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Contact </br> Numbers </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Email </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Registered By </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Status </th>
                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($feedSuppliers as $row)
                                      <tr>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ date('d-m-Y', strtotime($row->created_at)) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ ucfirst($row->name) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ ucfirst($row->address) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        Pri: {{ $row->contact1 }} </br> Alt: {{ $row->contact2 }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            {{ $row->email }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ ucfirst($row->posted_by) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ ucfirst($row->status) }}
                                        </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                           <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                <thead class="bg-gray-900">
                                    <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-6 py-4">Data Not Found</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-2 text-sm text-gray-900">
                                         Nothing to diplay!
                                        </td>
                                    </tr>
                                </tbody>
                              </table>
                        @endif
                        <!--Divider-->
                        <hr class="border-b-2 border-gray-600 my-2 mx-4">
                        <!--Divider-->
                        <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                        <strong>Register Supplier</strong>
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">
                        <strong>Name</strong>
                        </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevName" wire:model.defer="supp_name" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_name') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username"> <strong> Species </strong> </label>
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
                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model.defer="feed_species" aria-label="Default select example">
                                <option value="select" selected>Select Species</option>
                                @foreach($species as $row)
                                  <option value="{{ $row->species_id }}">{{ $row->species_name }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('feed_species') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Address</strong> </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevAddress" wire:model.defer="supp_address" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_address') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Contact 1</strong> </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegis" wire:model.defer="supp_contact1" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_contact1') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Contact 2</strong> </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegis" wire:model.defer="supp_contact2" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_contact2') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Email</strong> </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegis" wire:model.defer="supp_email" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_email') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Notes</strong> </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegisFile" wire:model.defer="supp_notes" type="text">
                        </br>
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                        @error('supp_notes') <span class="error">{{ $message }}</span> @enderror
                        </label>
                        
                        </br>
                        <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                          @hasanyrole('manager|herdmanager')
                            <button wire:click="saveFeedSupplier()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
                          @endhasanyrole
                        </label>
                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
            </div>
            <!--/table Card-->
            <!-- panel opening/closing -->
            <!-- panel opening/closing -->
          </div>
          <!--/ Console Content-->
        </div>
      </div>
    </div>
  </div>
</div>
