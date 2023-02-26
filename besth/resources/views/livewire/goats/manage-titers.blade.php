<div>
    @hasanyrole('herdmanager|herdasstimmun|herdserum|herdvet')
        @include('livewire.goats.flexwrapGoat')
    @endhasanyrole

    <div class="container w-full mx-auto pb-40">
        <div class="w-full px-4 md:px-0 md:mt-2 mb-3 text-gray-800 leading-normal">
        <!--Divider-->
        <hr class="border-b-2 border-gray-600 my-2 mx-4">
        <!--Divider-->
            <div class="flex flex-row flex-wrap flex-grow mt-2">
                <!-- Left Panel Graph Card-->
                <div class="w-full md:w-full p-3">
                    <div class="bg-orange-100 border border-gray-800 rounded shadow">
                        <div class="border-b border-gray-800 p-3">
                            <h5 class="font-bold uppercase text-gray-900">Serum Records</h5>
                        </div>
                        <div class="errors">
                            @if (session()->has('formmessage'))
                                <div class="alert alert-success">
                                {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                        @if(count($serumData) > 0 )
                                            <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                                <thead class="bg-white border-b">
                                                    <tr class="border-b bg-orange-300 border-gray-200 rounded-lg">
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Serum ID </br> Date </br> Herd
                                                      </th>
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Count </br> Volume
                                                      </th>
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Batch </br> Status
                                                      </th>
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Authorized By </br> Posted By
                                                      </th>
                                                      <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        Action
                                                      </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($serumData as $row)
                                                        <tr class="bg-gray-100 border-b">
                                                            <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900">
                                                                {{ $row->serum_id }}
                                                                </br>
                                                                {{ date('d-m-Y', strtotime($row->date_collected)) }} 
                                                                </br> 
                                                                Herd: {{ $row->herd_id }}
                                                            </td>
                                                            <td class="text-lg text-gray-600 font-medium px-6 py-4 whitespace-nowrap">
                                                                Total From: {{ $row->number_goats }} </br> Collected: {{ $row->volume }} ml
                                                            </td>
                                                            <td class="text-lg text-gray-600 font-medium px-6 py-4 whitespace-nowrap">
                                                                {{ $row->batch_code }} </br> {{ ucfirst($row->status) }}
                                                            </td>
                                                            <td class="text-lg text-gray-600 font-medium px-6 py-4 whitespace-nowrap">
                                                                Auth By: {{ $row->auth_by }} </br> Posted By: {{ $row->posted_by }}
                                                            </td>
                                                            <td class="text-lg text-gray-600 font-medium px-6 py-4 whitespace-nowrap">
                                                                @hasanyrole('herdmanager|herdserum')
                                                                  @if($row->status == 'incomplete')
                                                                    <button wire:click="fetchTiterDetails('{{ $row->serum_id }}')" class="bg-orange-600 w-22 hover:bg-blue-800 text-white font-normal py-3 px-4 mx-3  rounded">Details</button>
                                                                  @else
                                                                    <button wire:click="fetchTiterDetails({{ $row->serum_id }})" class="bg-green-700 w-22 hover:bg-blue-800 text-white font-normal py-3 px-4 mx-3  rounded">Details</button>
                                                                  @endif
                                                                @endhasanyrole
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                              @else
                                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                    <thead class="bg-orange-400">
                                        <tr class="text-white text-left">
                                            <th class="font-semibold text-sm uppercase px-4 py-2"> No Serum Records</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            @endif
                            </div>
                        </div>
                        <hr class="border-b-2 border-gray-600 my-2 mx-4">
                        <!--Divider-->
                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
                <!--/table Card-->
                <!-- panel opening/closing -->
                @if($viewGoatInfo)
                    @include('livewire.goats.titerDetailsLeft')
                @endif    
                
                @if($viewTiterDetail)
                    @include('livewire.goats.titerDetailsRight')
                @endif
                <!-- panel opening/closing -->
            </div>
            <!--/ Console Content-->
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</div>
