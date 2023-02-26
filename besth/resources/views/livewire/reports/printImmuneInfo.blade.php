<div class="w-2/3 md:w-2/3 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
  		<div class="border-b border-gray-800 p-3">
  			<h5 class="font-bold uppercase text-gray-900">Immunization Report</h5>
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
                      {{ count($qr['immunzns']) }}
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
  @if( count($qr['immunzns']) > 0 )
    <div class="p-5 content-center">
      <table class="w-full p-5 text-gray-700">
        <thead>
          <tr>
            <th class="px-1 text-left text-gray-900">Date</th>
            <th class="px-1 text-left text-gray-900">Total</th>
            <th class="px-1 text-left text-gray-900">Antigen/Adj</th>
            <th class="px-1 text-left text-gray-900">Vol/Site/Route</th>
            <th class="px-1 text-left text-gray-900">Sample Vol/Batch/Source</th>
          </tr>
        </thead>
        <tbody>
          @foreach($qr['immunzns'] as $row)
            <tr>
              <td class="px-1 text-sm text-gray-900" align="left">
                 {{ date('d-m-Y', strtotime($row->immunization_date)) }}
              </td>
              <td class="px-1 text-sm text-gray-900" align="left">
                 {{ $row->total_immunized}}
              </td>
              <td class="px-1 text-sm text-gray-900" align="left">
                  {{ $row->immunogen_code }} / {{ $row->adjuvent_code }}
              </td>
              <td class="px-1 text-sm text-gray-900" align="left">
                  {{ $row->immunogen_volume }}/{{ $row->immunogen_site }}/{{ $row->immunogen_route }}
              </td>
              <td class="text-sm text-gray-900" align="left">
                  {{ $row->sample_volume }}/{{ $row->batch_id }}/{{ $row->sample_source }}
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
      		    <button wire:click="downloadImmunzReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Download</button>
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