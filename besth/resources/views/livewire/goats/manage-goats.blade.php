<div>
  <!--End of Console content-->
  <div class="container w-full mx-auto pt-20 mb-20 pb-40">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-20 text-gray-800 leading-normal">
      <!--Divider-->
      <hr class="border-b-2 border-gray-600 my-2 mx-4">
      <!--Divider-->
      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!-- Left Panel Graph Card-->
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Active Goats</h5>
            </div>
            <div class="errors">
              @if (session()->has('formmessage'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif
            </div>
            <div class="p-5">
              <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                      <table class="min-w-full text-center">
                        <thead class="border-b">
                          <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                              Age-Band (Years)
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                              Total number
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-2">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if( $agc['ot00y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                0 - 1
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot00y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT00years('$y0001')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          
                          @if( $agc['ot01y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                1 - 2
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot01y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT01years('$y0102')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot02y'] > 0 )
                            <tr class="border-b bg-indigo-100 border-indigo-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                2 - 3
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot02y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    <button wire:click="fetchOT02years('$y0203')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot03y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                3 - 4
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot03y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT03years('$y0304')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif 
                          @if( $agc['ot04y'] > 0 )
                            <tr class="border-b bg-indigo-100 border-indigo-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                4 - 5
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot04y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT04years('$y0405')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot05y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                5 - 6
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot05y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT05years('$y0506')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif 
                          @if( $agc['ot06y'] > 0 )
                            <tr class="border-b bg-indigo-100 border-indigo-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                6 - 7
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot06y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT06years('$y0607')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot07y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                7 - 8
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot07y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT07years('$y0708')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot08y'] > 0 )
                            <tr class="border-b bg-indigo-100 border-indigo-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                8 - 9
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot08y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT08years('$y0809')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                          @if( $agc['ot09y'] > 0 )
                            <tr class="border-b bg-blue-100 border-blue-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                9 - 10
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot09y'] }}
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT09years('$y0910')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif 
                          @if( $agc['ot10y'] > 0 ) 
                            <tr class="border-b bg-indigo-100 border-indigo-200">
                              <td class="text-sm text-gray-900 font-medium px-4 py-3 whitespace-nowrap">
                                > 10
                              </td>
                              <td class="text-sm text-gray-900 font-light px-4 py-3 whitespace-nowrap">
                                    {{ $agc['ot10y'] }}
                              </td>
                              <td class="text-sm text-white font-light px-4 py-3 whitespace-nowrap">
                                <button wire:click="fetchOT10years('$ygt10')" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Details</button>
                              </td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- insert table -->
            </br></br>
          </div>
        </div>
        <!--/table Card-->
        <!-- panel opening/closing -->
        <!-- panel opening/closing -->
      </div>
      <!--/ Console Content-->
      @if($viewGoatProfile)
        <div class="flex flex-row flex-wrap flex-grow mt-2">
          <!-- Left Panel Graph Card-->
          <div class="w-full md:w-full p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow">
                <div class="border-b border-gray-800 p-3">
                    <h5 class="font-bold uppercase text-gray-900">Active Goats {{ $panelTitle }}</h5>
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
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Check </th>
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Goat ID</th>
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Herd ID </th>
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Gender </th>
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Date of Birth</th>
                                <th class="font-semibold text-sm uppercase px-4 py-4"> Age</th>
                            </tr>
                        </thead>  
                      <tbody>
                        @if( count($agpfull) > 0 )
                          @foreach($agpfull as $row)
                            <?php
                                $ts1 = strtotime($row->dob);
                                $ts2 = strtotime(date('Y-m-d'));
                                $year1 = date('Y', $ts1);
                                $year2 = date('Y', $ts2);
                                $month1 = date('m', $ts1);
                                $month2 = date('m', $ts2);
                                $age = (($year2 - $year1) * 12) + ($month2 - $month1);
                            ?>
                            <tr>
                              <td class="px-8 py-4">
                                <div class="form-check">
                                  <input class="form-check-input appearance-none h-6 w-6 border border-red-200 rounded-sm bg-pink-200 checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model="goatArray.{{ $row->goat_id }}" type="checkbox" value="{{ $row->goat_id }}" id="flexCheckDefault">
                                  <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">  </label>
                                </div>
                              </td>
                                <td class="px-4 py-4 text-sm text-gray-900" align="left">
                                    {{ $row->goat_id }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                  {{ $row->herd_id }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                  {{ $row->gender }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                  {{ date('d-m-Y', strtotime($row->dob)) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-900">
                                  {{ $age }} months
                                </td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                </div>
              
                <div class="py-8 mx-auto w-2/3 content-center">
                    <div class="content-center">
                        @include('livewire.goats.goatExitForm')
                        @hasanyrole('herdmanager|veterinarian')
                            <button wire:click="processGoatProfile()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mt-2 mx-25  rounded">Exit Goat</button>
                        @endhasanyrole
                    </div>
                </div>
              
              <div class="p-2">
                </br></br>
              </div>
              <!-- insert table -->
              </br></br>
            </div>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
