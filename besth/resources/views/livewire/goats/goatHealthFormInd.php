<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Goats in Herd Id: {{ $herd_id }}</h5>
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
                      	Goat List: For Health Records
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
                        <th align="left">Weight</th>
                    	<th align="left">Hb</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($gidArray as $key => $row)
                    <tr>
        				<td>
        					{{ $key }}
        				</td>
                        <td>
                
                        </td>
        				<td>
        					<i class="fa fa-check" aria-hidden="true"></i>
        				</td>
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
