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
              <th class="text-left text-gray-900">Entries Found</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-sm text-gray-900">
                  {{ $fromDate }}
              </td>
              <td class="text-sm text-gray-900">
                  {{ $toDate }}
              </td>
              <td class="text-sm text-gray-900">
                  {{ count($qr['herds']) }}
              </td>
            </tr>
          </tbody>
        </table>
    	</div>
    	@if( count($qr['herds']) > 0 )
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
                  @foreach($qr['herds'] as $row)
                    <tr>
                      <td class="text-sm text-gray-900" align="left">
                          {{ $row['herd_id'] }}
                      </td>
                      <td class="text-sm text-gray-900">
                          {{ $row['location'] }}
                      </td>
                      <td class="text-sm text-gray-900" align="left">
                          {{ $row['description'] }}
                      </td>
                      <td class="text-sm text-gray-900" align="left">
                          {{ $row['total_size'] }}
                      </td>
                      <td class="text-sm text-gray-900" align="left">
                          {{ $row['total_count'] }}
                      </td>
                      <td class="text-sm text-gray-900" align="left">
                          {{ $row['total_size']-$row['total_count'] }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <table class="w-full  p-5 text-gray-700">
              	<thead>
              		<tr>
              		</tr>
              	</thead>
              	<tbody>
              	<tr class=" mt-10 ">
              		<td colspan="2" class="text-sm p-5 mt-10 text-gray-900">
              		  <button wire:click="downloadHerdReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Download</button>
              		</td>
              	</tr>
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