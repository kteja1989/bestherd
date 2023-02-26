<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
    <div class="border-b border-gray-800 p-3">
        <h5 class="font-bold uppercase text-gray-900">Serum ID: {{ $serum_id }} - Herd Id: {{ $herd_id }}</h5>
    </div>
    <div class="p-5">
      <!-- insert table -->
      <!-- insert table -->
	    <table class="w-full p-5 text-gray-700">
	      <thead>
	        <tr>
	          <th class="content-center"></th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr>
	          <td colspan="3">
		          <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
		          	List: Serum Not Collected
		          </label>
	          </td>
	        </tr>
	      </tbody>
	    </table>
	    <!-- end of table -->
	    <hr class="border-b-2 border-gray-600 my-2 mx-1">
	    <!-- List of samples found as table -->
	    <table class="w-full p-5 text-gray-700">
	      <thead>
	        <tr>
	            <th align="left">ID</th>
	            
	            <th align="left">Enter Volume</th>
	            <th align="left">Last Titer</th>
	            <th align="left">Date</th>
				<th align="left">Serum Status</th>
	        </tr>
	      </thead>
	      <tbody>
		      @foreach($goatInfo as $row)
                <tr>
                    @if(!array_key_exists($row->goat_id, $imGoatArray))
        				<td>
        					{{ $row->goat_id }}
        				</td>
                        <td>
                            <input  class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model.lazy="serumvolume.{{ $row->goat_id }}" type="text">
                        </td>
                        <td>
                            @if($row->goatTiter != null)
        					{{ $row->goatTiter->titer_value }}
        					@else
        					    ND
        					@endif
        				</td>
        				<td>@if($row->goatTiter != null)
        					{{ $row->goatTiter->created_at }}
        					@else
        					    ND
        					@endif
        				</td>
 
        				<td align="left">
    						<i class="fa fa-times" aria-hidden="true"></i>
    						<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
    						<span class="error">Not Collected</span>
    						</label>
        				</td>
                    @endif
                </tr>
		      @endforeach
	      </tbody>
	    </table>
	    <!--  -->
    	<hr class="border-b-2 border-gray-600 my-2 mx-1">
    	<div>
	        ND: Not Determined
	    </div>
    </div>
	</div>
</div>
<!--/table Card-->
