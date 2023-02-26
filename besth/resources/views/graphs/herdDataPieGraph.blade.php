<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
      <h5 class="font-bold uppercase text-gray-600">Herds as on {{ date('d-m-Y')}}</h5>
    </div>
    <div class="p-5">
        <div class='overflow-x-auto w-full'>
            <table class='mx-auto max-w-2xl w-full mt-1 whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                  <tr class="text-white text-left">
                    <th class="font-semibold text-sm uppercase px-6 py-2"> Category </th>
                    <th class="font-semibold text-sm uppercase px-6 py-2"> Information </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                      <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            
                            Herds
                            
                        </div>
                      </td>
                      <td class="text-orange-800 font-bold px-6 py-4">
                        <p class=""> {{ $herdCount }} </p>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4">
                        <p class=""> Capacity </p>
                      </td>
                      <td class="text-orange-800 font-bold px-6 py-4">
                        <p class=""> {{ $htotal_size }} </p>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4">
                        Occupancy
                      </td>
                      <td class="text-orange-800 font-bold px-6 py-4">
                        <p class=""> {{ $htotal_count }} </p>
                      </td>
                    </tr>
                    <tr>
                      <td class="px-6 py-4">
                        Vacancy
                      </td>
                      <td class="text-orange-800 font-bold px-6 py-4">
                        <p class=""> {{ $htotal_size - $htotal_count }} </p>
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-sm text-gray-900" align="left">
                          <div id="cht3">
                            </br>
                            <canvas id="canvas18" height="220" width="300"></canvas>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
