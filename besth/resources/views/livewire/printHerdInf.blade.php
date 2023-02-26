<div class="w-2/3 md:w-2/3 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
		<div class="border-b border-gray-800 p-3">
			<h5 class="font-bold uppercase text-gray-900">Herds Report</h5>
		</div>
		<div class="p-5 content-center">
      <table class="w-full p-5 text-gray-700">
        <thead>
            <tr>
              <th class="text-left text-gray-900">From</th>
              <th class="text-left text-gray-900">To</th>
              <th class="text-left text-gray-900">Total Entries</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-sm text-gray-900">
            </td>
            <td class="text-sm text-gray-900">
            </td>
            <td class="text-sm text-gray-900">
               total entries
            </td>
          </tr>
        </tbody>
      </table>
		</div>

		<div class="p-5 content-center">
      <table class="w-full p-5 text-gray-700">
        <thead>
          <tr>
            <th class="text-left text-gray-900">Id</th>
            <th class="text-left text-gray-900">Location</th>
            <th class="text-left text-gray-900">Assigned End-Use</th>
            <th class="text-left text-gray-900">Size</th>
            <th class="text-left text-gray-900">Count</th>
            <th class="text-left text-gray-900">Vacancy</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td class="text-sm text-gray-900" align="left">
                  $row->herd id
              </td>
              <td class="text-sm text-gray-900">
                  $row->location
              </td>
              <td class="text-sm text-gray-900" align="left">
                 $row->description
              </td>
              <td class="text-sm text-gray-900" align="left">
                   $row->total_size
              </td>
              <td class="text-sm text-gray-900" align="left">
               $row->total_count
              </td>
              <td class="text-sm text-gray-900" align="left">
                   ($row->total_size-$row->total_count)
              </td>
          </tr>
        </tbody>
      </table>
		</div>
	</div>
</div>
