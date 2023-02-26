      <div class="w-full md:w-full sm:w-full p-3">
        <div class="bg-orange-100 border border-gray-800 rounded shadow">
          <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Recent Bulk Goat Entries</h5>
          </div>
          <!--Divider-->
          <div class="p-5">
          <!-- insert table -->

            <!-- insert a table containing buttons of various types of entry -->
            <hr class="border-b-2 border-gray-600 my-2 mx-1">
            <!-- insert table -->
            @if(count($newGoatDetails) > 0)
                <table class="table-fixed w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                            <th align="center">Herd ID</th>
                            <th align="center">Gender</th>
                            <th align="center">Gentic Bg</th>
                            <th align="center">DoB</th>
                            <th align="center">Source</th>
                            <th align="center">Quarantine Start</th>
                            <th align="center">Quarantine End</th>
                            <th align="center">Source Reference</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($newGoatDetails as $key => $row)
                        
                            @if($flag[$row->goat_id] == 'false')
                            <tr class="border-b px-3 bg-red-300 border-indigo-200">
                            @else
                            <tr class="border-b px-3 bg-green-300 border-green-200">
                            @endif
                            
                                <td>
                                    <input disabled class="cursor-not-allowed shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 mt-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="nge.{{ $row->goat_id }}.9" type="text">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.9') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" wire:model.defer="nge.{{ $row->goat_id }}.1" type="text">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.1') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model.defer="nge.{{ $row->goat_id }}.2" type="text">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.2') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.defer="nge.{{ $row->goat_id }}.3" type="date">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.3') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model.defer="nge.{{ $row->goat_id }}.4" type="text">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.4') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.defer="nge.{{ $row->goat_id }}.5" type="date">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.5') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.defer="nge.{{ $row->goat_id }}.6" type="date">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.6') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td>
                                    <input  class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.defer="nge.{{ $row->goat_id }}.7" type="text">
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('nge.*.7') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                            
    					@endforeach
                    </tbody>
                </table>
           
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="w-25">
                                @if(!$confirmDelete)
                                <th class="text-left text-gray-900"><button wire:click="modalConifrmModal()" class="bg-orange-800 w-26 hover:bg-orange-800 text-white font-normal py-2 px-4 mx-3  rounded">Clear Data</button></th>
                                @else
                                <th class="text-left text-gray-900"><button wire:click="deleteConfirmed()" class="bg-green-800 w-26 hover:bg-green-800 text-white font-normal py-2 px-4 mx-3  rounded">Delete All</button></th>
                                @endif
                            </td>
                            
                            <td class="w-25">
                                <th class="text-left text-gray-900"><button wire:click="processNewGoatEntries()" class="bg-green-800 w-26 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Finalize Data</button></th>
                            </td>
                            
                            
                        </tr>
                    </tbody>
                </table>
            @else
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                            <th class="text-left text-gray-900">
                              No Entries Found
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td></td></tr>
                    </tbody>
                </table>
            @endif
          </div>
          </br></br>
        </div>
      </div>