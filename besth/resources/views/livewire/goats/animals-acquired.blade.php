<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    {{-- The whole world belongs to you. --}}
    
    @hasanyrole('manager|herdmanager')
        @include('livewire.goats.flexwrapAdministration')
    @endhasanyrole
    
    <div class="container w-full mx-auto pt-2">
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
                          <h5 class="font-bold uppercase text-gray-900">Herd Adminstration: Acquisitions</h5>
                        </div>
                        <div class="errors">
                          @if (session()->has('formmessage'))
                            <div class="alert alert-success">
                              {{ session('message') }}
                            </div>
                          @endif
                          @if (!empty($lwMessage))
                            <div class="alert alert-success">
                              {{ $lwMessage }}
                            </div>
                          @endif
                        </div>
                        <div class="p-5">
                            <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                                <thead class="bg-gray-900">
                                  <tr class="text-white text-left">
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Date</th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Species </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Sex </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Age </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Supplier </th>
                                    <th class="font-semibold text-sm uppercase px-4 py-4"> Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($animacquried) > 0 )
                                        @foreach($animacquried as $row)
                                            <tr>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ date('d-m-Y', strtotime($row->date_acquired)) }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ ucfirst($row->species_id) }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ ucfirst($row->sex) }} 
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ ucfirst($row->age) }} {{ ucfirst($row->age_unit) }} 
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ ucfirst($row->supplier_code) }}
                                                </td>
                                                <td class="px-4 py-4 text-sm text-gray-900">
                                                {{ $row->total_acquired }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-sm text-gray-900">
                                                None to diplay!
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <!--Divider-->
                            </br>
                            <hr class="border-b-2 border-gray-600 my-2 mx-4">
                            <!--Divider-->
                            </br>
                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                            Department
                            </label>
                                <div class="flex justify-left">
                                  <div class="mb-3 xl:w-96">
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
                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="dept" aria-label="Default select example">
                                        <option selected>Select Department</option>
                                        @foreach($depts as $row)
                                            <option value="{{ $row->department_id }}">{{ $row->description }}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                            
                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username"> Species </label>
                            <div class="flex justify-left">
                              <div class="mb-3 xl:w-96">
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
                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="species_acq" aria-label="Default select example">
                                    <option selected>Select Species</option>
                                    @foreach($species as $row)
                                        <option value="{{ $row->species_id }}">{{ $row->species_name }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>

                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">  Sex </label>
                            <div class="flex justify-left">
                              <div class="mb-3 xl:w-96">
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
                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="sex" aria-label="Default select example">
                                    <option selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                              </div>
                            </div>

                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                            Total Acquired
                            </label>
                            <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model="totalAcquired" type="text">


                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">  Date of Birth </label>
                            <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model="dob" type="date">
                            
                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">  Date Acquired </label>
                            <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedDate" wire:model="acquiredDate" type="date">
                            
                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">  Supplier </label>
                            <input size="55" class="shadow appearance-none border border-red-500 rounded w-auto py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedRef" wire:model="supplierRef" type="text">
                            
                            </br></br>
                            <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                                @hasanyrole('manager|herdmanager')
                                  <button wire:click="saveAnimalAcquisitionForm()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
                                @endhasanyrole
                            </label>
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
</div>
