<div>
  {{-- In work, do what you enjoy. --}}
  {{-- Stop trying to control. --}}
  {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
  {{-- Do your work, then step back. --}}
  <!--End of Console content-->
  @hasanyrole('herdmanager')
  @include('livewire.goats.flexwrapGoat')
  @endhasanyrole

  <div class="container w-full mx-auto pb-40">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--Divider-->
      <!--Divider-->
      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <div class="w-full md:w-full p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow">
                <div class="border-b border-gray-800 p-3">
                    <h5 class="font-bold uppercase text-gray-900">Errors</h5>
                </div>
            <div class="errors">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-8 col-md-offset-1">
                          <div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <h4><i class="icon fa fa-ban"></i> Error!</h4>
                              @foreach($errors->all() as $error)
                              {{ $error }} <br>
                              @endforeach      
                          </div>
                        </div>
                    </div>
                @endif
                
                <div class="container mx-auto">
                    @if (count($errows) > 0)
                        <div class="w-screen max-w-lg bg-red-200 mx-auto mt-6 p-2">
                        <div class="flex space-x-2">
                          <svg class="w-6 h-6 stroke-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                          <p class="text-red-900 font-semibold">Data File Upload Error</p>
                        </div>
                        @foreach($errows as $error)
                        <p class="ml-8 text-red-800">{{ $error }}</p>
                        @endforeach
                        </div>
                    @endif
                
                    @if(count($sucesup) > 0)
                        <div class="w-screen max-w-lg bg-green-200 mx-auto mt-6 p-2">
                        <div class="flex space-x-2">
                          <svg class="w-6 h-6 stroke-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                          <p class="text-green-900 font-semibold">Bulk Upload Successful</p>
                        </div>
                        @foreach($sucesup as $vals)
                        <p class="ml-8 text-green-800">{{ $vals }}</p>
                        @endforeach
                        </div>
                    @endif
                </div>

                @include('layouts.alerts')
            </div>
            <div class="p-5"></div>
            </div>
        </div>

        <!-- Left Panel Graph Card-->
        <div class="w-1/2 md:w-1/2 sm:w-full p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow">
              <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Bulk Goat Entries</h5>
              </div>
              <!--Divider-->
              <div class="p-5">
                <!-- insert table -->
                <table class="w-full p-5 text-gray-700">
                  <thead>
                    <tr>
                      <th class="text-left text-gray-900">Instructions: Please take note of the following</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-sm text-gray-900" align="left">
                        Use the Excel template provided and fill all the columns as desired
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- insert a table containing buttons of various types of entry -->
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <!-- insert table -->
                <table class="w-full p-5 text-gray-700">
                  <thead>
                    <tr>
                    <th align="left"></th>
                    </tr>
                  </thead>
                <tbody>
                  <tr>
                    <td>
                      <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                        Upload Excel File*
                      </label>
                      <input type="file" placeholder="Upload File" id="sampleExcel" name="sampleExcel" wire:model="sampleExcel" multiple>
                      @error('sampleExcel') <span class="text-danger error">{{ $message }}</span>@enderror
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-sm text-gray-900">
                      </br></br>
                      @hasanyrole('herdmanager')
                      <button wire:click="downloadGoatEntryTemplate()" class="bg-orange-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Download Template</button>
                      <button wire:click="processGoatBulkUpload()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Upload Data</button>
                        @if($pendingEntries)
                            <button wire:click="showPendingEntries()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Show Pending Entries</button>
                        @endif
                      @endhasanyrole
                    </td>
                  </tr>
                </tbody>
                </table>
              </div>
              </br></br>
            </div>
        </div>
        <!--/table Card-->
        <div class="w-1/2 md:w-1/2 sm:w-full p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow">
              <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Bulk Goat Health Parameter Entries</h5>
              </div>
              <!--Divider-->
              <div class="p-5">
              <!-- insert table -->
                <table class="w-full p-5 text-gray-700">
                  <thead>
                    <tr>
                      <th class="text-left text-gray-900">Instructions: Please take note of the following</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-sm text-gray-900" align="left">
                        Use the Excel template provided and fill all the columns as desired
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- insert a table containing buttons of various types of entry -->
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <!-- insert table -->
                <table class="w-full p-5 text-gray-700">
                  <thead>
                  <tr>
                  <th align="left">
                  </th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                        Upload Excel File*
                        </label>
                        <input type="file" placeholder="Upload File" wire:model="sampleGHExcel" multiple>
                        @error('sampleGHExcel') <span class="text-danger error">{{ $message }}</span>@enderror
                      </td>
                    </tr>
                  <tr>
                    <td colspan="3" class="text-sm text-gray-900">
                      </br></br>
                      @hasanyrole('herdmanager')
                        <button wire:click="downloadGoatHealthEntryTemplate()" class="bg-orange-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Download Template</button>
                        <button wire:click="processBulkHealthParamUpload()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Upload Health  Data</button>
                      @endhasanyrole
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              </br></br>
            </div>
        </div>
      <!--/table Card-->
      <!-- panel opening/closing -->
      @if($viewGoatEntries)
        @include('livewire.goats.newGoatEntries')
      @endif
      <!-- panel opening/closing -->
      @if($viewHealthEntries)
        @include('livewire.goats.newHealthEntries')
      @endif
      </div>
      <!--/ Console Content-->
    </div>
  </div>
</div>
