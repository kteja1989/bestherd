<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
		<div class="border-b border-gray-800 p-3">
		<h5 class="font-bold uppercase text-gray-900">Edit Herd Id: {{ $herd_id }}</h5>
		</div>
	<div class="p-5">
		<!-- insert table -->
		<!-- insert table -->
		<table class="table-auto w-full p-5 text-gray-700">
			<thead>
				<tr>
					<th class="content-center"></th>
				</tr>
			</thead>
			<tbody>
				@if($immunEntries)
				    <tr>
    					<td colspan="3" class="w-full">
    						<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
    							Description
    						</label>
    						<input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="editdesc_herd"  wire:model="editherd_desc" type="text">
    					    </br>
    					    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
        						@error('editherd_desc') <span class="error">{{ $message }}</span> @enderror
        					</label>
    					</td>
    				</tr>
    				<tr>
    					<td colspan="3" class="w-full">
    					    <label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="usercode">Gender*</label>
                              <div class="flex justify-left">
                                <div class="mb-1 w-full xl:w-96">
                                  <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="gender_edit" wire:model="editherd_gender" aria-label="Default select example">
                                      <option selected>Select Gender</option>
                                      <option value="Female">Female</option>
                                      <option value="Male">Male</option>
                                      <option value="Mixed">Mixed</option>
                                  </select>
                                </div>
                              </div>
                              <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                @error('editherd_gender') <span class="error">{{ $message }}</span> @enderror
                              </label>
    					</td>
    				</tr>
    				<tr>
    					<td colspan="3" class="w-full" >
    						<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="exptdesc">
    							Color
    						</label>
    						<input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="color_edit"  wire:model="editherd_color" type="text">
    					    </br>
    					    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="herdcolr">
        						@error('editherd_color') <span class="error">{{ $message }}</span> @enderror
        					</label>
    					</td>
					</tr>
				@else
    				<tr>
    					<td colspan="3" class="w-full">
    						<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="editherd_desc">
    							Description
    						</label>
    							{{ $editherd_desc }}
    					</td>
    					<td></td>
    				</tr>
    				<tr>
    					<td colspan="3" class="w-full" >
    						<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="editherd_gender">
    							Gender
    						</label>
    							{{ $editherd_gender }}
    					</td>
    				</tr>
    				<tr>
    					<td colspan="3" class="w-full">
        					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="editherd_gender">
        						Color
        					</label>
        						{{ ucfirst($editherd_gender) }}
        				</td>
        			</tr>
				@endif
			

			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="ehl">
						Location
					</label>
					<input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="location_edit"  wire:model="editherd_location" type="text">
				    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editherd_location') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>

			<tr>
				<td class="w-1/3 px-2">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="capas_editc">
						Herd Capacity
					</label>
						{{ $total_herd_size }}
				</td>
				
				<td class="w-1/3 px-2">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="curr_editc">
						Current Capacity
					</label>
						{{ $herd_total_count }}
    			</td>

				<td class="w-1/3 px-2">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="newcaps_edit">
						New Herd Capacity
					</label>
					<input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="enhs"  wire:model.lazy="editnewherdsize" type="text">
				    </br>
				    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="enhsx">
						@error('editnewherdsize') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>
			
			@if($herdSizeMessage)
			<tr>
				<td colspan="3">
					<label class="block text-red-900 text-sm font-bold pt-3 mb-2" for="tsfx">
						New Herd Size cannot be lower than current strength. Exit goats to decrease size.
					</label>
				</td>
			</tr>
			@endif
			
			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="efid">Feed Description</label>
					<div class="flex justify-left">
						<div class="mb-3 w-full xl:w-96">
							<select class="form-select appearance-none
								block w-full px-3 py-1.5 text-base font-normal text-gray-700
								bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
								rounded transition ease-in-out m-0
								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="feed_edit" wire:model="editfeed_id" aria-label="Default select example">
								<option selected>Select Feed</option>
								@foreach($editHerdFeeds as $row)
									<option value="{{ $row->feed_id }}">{{ $row->description }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="err_feedit">
						@error('editfeed_id') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>
			
			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="ehic">
						Incharge
					</label>
					<input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="ehic"  wire:model="editherd_incharge" type="text">
				    </br>
				    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="err_incharge">
						@error('editherd_incharge') <span class="error">{{ $message }}</span> @enderror
					</label>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<label class="block text-gray-900 text-sm font-bold font-normal pt-3 mb-2" for="editstatus">Status</label>
					@if($herd_total_count <= 0)
					<div class="flex justify-left">
						<div class="mb-3 w-full xl:w-96">
							<select class="form-select appearance-none
								block w-full px-3 py-1.5 text-base
								font-normal text-gray-700
								bg-white bg-clip-padding bg-no-repeat
								border border-solid border-gray-300
								rounded transition ease-in-out m-0
								focus:text-gray-700 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" id="status_edit" wire:model="editherd_status" aria-label="Default select example">
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
							</select>
							</br>
					<label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
						@error('editherd_status') <span class="error">{{ $message }}</span> @enderror
					</label>
						</div>
						
					</div>
					@else
						{{ ucfirst($editherd_status) }}
					@endif
				</td>
			</tr>

			<tr>
				<td colspan="3">
					</br>
					@if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
					<hr class="border-b-2 border-gray-600 my-2 mx-1">
					<label class="block text-gray-900 text-sm font-bold pt-3 mb-2" for="fredt">
					</label>
					<button wire:click="updateHerdInfo({{$herd_id}})" class="bg-blue-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Update</button>
				</td>
			</tr>

			</tbody>
		</table>
		<!-- end of table -->
		<!-- List of samples found as table -->
		<!-- hr class="border-b-2 border-gray-600 my-2 mx-1" -->
		<!--  -->
		<!--  -->
	</div>
	</div>
</div>
<!--/table Card-->
