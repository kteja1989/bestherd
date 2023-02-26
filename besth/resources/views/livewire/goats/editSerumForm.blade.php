<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Serum ID: {{ $serum_id }} - Herd ID: {{ $herd_id }}</h5>
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
                      	List: Serum Collected
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
                        <th align="left">Volume Collected</th>
                    	<th align="left">Serum Status</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($goatInfo as $row)
                    <tr>
                        @if(array_key_exists($row->goat_id, $imGoatArray))
            				<td>
            					{{ $row->goat_id }}
            				</td>
                            <td>
                                {{ $imGoatArray[$row->goat_id] }} ml
                            </td>
            				<td>
            					<i class="fa fa-check" aria-hidden="true"></i>
            				</td>
                        @endif
                    </tr>
                  @endforeach
                </tbody>
    	    </table>
    	    <!--  -->
        	<hr class="border-b-2 border-gray-600 my-2 mx-1">
        </div>
	</div>
</div>
<!--/table Card-->
