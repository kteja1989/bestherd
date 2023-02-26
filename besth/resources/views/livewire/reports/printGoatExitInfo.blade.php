<div class="w-2/3 md:w-2/3 p-3">
    <div class="bg-orange-100 border border-gray-800 rounded shadow">
    	<div class="border-b border-gray-800 p-3">
    		<h5 class="font-bold uppercase text-gray-900">Goat Exit Report</h5>
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
                {{ count($qr['goatsexited']) }}
              </td>
            </tr>
          </tbody>
        </table>
    	</div>
    	@if( count($qr['goatsexited']) > 0 )
      		<div class="p-5 content-center">
                <table class='table-fixed w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-white border-b">
                        <tr class="border-b bg-orange-300 border-gray-200 rounded-lg">
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Herd Id </br> Date
                          </th>
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Gender </br> DoB </br> GB
                          </th>
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Age Induct</br> Exit Age </br>(monhts)
                          </th>
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Source Ref </br> File 
                          </th>
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Quarant Start</br>End</br>Inducted
                          </th>
                          <th scope="col" class="text-sm text-gray-900 px-3 py-2 text-left">
                            Remarks
                          </th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($qr['goatsexited'] as $row)
                            <tr class="bg-gray-100 border-b">
                                <td class="px-3 py-2 whitespace-wrap text-sm text-gray-900">
                                    {{ $row->herd_id }} </br> {{ date('d-m-Y', strtotime($row->created_at)) }}
                                </td>
                                <td class="text-sm text-gray-600 text-sm  px-3 py-2 whitespace-nowrap">
                                    {{ $row->gender }} </br> {{ date('d-m-Y', strtotime($row->dob)) }} </br> {{ $row->genetic_background }}
                                </td>
                                <td class="text-sm text-gray-600 text-sm  px-3 py-2 whitespace-wrap">
                                    {{ $row->age }}  </br> {{ $row->exit_age }}
                                </td>
                                <td class="text-sm text-gray-600 text-sm  px-3 py-2 whitespace-wrap">
                                    {{ $row->source }} </br> {{ $row->source_ref }}
                                </td>
                                
                                <td class="text-sm text-gray-600 text-sm  px-3 py-2 whitespace-nowrap">
                                     S: {{ date('d-m-Y', strtotime($row->quarantine_start)) }}</br> 
                                     E: {{ date('d-m-Y', strtotime($row->quarantine_end)) }}</br> 
                                     I: {{ date('d-m-Y', strtotime($row->inducted_at)) }}
                                </td>
                                <td class="text-sm text-gray-600 text-sm  px-3 py-2 whitespace-wrap">
                                    {{ ucfirst($row->remark) }}
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
                            <!--
                        	<td colspan="2" class="text-sm p-5 mt-10 text-gray-900">
                        	  <button wire:click="downloadSerumReport()" class="bg-red-700 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-1 mt-4 rounded">Download</button>
                        	</td>
                        	-->
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