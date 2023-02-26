<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
      <h5 class="font-bold uppercase text-gray-600">Active Immunizations: {{ $activeImms }} </h5>
    </div>
    <div class="p-5">
      <table class='mx-auto max-w-2xl w-full mt-1 whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
        <thead class="bg-gray-900">
          <tr class="text-white text-left">
            <th class="font-semibold text-sm uppercase px-6 py-2"> Herd </th>
            <th class="font-semibold text-sm uppercase px-6 py-2"> Booster Due </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($immAlerts as $row)
            <tr>
              <td class="px-6 py-4">
                <div class="flex items-center space-x-3">
                  Herd - {{ $row['herd_id'] }}
                </div>
              </td>
              <td class="px-6 py-4">
                <p class=""> {{ date('d-m-Y', strtotime($row['due_date'])) }} </p>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>