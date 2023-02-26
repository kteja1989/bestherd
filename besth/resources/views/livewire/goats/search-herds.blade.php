<div>
  {{-- Success is as dangerous as failure. --}}
  @hasanyrole('manager|herdmanager|pient')
    @include('livewire.goats.flexwrapSearch')
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
              <h5 class="font-bold uppercase text-gray-900">Active Herds</h5>
            </div>
            <div class="errors">
              @if (session()->has('formmessage'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif
            </div>
            <div class="p-5">
              <table class="w-full p-5 text-gray-700">
                <thead>
                  <tr>
                    <th class="text-left text-gray-900">
                      <button wire:click="viewHerdSearchForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Search Herds</button>
                    </th>
                    <th class="text-left text-gray-900">
                      <button wire:click="viewGoatSearchForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Search Goats</button>
                    </th>
                    <th class="text-left text-gray-900">
                      <button wire:click="viewImmSearchForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Search Immunization</button>
                    </th>
                    <th class="text-left text-gray-900">
                      <button wire:click="viewPlasmaSearchForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Search Plasmapheresis</button>
                    </th>
                    <th class="text-left text-gray-900">
                      <button wire:click="viewHealthSearchForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Search Health Records</button>
                    </th>
                  </tr>
                </thead>
              <tbody>
              </tbody>
              </table>
            </div>
            
            
          <div class="p-3">
            <table class="w-full p-5 text-gray-700">
              <thead>
                <tr>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="text-left text-gray-900"></th>
                  <th class="px-4 text-left text-gray-900"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-sm text-gray-900" align="left"></td>
                  <td class="text-sm text-gray-900"></td>
                  <td class="text-sm text-gray-900"></td>
                  <td class="text-sm text-gray-900" align="left"></td>
                  <td class="text-sm text-gray-900" align="left"></td>
                  <td class="text-sm text-gray-900" align="left"></td>
                  <td class="text-sm text-gray-900" align="left"></td>
                  <td class="text-sm text-gray-900"></td>
                </tr>
              </tbody>
            </table>
            <!--Divider-->
            <hr class="border-b-2 border-gray-600 my-2 mx-4">
            <table class="w-full p-5 text-gray-700">
              <thead>
                <tr>
                  <th class="text-left text-gray-900"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-sm text-gray-900" align="left"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- insert table -->
          <!-- insert table -->
          </br></br>
          </div>
        </div>
        <!--/table Card-->
        <!-- panel opening/closing -->
        @if($viewSearchGoatForm)
          @include('livewire.goats.goatSearchForm')
        @endif

        @if($viewSingleGoatInfo)
          @include('livewire.goats.singleGoatInfo')
        @endif

        @if($showImmSearchForm)
          @include('livewire.goats.immSearchForm')
        @endif

        @if($showHealthSearchForm)
          @include('livewire.goats.healthSearchForm')
        @endif

      <!-- panel opening/closing -->
      </div>
      <!--/ Console Content-->
    </div>
  </div>
</div>
