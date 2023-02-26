<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container w-full mx-auto pt-3">
      <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
        <div class="border-b border-gray-800 p-3">
          <div class="flow-root">
            <p class="float-right">
              <button wire:click='close()' class="bg-red-400 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 rounded">Close</button>
            </p>
            <p class="float-left">
              <h5 class="font-bold uppercase text-gray-900">Health Details: Goat ID - {{ $goat_id }} in Herd - {{ $herd_id }}</h5>
            </p>
          </div>
        </div>
        <div class="p-2 bg-white w-full max-w-md m-auto flex-col flex">
        </div>
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Health Details {{ $goat_id }}</h5>
            </div>
            <div class="p-2 content-center">
              <div class="px-5 py-2 content-center">
                 @if(count($goatHealth) > 0 )
                <table class="w-full p-5 text-gray-700">
                  <tr>
                    <th class="px-2 text-left text-gray-900">SOP</th>
                    <th class="px-2 text-left text-gray-900">Date </th>
                    <th class="px-2 text-left text-gray-900">Hb</th>
                    <th class="px-2 text-left text-gray-900">Weight</th>
                    <th class="px-2 text-left text-gray-900">Temperature</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($goatHealth as $row)
                        <tr>
                            <td class="px-2 text-sm text-gray-900">
                                {{ $row->sops->description }}
                            </td>
                            <td class="px-2 text-sm text-gray-900" align="left">
                                {{ date('d-m-Y', strtotime($row->date_observed)) }}
                            </td>
                            <td class="px-2 text-sm text-gray-900" align="left">
                                {{ $row->hb }}
                            </td>
                            <td class="px-2 text-sm text-gray-900" align="left">
                                 {{ $row->weight }}
                            </td>
                            <td class="px-2 text-sm text-gray-900" align="left">
                                 {{ $row->temperature }}
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
              </table>
                @else
                <table class="w-full p-5 text-gray-700">
                  <tr>

                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td class="px-2 text-sm text-gray-900">
                      Data NOT Found
                    </td>
                  </tr>
                 
                </tbody>
              </table>
              @endif
              
            </div>

            
              <div class="px-5 py-2 content-center">
                @if(!empty($herdHealth) )
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                                
                                <th class="text-left text-gray-900">Health Notes</th>
                                <th class="text-left text-gray-900">Suggestions</th>
                                <th class="text-left text-gray-900">Action Taken</th>
                                <th class="text-left text-gray-900">Date of Action Taken</th>
                                <th class="text-left text-gray-900">Veternarian</th>
                                <th class="text-left text-gray-900">Action Taken by</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->health_notes }}
                                </td>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->suggestions }}
                                </td>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->action_taken }}
                                </td>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->atr_on }}
                                </td>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->vet_name }}
                                </td>
                                <td class="px-2 text-sm text-gray-900" align="left">
                                    {{ $herdHealth->atr_acted_by }}
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                @else
                    <table class="w-full p-5 text-gray-700">
                        <tr>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td class="px-2 text-sm text-gray-900">
                                  Data NOT Found
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
              </div>
          </div>
        </div>
      </div>
    </div>
</div>
