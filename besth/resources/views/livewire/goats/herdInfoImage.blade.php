	<!--Table Card-->
	<div class="w-full md:w-1/2 p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
                <h5 class="font-bold uppercase text-gray-900">Details of Herd Id: {{ $herd_id }}</h5>
            </div>
            <div class="p-5">
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                          <th class="text-left text-gray-900">Color-Id</th>
                          <th class="text-left text-gray-900">Location</th>
                          <th class="text-left text-gray-900">Assigned End-Use</th>
                          <th class="text-left text-gray-900">Size</th>
                          <th class="text-left text-gray-900">Count</th>
                          <th class="text-left text-gray-900">Vacancy</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($herdInfo as $row)
						<?php
							$ccs = "bg-".$row->color."-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 rounded";
						?>
                        <?php $category = $row->category; ?>
                            <tr>
                                <td class="text-sm text-gray-900" align="left">
                                    <button class="{{ $ccs }}">Color</button>
                                    <!-- button class="{{ $ccs }}" >{{ $row->herd_id }}</button -->
                                </td>
                                <td class="text-sm text-gray-900">
                                    {{ $row->location }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                   {{ $row->description }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ $row->total_size }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ $row->total_count }}
                                </td>
                                <td class="text-sm text-gray-900" align="left">
                                    {{ ($row->total_size-$row->total_count) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- insert table -->
                <!-- insert table -->
                <div class="p-2">
                    <table class="table-auto w-full rounded-lg  p-5 text-gray-700">
                        <thead></thead>
                        <tbody>
                            @if( $viewGoatList)
                                <tr class="bg-orange-200 border-b dark:bg-gray-200 dark:border-gray-700">
                            		<td class="bg-orange-200">
                            			<label class="block text-gray-900 text-sm font-bold px-5 pt-3 mb-2" for="exptdesc">
                            				ID (Type or Scan)
                            			</label>
                            		</td>
                            		<td class="px-2 py-2">
                            			<input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.lazy="scanGoatId" type="text">
                            		</td>
                            	</tr>
                            	<tr class="bg-orange-200 border-b dark:bg-gray-200 dark:border-gray-700">
                            	    <td></td>
                            		<td>
                            			<label class="error text-orange-900 text-center text-sm font-bold mx-4 pt-0 mb-2" for="usercode">
                            				{{ $scanError }}	@error('scanGoatId') <span class="error">{{ $message }}</span> @enderror
                            			</label>
                            		</td>
                            	</tr>
                        	@endif
                            <tr>
                                <td colspan="3">
                                    <label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
                                        Herd Member List
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end of table -->
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <!-- List of samples found as table -->
                @if( $viewGoatList)
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                                <th align="left">Action</th>
                                <th align="left">Gender</th>
                                <th align="left">DoB</th>
                                <th align="left">Cur. Age</th>
                                <th align="left">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($curGoatList as $row)
                                <?php
                                    $ts1 = strtotime($row->dob);
                                    $ts2 = strtotime(date('Y-m-d'));
                                    
                                    $year1 = date('Y', $ts1);
                                    $year2 = date('Y', $ts2);
                                    
                                    $month1 = date('m', $ts1);
                                    $month2 = date('m', $ts2);
                            
                                    $age = (($year2 - $year1) * 12) + ($month2 - $month1);
                                ?>
                            
                                @if( $age > 50 )
                                    <tr class="border-b px-3 bg-indigo-100 border-indigo-200">
                                @else
                                    <tr>
                                @endif
                                        <td>
                                            <button wire:click="viewGoatDetails({{$row->goat_id}})" class="{{ $ccs }}" >ID: {{ str_pad($row->goat_id,3,'0',STR_PAD_LEFT) }}</button>
                                        </td>
                                        <td>
                                            {{ $row->gender }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($row->dob)) }}
                                        </td>
                                        <td>
                                            {{ $age }} {{ $row->age_unit }}
                                        </td>
                                        <td>
                                            {{ $row->source }}
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                                @if( tenant('id') == "demo" || tenant('id') == "ybl" )
                                    <th align="left">Goat(s) Not Found</th>
                                @endif
                                @if( tenant('id') == "raut" )
                                    <th align="left">Ponies Not Found</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                @endif

                <hr class="border-b-2 border-gray-600 my-2 mx-1">
            </div>
		</div>
	</div>
	<!--/table Card-->
