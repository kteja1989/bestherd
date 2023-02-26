<div>
    <div class="container w-full mx-auto pt-20">
    <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
      <!--begin from here-->
      <!--End of Console content-->
      <!--Console Content-->
      <div class="flex flex-wrap">

      </div>
      <!-- End of Console Content-->

      <!--Divider-->
      <hr class="border-b-2 border-gray-600 my-2 mx-4">
      <!--Divider-->
      <div class="flex flex-row flex-wrap flex-grow mt-2">
        <!-- Left Panel Graph Card-->
        <div class="w-full md:w-full p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Herd Defaults</h5>
            </div>
            <div class="errors">
                @if (session()->has('formmessage'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
                @endif
                @if (!empty($lwMessage))
                    <div class="alert alert-success font-semibold text-sm uppercase px-4 py-2">
                      {{ $lwMessage }}
                    </div>
                @endif
            </div>
            <div class="p-5 px-12">
                @if(count($hdefs) > 0 )
                    <table class='table-auto  mx-auto px-8 w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900 ">
                            <tr class="text-white text-left">
                                
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Description </th>
                                <th class="font-semibold text-sm uppercase px-4 py-5"> Value </th>
                                <th class="font-semibold text-sm uppercase px-2 py-5"> Unit </th>
                                <th class="font-semibold text-sm uppercase px-2 py-5"> Old Value </th>
                                <th class="font-semibold text-sm text-center uppercase px-2 py-5"> Created By</th>
                                <th class="font-semibold text-sm text-center uppercase px-2 py-5"> Created On</th>
                                <th class="font-semibold text-sm text-center uppercase px-2 py-5"> Edited On</th>
                                <th class="font-semibold text-sm uppercase px-8 py-5"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hdefs as $row)
                                <tr>
                                    <td class="px-8 py-2 text-sm text-gray-900">
                                       {{ $row->description }}
                                    </td>  
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ $row->value }}
                                    </td>
                                    <td class="w-60 px-3 py-2 text-sm text-gray-900">
                                        {{ ucfirst($row->unit) }}
                                    </td>
                                    <td class="w-20 px-2 py-2 text-sm text-gray-900">
                                        {{ $row->old_value }}
                                    </td>
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ $row->created_by }}
                                    </td>
                                    
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ date('d-m-Y', strtotime($row->created_at)) }}
                                    </td>
                                    
                                    <td class="w-30 px-2 py-2 text-sm text-gray-900">
                                        {{ date('d-m-Y', strtotime($row->updated_at)) }}
                                    </td>
            
                                  
                                    <td class="px-4 py-2 text-sm text-gray-900">
                                    @hasanyrole('herdmanager')
                                      <button wire:click="editDefault({{$row->herdefault_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Edit</button>
                                    @endhasanyrole
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class='table-auto  mx-auto px-8 w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                        <thead class="bg-gray-900">
                            <tr class="text-white text-left">
                                <th class="font-semibold text-sm uppercase px-4 py-2"> No Data Available </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td class="text-sm text-gray-900">
                                
                              </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <!--Divider-->
                </br>
                <hr class="border-b-2 border-gray-600 my-2 mx-4">
                <!--Divider-->
                </br>
                
                @if($editHerdDefault)



                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">
                            Description
                        </label>
                            {{ $def_desc }}
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username"> Value </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="def_value" wire:model="def_value" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('def_value') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Unit </label>
                        <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="def_unit" wire:model="def_unit" type="text">
                        <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                            @error('def_unit') <span class="error">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Old Value </label>
                            {{ $old_value }}
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Created By </label>
                            {{ $created_by }}
                    </div>
                </div>

                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Created On </label>
                            {{ $created_at }}
                    </div>
                </div>
                
                <div class="flex justify-left">
                    <div class="mb-3 xl:w-96">
                        <label class="block text-gray-900 text-lg font-bold mb-2" for="username">  Lasted Edited On </label>
                            {{ $updated_at }}
                    </div>
                </div>

              </br></br>
              <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                @hasanyrole('herdmanager')
            
                        <button wire:click="updateHerdDefault({{$herdefault_id}})" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Update</button>
                   
                @endhasanyrole
              </label>
              <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
            @endif
            
            </div>
          </div>
        </div>
        <!--/table Card-->
      </div>
      <!--/ Console Content-->
    <!--end of the block-->
    </div>
  </div>
</div>
