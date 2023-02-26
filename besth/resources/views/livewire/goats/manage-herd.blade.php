<div>
    {{-- Stop trying to control. --}}
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{-- Do your work, then step back. --}}
    <!--End of Console content-->
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
                            <h5 class="font-bold uppercase text-gray-900">
                                
                                    Active Herds
                               
                                
                            </h5>
                        </div>
                        <div class="errors">
                            @if (session()->has('formmessage'))
                                <div class="alert alert-success">
                                {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        
                        @hasanyrole('herdmanager') 
                            <div class="p-5">
                                <table class="w-full p-5 text-gray-700">
                                    <thead>
                                        <tr>
                                            @hasanyrole('herdmanager')
                                                <th class="text-left text-gray-900">
                                                    <button wire:click="viewNewHerdForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Add New</button>
                                                </th>
                                            @endhasanyrole
                                            
                                            @if($showDashButton)
                                                <th class="text-left text-gray-900">
                                                <button wire:click="showMainDashInfo()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Show Dashboard</button>
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        @endhasanyrole
                        
                        <div class="bg-indigo-100 py-2">
                          <div class='overflow-x-auto w-full'>
                            <div class="p-2">
                                @if($dashInfo)
                                  @if(count($herds) > 0)
                                  <div class="p-5">
                                    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                      <thead class="bg-gray-900">
                                        <tr class="text-white text-left">
                                          <th class="font-semibold text-sm uppercase px-6 py-2"> Color-Id</br> Category </br> Location</th>
                                          <th class="font-semibold text-sm uppercase px-4 py-2"> Use Case </th>
                                          <th class="font-semibold text-sm uppercase px-4 py-2"> Capacity</th>
                                          <th class="font-semibold text-sm uppercase px-4 py-2"> Fitness </br> Check On</th>
                                          <th class="font-semibold text-sm uppercase px-4 py-2"> Actions: Create New Records </th>
                                        </tr>
                                      </thead>
                                      <tbody class="divide-y divide-gray-200">
                                        @foreach($herds as $row)
                                          <?php
                                            $ccs = "bg-".$row->color."-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 rounded";
                                          ?>
                                          <tr>
                                            <td class="px-6 py-4">
                                              <div class="flex items-center space-x-3">
                                                <button wire:click="fetchHerdInfo({{$row->herd_id}})" class= "{{ $ccs }}" >{{ str_pad($row->herd_id,2,'0',STR_PAD_LEFT) }}
                                                  @if($row->gender == "Female")
                                                  <i class="fa fa-venus"></i>
                                                  @else
                                                  <i class="fa fa-mars"></i>
                                                  @endif
                                                </button>
                                              </div>
                                                <p class=""> {{ ucfirst($row->category) }} </p>
                                                    <?php
                                                        $res1 =  implode(' ', array_slice(explode(' ', ucfirst($row->location)), 0, 5));
                                                    ?>
                                                <p class="text-gray-500 text-sm font-semibold tracking-wide"> {{ $res1 }} </p>
                                            </td>
                                            <td class="px-2 py-4">
                                                <?php
                                                    $res2 =  implode(' ', array_slice(explode(' ', ucfirst($row->description)), 0, 5));
                                                ?>
                                              <p class=""> {{ $res2 }} </p>
                                            </td>
                                            <td class="px-2 py-4">
                                              <p class="text-gray-500 text-sm font-semibold tracking-wide"> Size: {{ $row->total_size }} </p>
                                              <p class=""> Count: {{ $row->total_count }} </p>
                                              <p class="text-gray-500 text-sm font-semibold tracking-wide"> Vacancy: {{ ($row->total_size-$row->total_count) }} </p>
                                            </td>
                                            <td class="px-2 py-4 text-center">
                                              @if($row->health_check != null)
                                                {{ date('d-m-Y', strtotime($row->health_check)) }}
                                              @else
                                                -
                                              @endif
                                            </td>
                                            <td class="px-2 py-4 text-sm text-gray-900">
                                                @hasanyrole('herdmanager|herdasstimmun') 
                                                    @if($row->category == "quarantine" || $row->category == "sick")
                                                        @if($row->total_count > 0 )
                                                        <button wire:click="showImmunizationForm({{$row->herd_id}})" class="bg-green-600 w-22 hover:bg-cyan-800 text-white font-normal py-2 px-4 mx-3  rounded">Immunization</button>
                                                        @else
                                                        <button wire:click="immFitnessFailed({{$row->herd_id}})" class="bg-red-600 w-22 hover:bg-orange-800 text-white font-normal py-2 px-4 mx-3  rounded">Immunization</button>
                                                        @endif
                                                    @endif
                                                    
                                                    @if($row->category == "normal")
                                                        @if($row->health_check != null)
                                                        <button wire:click="showImmunizationForm({{$row->herd_id}})" class="bg-green-600 w-22 hover:bg-cyan-800 text-white font-normal py-2 px-4 mx-3  rounded">Immunization</button>
                                                        @else
                                                        <button wire:click="immFitnessFailed({{$row->herd_id}})" class="bg-red-600 w-22 hover:bg-orange-800 text-white font-normal py-2 px-4 mx-3  rounded">Immunization</button>
                                                        @endif
                                                    @endif
                                                @endhasanyrole
                                                
                                                @hasanyrole('herdmanager|herdasstserum')
                                                    @if($row->category == "quarantine" || $row->category == "sick")
                                                        @if($row->total_count > 0 )
                                                            <button wire:click="serumInfoForm({{$row->herd_id}})" class="bg-green-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Serum</button>
                                                        @else
                                                            <button wire:click="scFitnessFailed({{$row->herd_id}})" class="bg-red-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Serum</button>
                                                        @endif
                                                    @endif
                                                    
                                                    @if($row->category == "normal")
                                                        @if($row->health_check != null )
                                                        <button wire:click="serumInfoForm({{$row->herd_id}})" class="bg-green-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Serum</button>
                                                        @else
                                                        <button wire:click="scFitnessFailed({{$row->herd_id}})" class="bg-red-600 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Serum</button>
                                                        @endif
                                                    @endif
                                                @endhasanyrole  
                                                
                                                @hasanyrole('herdmanager|herdvet')  
                                                <button wire:click="showHealthInfoEntryForm({{$row->herd_id}})" class="bg-green-700 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-5 my-2  rounded">Health</button>
                                                @endhasanyrole
                                            </td>
                                          </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    </div>
                                    
                                  @else
                                    <table class="w-full p-5 text-gray-700">
                                      <thead>
                                        <tr>
                                          <th class="text-left text-gray-900">No Data to Display</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="text-sm text-gray-900" align="left">
                                        </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  @endif
                                @endif
                            </div>
                          </div>
                        </div>
                        </br>
                        <!--Divider-->
                        @if($showNewHerdForm)
                            <div class="p-5">
                                @include('livewire.goats.newHerdForm')
                            </div>
                        @endif
                        <!-- insert table -->
                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
                <!--/table Card-->

                <!-- panel opening/closing -->
                @if($viewHerdInf)
                    @include('livewire.goats.herdInfo')
                @endif

                @if($viewSingleGoatInfo)
                    @include('livewire.goats.goatImmunInfo')
                @endif

                @if($viewEditHerdForm)
                    @include('livewire.goats.editHerdInfo')
                @endif

                @if($viewImmInf)
                    @include('livewire.goats.immunizationForm')
                @endif
                
                @if($viewImmHCFailDeatils)
                    @include('livewire.goats.immHealthCheckFailDetails')
                @endif

                @if($viewSerumForm)
                    @include('livewire.goats.serumForm')
                @endif
                
                @if($viewSerumHCFailDeatils)
                    @include('livewire.goats.serumHealthCheckFailDetails')
                @endif

                @if($viewHealthForm)
                    @include('livewire.goats.healthForm')
                @endif
                <!-- panel opening/closing -->
            </div>
            <!--/ Console Content-->
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</div>
