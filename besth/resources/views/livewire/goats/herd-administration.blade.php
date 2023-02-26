<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
        {{-- Stop trying to control. --}}
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{-- Do your work, then step back. --}}
    <!--End of Console content-->

    @hasanyrole('manager|herdmanager')
        @include('livewire.goats.flexwrapAdministration')
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
                            <h5 class="font-bold uppercase text-gray-900">Herd Adminstration: Dashboard</h5>
                        </div>
                        <div class="errors">
                            @if (session()->has('formmessage'))
                                <div class="alert alert-success">
                                {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        
                        <!--
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                                      <th class="text-left text-gray-900">
                                        <button wire:click="viewNewHerdForm()" class="bg-green-800 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-3  rounded">Add New</button>
                                      </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        -->
                        
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                                      <th class="text-left text-gray-900">Herd Administration Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm text-gray-900" align="left">
                                           
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!--Divider-->
                        <hr class="border-b-2 border-gray-600 my-2 mx-4">
                        <!--Divider-->

                        <!-- insert table --> 

                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
                <!--/table Card-->
          
                <!-- panel opening/closing -->

                <!-- panel opening/closing -->
            </div>
            <!--/ Console Content-->
        </div>
    </div>
</div>
