<div><!-- do not alter or delete this tag, important for livewire -->
    {{-- The whole world belongs to you. --}}
    <div class="container w-full mx-auto pt-20">
      <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
        <!--begin from here-->
        <!--End of Console content-->
        @include('livewire.tasks.tasksFlexwrap')
    		<!--Divider-->
    		<hr class="border-b-2 border-gray-600 my-2 mx-4">
    		<!--Divider-->
    		<div class="flex flex-row flex-wrap flex-grow mt-2">
    		<!-- Left Panel Graph Card-->
    			<div class="w-full md:w-full p-3">
    				<div class="bg-orange-100 border border-gray-800 rounded shadow">
    					<div class="border-b border-gray-800 p-3">
    						<h5 class="font-bold uppercase text-gray-900">Tasks</h5>
    					</div>
    					<div class="message">
    						@if(!empty($lwMessage))
    							<div class="bg-orange-200 rounded py-1 px-5 text-green-900 mb-1 leading-tight focus:outline-none focus:shadow-outline">
    							{{ $lwMessage }}
    							</div>
    						@endif
    					</div>
    					<div class="errors">
    						@if (session()->has('formmessage'))
    							<div class="alert alert-success">
    								{{ session('message') }}
    							</div>
    						@endif
    					</div>
    					<div class="p-5">
                @if(!empty($personalTasks))
                  <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-900">
                      <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Posted By </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Category </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Date </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Description </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Action</th>
                      </tr>
                    </thead>
      							<tbody class="divide-y divide-gray-200">
    									@foreach($personalTasks as $row)
    										<tr>
    											<td class="px-6 py-4 text-sm text-gray-900" align="left">
    												{{ $row->user->name }}
    											</td>
    											<td class="px-6 py-4 text-sm text-gray-900">
    												{{ $row->category }}
    											</td>
    											<td class="px-6 py-4 text-sm text-gray-900">
    												{{ date('m-d-Y', strtotime($row->date)) }}
    											</td>
    											<td class="px-6 py-4 text-sm text-gray-900">
    												{{ $row->text }}
    											</td>
    											<td class="text-sm text-gray-900">
    												@if($row->self_id == Auth::id() && $row->status == 'Active')
    												<button wire:click="markAsDone({{ $row->task_id }})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2 rounded">Done</button>
    												@endif
    											</td>
    										</tr>
    									@endforeach
  								@else
                    <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                      <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Personal </th>
                        </tr>
                      </thead>
        							<tbody class="divide-y divide-gray-200">
      									<tr>
      										<td class="px-6 py-4 text-sm text-gray-900" align="left">
      											None to diplay
      										</td>
      									</tr>
                      </tbody>
                    </table>
  								@endif
                </br>
    							@if(!empty($groupTasks))
                    <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                      <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Posted By </th>
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Category </th>
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Date </th>
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Description </th>
                          <th class="font-semibold text-sm uppercase px-6 py-4"> Action</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
      									@foreach($groupTasks as $row)
      										<tr>
      											<td class="px-6 py-4 text-sm text-gray-900" align="left">
      												{{ $row->user->name }}
      											</td>
      											<td class="px-6 py-4 text-sm text-gray-900">
      												{{ $row->category }}
      											</td>
      											<td class="px-6 py-4 text-sm text-gray-900">
      												{{ date('m-d-Y', strtotime($row->date)) }}
      											</td>
      											<td class="px-6 py-4 text-sm text-gray-900">
      												{{ $row->text }}
      											</td>
      											<td class="px-6 py-4 text-sm text-gray-900">
      												@if($row->self_id == Auth::id() && $row->status == 'Active')
      													<button wire:click="markAsDone({{ $row->task_id }})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2 rounded">Done</button>
      												@endif
      											</td>
      										</tr>
      									@endforeach
    								@else
                      <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                          <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Group </th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          <tr>
                            <td class="px-6 py-4 text-sm text-gray-900" align="left">
                              None to diplay
                            </td>
                          </tr>
                        </tbody>
                      </table>
    								@endif
    							</tbody>
    						</table>
    					</div>
    					<!--Divider-->
    					<hr class="border-b-2 border-gray-600 my-2 mx-4">
    					<!--Divider-->
    					<div class="p-5">
                <table class='table-auto mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                  <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                      <th class="font-semibold text-sm uppercase px-6 py-4"> Task </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200">
    								<tr>
    									<td class="px-6 py-4 text-sm text-gray-900">
    										<span class="bg-yellow-200">
    											<label class="inline-flex items-center">
    												<input type="radio" class="form-radio" wire:model="category" value="personal">
    													<span class="ml-2">Personal</span>
    											</label>
    											<label class="inline-flex items-center ml-6">
    												<input type="radio" class="form-radio" wire:model="category" value="group">
    													<span class="ml-2">Group</span>
    											</label>
    											<p class="help-block"></p>
    											@if($errors->has('category'))
    											<p class="help-block text-red-200">
    												{{ $errors->first('category') }}
    											</p>
    											@endif
    										</span>
    									</td>
    								</tr>
    								<tr>
    									<td colspan="5" class="px-6 py-4 text-sm text-gray-900">
    										<label class="block text-gray-900 text-sm font-normal pt-3 mb-2" for="exptdesc">
    												Task*
    										</label>
    										<textarea placeholder="Description" class="h-40 shadow appearance-none border border-red-500 rounded w-full py-1 px-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="taskText"></textarea>
    									</td>
    								</tr>
    								<tr>
    									<td colspan="5" class="px-6 py-4 text-sm text-gray-900" align="center">
    										<button wire:click="saveTask" class="bg-pink-500 w-30 hover:bg-blue-800 text-white font-normal py-2 px-3 mx-3  rounded">Save</button>
    										</td>
    								</tr>
    							</tbody>
    						</table>
    						<canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
    					</div>
    				</div>
    			</div>
    			<!--/table Card-->
    		</div>
    		<!--/ Console Content-->
        <!--end of the block-->
      </div>
    </div>
</div><!-- do not alter or delete this tag, important for livewire -->
