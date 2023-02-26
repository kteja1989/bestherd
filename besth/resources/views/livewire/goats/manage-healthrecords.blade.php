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
                            <h5 class="font-bold uppercase text-gray-900">Health Records</h5>
                        </div>
                        <div class="errors">
                            @if (session()->has('formmessage'))
                                <div class="alert alert-success">
                                {{ session('message') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            @if(count($heatlthRecords) > 0 )
                                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                    <thead class="bg-green-400">
                                        <tr class="text-white text-left">
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Date </th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Herd ID</th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Scheduled </br> Type </th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Notes  </br> Suggestions</th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Remark</th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Inspected By</th>
                                            <th class="font-semibold text-gray-700 text-sm uppercase px-4 py-4"> Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($heatlthRecords as $row)
                                            <tr class="odd:bg-gray-200">
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                    {{ date('d-m-Y', strtotime($row->inspected_on)) }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900" align="left">
                                                    {{ $row->herd_id }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900" align="left">
                                                    Sch: {{ $row->scheduled }}
                                                    </br>
                                                    <p class="text-gray-500 text-sm font-semibold tracking-wide">Type: {{ $row->inspect_type }} </p>
                                                </td>
                                                <td class="px-4 py-4 w-1/5 text-sm text-gray-900" align="left">
                                                    Notes: {{ $row->health_notes }}
                                                    </br>
                                                    <p class="text-gray-500 text-sm font-semibold tracking-wide">Sugg: {{ $row->suggestions }} </p>
                                                </td>
                                
                                                <td class="px-4 py-4 w-auto text-sm text-gray-900" align="left">
                                                    <?php $arr3 = explode(';', $row->remarks); ?>
                                                        @foreach($arr3 as $val)
                                                        {{  $val }}</br>
                                                        @endforeach
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900" align="left">
                                                    {{ $row->vet_name }}
                                                </td>
                                                <td class="text-sm text-gray-900">
                                                    @hasanyrole('herdmanager|herdvet')
                                                        <button wire:click="atrRequestClick({{ $row->health_id }})" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">ATR</button>
                                                    @endhasanyrole
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--Divider-->
                            @else 
                                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                    <thead class="bg-green-600">
                                        <tr class="text-white text-left">
                                            <th class="font-semibold text-sm uppercase px-4 py-2"> No Health Records</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        
                        
                        <!--Divider-->
                        @if($atrRequest)
                            <div class="p-5">
                                <table class='table-auto  mx-auto w-full whitespace-wrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                    <thead class="bg-gray-900">
                                        <tr class="text-white text-left">
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> ATR Date</th>
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> Herd ID</th>
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> Action Taken</th>
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> Diagnosis</th>
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> Medication</th>
                                            <th class="font-semibold text-sm uppercase px-4 py-4"> By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($heatlthRecords as $row)
                                            @if($row->health_id == $health_id)
                                                <tr>
                                                    @if($row->atr_on != null)
                                                    <td class="px-8 py-4 w-auto text-sm text-gray-900" align="left">
                                                        {{  date('d-m-Y', strtotime($row->atr_on)) }}
                                                    </td>
                                                    @else
                                                    <td class="px-8 py-4 w-auto text-sm text-gray-900" align="left">
                                                        -
                                                    </td>
                                                    @endif
                                                    
                                                    <td class="px-4 py-4 w-auto text-sm text-gray-900" align="left">
                                                        {{  $row->herd_id }}
                                                    </td>
                                                    
                                                    <?php $arr1 = explode(';', $row->action_taken); ?>
                                                    @foreach($arr1 as $val)
                                                    <td class="px-4 py-4 w-auto text-sm text-gray-900">
                                                    {{  $val }}
                                                    </td>
                                                    @endforeach
                                                    <td class="px-4 py-4 w-auto text-sm text-gray-900" align="left">
                                                        {{  $row->atr_acted_by }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
                <!--/table Card-->
                <!-- panel opening/closing -->
                @if($atrRequest)
                    @include('livewire.goats.atrUpdateForm')
                @endif
                <!-- panel opening/closing -->
            </div>
            <!--/ Console Content-->
        </div>
    </div>
</div>
