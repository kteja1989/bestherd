<div>
  <!--End of Console content-->
  @hasanyrole('manager|herdmanager|pient')
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
                    <h5 class="font-bold uppercase text-gray-900">Herd Administration: Receivers</h5>
                </div>
                <div class="errors">
                    @if (session()->has('formmessage'))
                        <div class="alert alert-success">
                        {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-4 py-4"> Valid Date</th>
                            <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Name </th>
                            <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Address </th>
                            <th class="font-semibold text-sm uppercase px-4 py-4"> Registration </th>
                            <th class="font-semibold text-sm uppercase px-4 py-4"> Posted </th>
                            <th class="font-semibold text-sm uppercase px-4 py-4"> File </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @if(count($animalReceivers) > 0 )
                            @foreach($animalReceivers as $row)
                              <tr>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ date('d-m-Y', strtotime($row->valid_date)) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ ucfirst($row->name) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ ucfirst($row->address) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ $row->registration_detail }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ ucfirst($row->posted_by) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                {{ $row->regis_file }}
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr>
                              <td class="text-sm px-6 py-3 text-gray-900">
                                None to diplay!
                              </td>
                            </tr>
                          @endif
                        </tbody>
                    </table>

                    <!--Divider-->
                    <hr class="border-b-2 border-gray-600 my-2 mx-4">
                    <!--Divider-->
                    <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                    <strong>Enter Receiver Details</strong>
                    </label>

                    <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">
                    <strong>Name</strong>
                    </label>
                    <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevName" wire:model="recevName" type="text">
                    
                    <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Address</strong> </label>
                    <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevAddress" wire:model="recevAddress" type="text">
                    
                    <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>CPCSEA Registration</strong> </label>
                    <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegis" wire:model="recevRegis" type="text">
                    
                    <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>Valid Till</strong> </label>
                    <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegis" wire:model="validDate" type="date">

                    <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="username">
                        Upload CPSEA Registrtion*
                    </label>
                    <input type="file" placeholder="Upload File" wire:model="fileref" multiple>
                    </br>
                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('fileref.*') <span class="text-danger error">{{ $message }}</span>@enderror
                    </label>
                                    
                    <label class="block text-gray-900 text-sm mt-5 font-normal mb-2" for="username">  <strong>CPCSEA Registration File</strong> </label>
                    <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="recevRegisFile" wire:model="recevRegisFile" type="text">
                    </br>
                    <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                      @hasanyrole('manager|herdmanager')
                        <button wire:click="saveAnimalReceiverInfo()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
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
