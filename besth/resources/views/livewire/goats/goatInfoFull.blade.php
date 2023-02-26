    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">General</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>    
    </table>
    <table class="w-full p-5 text-gray-700">
        <thead>
            <tr>
              <th class="text-left text-gray-900">Gender </br> Age</th>
              <th class="text-left text-gray-900">Genetic </br> Background</th>
              <th class="text-left text-gray-900">Source </br> Ref</th>
              <th class="text-left text-gray-900">Quarant </br> Start</th>
              <th class="text-left text-gray-900">Quarant </br> End</th>
              <th class="text-left text-gray-900">Inducted</br> On</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-sm text-gray-900" align="left">
                    {{ $goatDetails->gender }}, </br> {{ $goatDetails->age }}  {{ $goatDetails->age_unit }}
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ $goatDetails->genetic_background }}
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ $goatDetails->source_reference }} </br> {{ $goatDetails->source_ref_file }}
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ date('d-m-Y', strtotime($goatDetails->quarantine_start)) }}
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ date('d-m-Y', strtotime($goatDetails->quarantine_end)) }} 
                </td>
                <td class="text-sm text-gray-900" align="left">
                    {{ date('d-m-Y', strtotime($goatDetails->inducted_date)) }} 
                </td>
            </tr>
            <tr>
                @if($goatDetails->remark != null)
                <td colspan="4" class="text-sm text-red-800" align="left">
                    Note: {{ $goatDetails->remark }}
                </td>
                @endif
            </tr>
        </tbody>
    </table>
    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">Images</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <!-- end of table -->
    @if(count($goatImgs) > 0)
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($goatImgs as $row)
                    <td>
                        <button wire:click="modalGoatImage({{ $row->mugshot_id }})" class="bg-blue-500  hover:bg-gray-800 text-white font-normal p-1 rounded">
                            <img class="w-28 h-28  " src="{{ asset($row->path.$row->image) }}" alt="User Avatar">
                        </button>
                    </td>
                @endforeach
                </tr>
            </tbody>
        </table>
    @else
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Images Not Found
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    <!-- List of samples found as table -->
    <!-- insert table -->
    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">Immunizations</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>    
    </table>
    <!-- end of table -->
    @if(count($imm_info) > 0)
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="left">Details</th>
                    <th align="left">Date</th>
                    <th align="left">Immunogen</th>
                    <th align="left">Vol/Route</th>
                    <th align="left">Authorized</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($imm_info as $row)
                    <tr>
                        <td>
                          <button wire:click="modalImmInfo({{ $row->immunization_id }})" class="bg-blue-500  hover:bg-gray-800 text-white font-normal px-1 rounded">View</button>
                        </td>
                        <td>
                            {{ date('d-m-Y', strtotime($row->immunztion->created_at)) }}
                        </td>
                        <td> 
                            {{ $row->immunztion->immunogen_code }} / {{ $row->immunztion->adjuvent_code }}
                        </td>
                        <td>
                            {{ $row->immunztion->immunogen_volume }} / {{ $row->immunztion->immunogen_route }}
                        </td>
                        <td>
                           {{ $row->immunztion->auth_by }}
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        </table>
    @else
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Immunizations Not Found
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    <!-- insert table -->
    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">Plasma</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>    
    </table>
    <!-- end of table -->
    @if(count($seraGoat) > 0)
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="left">View</th>
                    <th align="left">Date</th>
                    <th align="left">Serum Id</th>
                     <th align="left">Batch Code</th>
                    <th align="left">Vol</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($seraGoat as $row)
                    <tr>
                        <td>
                            <button wire:click="modalSerumInfo({{ $row->serum_id }})" class="bg-blue-500  hover:bg-gray-800 text-white font-normal px-1 rounded">Details</button>
                        </td>
                        <td>
                            {{ date('d-m-Y', strtotime($row->created_at)) }}
                        </td>
                        <td> 
                            {{ $row->serum_id }}
                        </td>
                        <td> 
                            {{ $row->serum->batch_code }}
                        </td>
                        <td>
                            {{ $row->volume }} ml
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        </table>
    @else
        <table class="w-full p-5 text-gray-700">
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Plasmapheresis Data Not Found
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    <!-- insert table -->
    <!-- insert table -->
    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">Health</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>    
    </table>
    <!-- end of table -->
    <table class="w-full p-5 text-gray-700">
        @if(count($goatHealthInfos) > 0)
            <thead>
                <tr>
                    <th align="left">View</th>
                    <th align="left">SOP</th>
                    <th align="left">Date</th>
    				<th align="left">Hb</th>
    				<th align="left">Wt</th>
    				<th align="left">T C</th>
    				<th align="left">RR</th>
    				<th align="left">MM</th>
    				<th align="left">RC</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($goatHealthInfos as $row)
    				<tr>
    				    <td>
                            <button wire:click="modalHealthInfo({{ $goat_id }})" class="bg-blue-500  hover:bg-gray-800 text-white font-normal px-1 rounded">Details</button>
                        </td>
    				    @if($row->serum != null)
                            <td>
    							{{ ucfirst(substr($row->sops->description,0, 10)) }}
    						</td>
    					@else
    						<td>
    							-
    						</td>
    					@endif
    					<td>
    						{{ date('d-m-Y', strtotime($row->created_at)) }}
    					</td>
    					<td>
    						{{ $row->hb }}
    					</td>
    					<td>
    						{{ $row->weight }}
    					</td>
    					<td>
    						{{ $row->temperature }}
    					</td>
    					<td>
    						{{ $row->resp_rate }}
    					</td>
    					<td>
    						{{ $row->mucous_membrane }}
    					</td>
    					<td>
    						{{ $row->rumen_contractions }}
    					</td>
    				</tr>
    			@endforeach
            </tbody>
        @else
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Health-1 history not found
                    </td>
                </tr>
            </tbody>
        @endif
    </table>
    
    <table class="w-full p-5 text-gray-700">
        @if(count($goatHealthInfos) > 0)
            <thead>
                <tr>
                    <th align="left">Date</th>
    				<th align="left">RBC</th>
    				<th align="left">Plt</th>
    				<th align="left">PCV</th>
    				<th align="left">LFT</th>
    				<th align="left">KFT</th>
    				<th align="left">RTPCR</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($goatHealthInfos as $row)
    				<tr>
    					<td>
    						{{ date('d-m-Y', strtotime($row->created_at)) }}
    					</td>
    					<td>
    						{{ $row->rbc }}
    					</td>
    					<td>
    						{{ $row->platelet }}
    					</td>
    					<td>
    						{{ $row->pcv }}
    					</td>
    					<td>
    						{{ $row->lft }}
    					</td>
    					<td>
    						{{ $row->kft }}
    					</td>
    					<td>
    						{{ $row->rtpcr }}
    					</td>
    				</tr>
    			@endforeach
            </tbody>
        @else 
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Health-2 history not found
                    </td>
                </tr>
            </tbody>
        @endif
    </table>
    <!-- end of table -->
    <table class="w-auto p-5 text-gray-700">
        @if(count($goatHealthInfos) > 0 )
            <thead>
                <tr>
                    <th align="left">Date</th>
                    <th align="left">Observation</th>
                    <th align="left">ATR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($goatHealthInfos as $row)
                    <tr>
                        <td class="w-1/5">
                            {{ date('d-m-Y', strtotime($row->created_at)) }}
                        </td>
                        <td> 
                            {{ $row->observations }}
                        </td>
                        <td>
                            {{ $row->action_taken }}
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        @else
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Sick history not found
                    </td>
                </tr>
                @if($goatDetails->remark != null)
                    <tr>
                        <td colspan="3" class="text-sm text-red-800" align="left">
                        Note: {{ $goatDetails->remark }}
                        </td>
                    </tr>    
                @endif
            </tbody>
        @endif
    </table>
    
    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    <!-- insert table -->
    <table class="w-full p-5 text-pink-700">
        <thead>
            <tr>
                <th align="left">Titers</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>    
    </table>
    <!-- end of table -->
    <table class="w-full p-5 text-gray-700">
        @if(count($goatTiterVal) > 0)
            <thead>
                <tr>
                    <th align="left">Serum ID</th>
                    <th align="left">Date</th>
    				<th align="left">Value</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($goatTiterVal as $row)
    				<tr>
                        <td>
							{{ $row->serum_id }}
						</td>
    					<td>
    						{{ date('d-m-Y', strtotime($row->created_at)) }}
    					</td>
    					<td>
    						{{ $row->titer_value }}
    					</td>
    				</tr>
    			@endforeach
            </tbody>
        @else
            <thead>
                <tr>
                    <th align="left"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-sm text-gray-800" align="left">
                        Titer Details not found
                    </td>
                </tr>
            </tbody>
        @endif
    </table>
    <!-- end of table -->
