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
              <h5 class="font-bold uppercase text-gray-900">Plasmapheresis Details: Goat ID - {{ $goat_id }} in Herd - {{ $herd_id }}</h5>
            </p>
          </div>
        </div>
        <div class="p-2 bg-white w-full max-w-md m-auto flex-col flex">
        </div>
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Details of Serum ID {{ $serum_id }}</h5>
            </div>
            <div class="p-2 content-center">
              <div class="px-5 py-2 content-center">
                <table class="w-full p-5 text-gray-700">
                  <tr>
                    <th class="px-2 text-left text-gray-900">SOP</th>
                    <th class="px-2 text-left text-gray-900">Date </th>
                    <th class="px-2 text-left text-gray-900">Code</th>
                    <th class="px-2 text-left text-gray-900">Volume</th>
                    <th class="px-2 text-left text-gray-900">Notes</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($plasmaData as $row)
                  <tr>
                    <td class="px-2 text-sm text-gray-900">
                      {{ substr($row->sops->description, 0, 20) }}
                    </td>
                    <td class="px-2 text-sm text-gray-900" align="left">
                      {{ date('d-m-Y', strtotime($row->date_collected)) }}
                    </td>
                    <td class="px-2 text-sm text-gray-900" align="left">
                      {{ $row->batch_code }}
                    </td>
                    <td class="px-2 text-sm text-gray-900" align="left">
                      {{ $row->volume }}
                    </td>
                    <td class="px-2 text-sm text-gray-900" align="left">
                      {{ $row->notes }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            @if( count($plasmaData) > 0 )
              <div class="px-5 py-2 content-center">
                <table class="w-full p-5 text-gray-700">
                  <thead>
                      <tr>
                        <th class="text-left text-gray-900">Total Goats</th>
                        <th class="text-left text-gray-900">Authorized By</th>
                        <th class="text-left text-gray-900">Posted By</th>
                        <th class="text-left text-gray-900">Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($plasmaData as $row)
                      <tr>
                        <td class="text-sm text-gray-900">
                            {{ $row->number_goats }}
                        </td>
                        <td class="text-sm text-gray-900">
                            {{ $row->auth_by }}
                        </td>
                        <td class="text-sm text-gray-900" align="left">
                          {{ $row->posted_by }}
                        </td>
                        <td class="text-sm text-gray-900" align="left">
                          {{ $row->status }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="p-5 content-center">
                <table class="w-full p-5 text-gray-700">
                    <thead>
                      <tr>
                        <th class="text-left text-gray-900">Data Not Found</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
