<div>
  {{-- The best athlete wants his opponent at his best. --}}
  <div class="container w-full mx-auto pt-20">
    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
      <!--Console Content-->
      <h5 class="px-5 font-normal uppercase text-gray-900">Facility >> Slot Assignment Home</h5>
      <hr class="border-b-2 border-gray-600 my-2 mx-4">
      <div class="flex flex-wrap">
      </div>
      <!--End of Console content-->

      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!--Table Card-->
        <div class="w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Status</h5>
            </div>
            <div class="p-5">
              <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                      <th class="font-semibold text-sm uppercase px-6 py-4"> Check </th>
                      <th class="font-semibold text-sm uppercase px-6 py-4"> Rack ID </th>
                      <th class="font-semibold text-sm uppercase px-6 py-4"> Rack Name </th>
                      <th class="font-semibold text-sm uppercase px-6 py-4"> Availability</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($rackInfos as $rack)
                  <tr>
                    <tr>
        							<td class="px-6 py-4 text-sm text-left text-gray-900">
          							<label class="inline-flex items-center">
          								<input type="checkbox" class="form-checkbox" value="{{ $rack->rack_id }}" wire:model="rackid">
          							</label>
        						</td>
                    <td class="px-6 py-4 text-left text-gray-900">{{ $rack->rack_id }}</td>
                    <td class="px-6 py-4 text-left text-gray-900">{{ $rack->rack->rack_name }}</td>
                    <td class="px-6 py-4 text-left text-gray-900">{{ $rack->total }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <!--/table Card-->

        <!-- Right Panel Graph Card-->
        <div class="w-full md:w-full mt-4">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Pending</h5>
            </div>
          <div class="p-5">
            Here, the details of mice available in mice colony (breeding home) that have near same age will be shown with their IDs to select them for issue of the same.
            </br>
            </br>
            <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
              <thead class="bg-gray-900">
                  <tr class="text-white text-left">
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Check ID </th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Usage ID </th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Strain </th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Sex</th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Age</th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Number </br> Requested</th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Cages </br>Requested</th>
                    <th class="font-semibold text-sm uppercase px-6 py-4"> Actions</th>
                  </tr>
              </thead>
                <tbody>
                  @foreach($issues as $val)
                    <tr class="text-gray-900 text-sm font-normal mt-3 mb-4">
                      <td class="px-8 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                        <label class="inline-flex items-center">
        									<input type="checkbox" class="form-checkbox" value="{{ $val->issue_id }}" wire:model="issx_id">
        								</label>
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                        {{ $val->issue_id }}
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                      	{{ $val->strain->strain_name }}
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                      	{{ $val->sex }}
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                      	{{ $val->age }}-{{ $val->ageunit }}
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                      	{{ $val->number }}
                      </td>
                      <td class="px-6 py-4 text-gray-900 text-xs mt-1 mb-1 font-normal">
                      	{{ $val->cagenumber }}
                      </td>
                      <td>
                        <x-button wire:click="alottSearch({{ $val->issue_id }})" class="bg-pink-500 w-30 hover:bg-blue-800 text-white font-normal py-2 px-3 rounded">Search</x-button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @if($issueWarning)
                <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mt-10" role="alert">
                    <p class="font-bold">Whoops!, can't proceed</p>
                    <p>@if( $msg1 != null ){{ $msg1 }}@endif</p>
                </div>
              @endif
              @if ($issueSuccess)
              <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-10" role="alert">
                  <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                      <p class="font-bold">Usage Request Has been Processed</p>
                      <p class="text-sm">Cages Issued</p>
                    </div>
                  </div>
                </div>
              @endif
            <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
          </div>
          </div>
        </div>
        <!-- / End of right Panel Graph Card-->
        @if($updateMode)
          @include('livewire.alottment.detailsAllottment')
        @endif
      </div>
      <!--/ Console Content-->
    </div>
  </div>
  <!--/container-->
</div>
