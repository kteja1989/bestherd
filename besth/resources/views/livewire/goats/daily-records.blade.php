<div>
    {{-- Stop trying to control. --}}
    {{-- The whole world belongs to you. --}}
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
        <div class="w-full md:w-full px-3 p-3">
          <div class="bg-orange-100 border border-gray-800 rounded shadow">
            <div class="border-b border-gray-800 p-3">
              <h5 class="font-bold uppercase text-gray-900">Daily Records</h5>
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
              <div class="min-h-screen bg-green-100 py-5">
                <div class='overflow-hidden w-full'>
                  @if(count($drecords) > 0)
                    <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                      <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                          <th class="font-semibold text-sm uppercase px-4 py-4"> Date </br> Herd</th>
                          <th class="font-semibold text-sm uppercase px-4 py-4"> SOP</th>
                          <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Temperature </br> Humidity </th>
                          <th class="font-semibold text-sm uppercase px-4 py-4 text-center"> Dry Cleaned </br> Water Cleaned </th>
                          <th class="font-semibold text-sm uppercase px-4 py-4"> Special </br> Remarks </th>
                          <th class="font-semibold text-sm uppercase px-4 py-4"> Carried By </br> Supervised By </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                        @foreach($drecords as $row)
                          <tr>
                            <td class="px-4 py-4">
                              <div class="flex items-center space-x-3">
                                <div>
                                    <p> {{ date('d-m-Y', strtotime($row->entry_date)) }} </p>
                                    <p class="text-gray-500 text-sm font-semibold tracking-wide"> Herd: {{ $row->herd_id }} </p>
                                </div>
                              </div>
                            </td>
                            <td class="px-4 py-4">
                              <div class="flex items-center space-x-3">
                                <div>
                                    <p> {{ substr($row->sops->title, 0, 25) }} </p>
                                    <p class="text-gray-500 text-sm font-semibold tracking-wide">{{ substr($row->sops->description, 0, 25) }} </p>
                                </div>
                              </div>
                            </td>
                            <td class="px-4 py-4">
                              <p class=""> Temp: {{ $row->temperature }} </p>
                              <p class="text-gray-500 text-sm font-semibold tracking-wide"> Humidity:  {{ $row->humidity }} </p>
                            </td>
                            <td class="px-4 py-4"> Dry: {{ ucfirst($row->dry_cleaned) }} </br> Water: {{ ucfirst($row->water_cleaned) }}  </td>
                            <td class="px-4 py-4"> Special: {{ ucfirst($row->special) }} </br> Remarks: {{ ucfirst($row->remarks) }} </td>
                            <td class="px-4 py-4"> Done By: {{ ucfirst($row->carried_by) }} </br> Supervised By: {{ ucfirst($row->supervised_by) }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  @else
                    <table class="w-full p-5 text-gray-700">
                      <thead>
                        <tr>
                          <th class="text-left text-gray-900">None to diplay!</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-sm text-gray-900"></td>
                        </tr>
                      </tbody>
                    </table>
                  @endif
                  <!--Divider-->
                  <div class="flex flex-row flex-wrap flex-grow mt-2">
                    <!-- Right Panel  Card-->
                    <div class="w-full md:w-1/2 p-3">
                      <div class="bg-orange-100 border border-gray-800 rounded shadow">
                        <div class="border-b border-gray-800 p-3">
                          <h5 class="font-bold uppercase text-gray-900">Enter New Record</h5>
                        </div>
                        <div class="p-5">
                          <table class='table-auto  mx-auto w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                            <thead class="bg-gray-900">
                                <tr class="text-white text-left">
                                  <th colspan="3" class="font-semibold text-sm uppercase px-6 py-4"> Daily Record Date: {{ date('d-m-Y') }}  </th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="px-6 py-2">
                                    <label class="block text-gray-900 text-lg font-normal mb-2" for="username">
                                        Herd Id
                                    </label>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="title" wire:model.defer="herd_id" type="text">
                                    </br>
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('herd_id') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                                <td colspan="2" class="px-6 py-2">
                                    <label class="block text-gray-900 text-lg font-normal mb-2" for="username">  Supervised By </label>
                                    <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="super" wire:model.defer="supervised_by" type="text">
                                    </br>
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                        @error('supervised_by') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="px-6 py-2">
                                  <label class="block text-gray-900 text-lg font-normal mb-2" for="username"> Temperature </label>
                                  <input class="shadow appearance-none border border-red-500 w-full rounded  py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="description" wire:model.defer="tempx" type="text">
                                  </br>
                                  <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('tempx') <span class="error">{{ $message }}</span> @enderror
                                  </label>
                                </td>
                                <td class="px-6 py-2">
                                  <input class="form-check-input appearance-none h-4 w-4 border border-gray-800 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-6 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model.defer="dry_cleaned" type="checkbox" value="yes" id="flexCheckDefault">
                                  <label class="form-check-label inline-block text-gray-800 mt-5 font-normal" for="flexCheckDefault">
                                    Dry Cleaned
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="px-6 py-2">
                                  <label class="block text-gray-900 text-lg font-normal mb-2" for="username">  Humidity </label>
                                  <input class="shadow appearance-none border border-red-500 w-full rounded  py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="versionId" wire:model.defer="humidx" type="text">
                                  </br>
                                  <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('humidx') <span class="error">{{ $message }}</span> @enderror
                                  </label>
                                </td>
                                <td class="px-6 py-2">
                                  <input class="form-check-input appearance-none h-4 w-4 border border-gray-800 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-6 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:model.defer="water_cleaned" type="checkbox" value="yes" id="flexCheckDefault">
                                  <label class="form-check-label inline-block text-gray-800 mt-5 font-normal" for="flexCheckDefault">
                                    Water Cleaned
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                  <td class="px-6 py-2" colspan="2">
                                    <label class="block text-gray-900 text-sm font-bold font-normal pt-2 mb-2" for="usercode">SOP*</label>
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
                                            	focus:text-gray-900 focus:bg-white border border-red-500 rounded focus:border-blue-600 focus:outline-none" wire:model.defer="sop_idx" aria-label="Default select example">
                                                <option value="sel" selected>Select SOP</option>
                                                    @foreach($sops as $row)
                                                    	<option value="{{ $row->sop_id }}">{{ $row->title }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                    @error('sop_idx') <span class="error">{{ $message }}</span> @enderror
                                    </label>
                                </td>
                            </tr>
                              <tr>
                                <td colspan="2" class="px-6 py-2">
                                  <label class="block text-gray-900 text-lg font-normal mb-2" for="username">  Special </label>
                                  <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model.defer="special_cleaned" type="text">
                                  </br>
                                  <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('special_cleaned') <span class="error">{{ $message }}</span> @enderror
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" class="px-6 py-2">
                                  <label class="block text-gray-900 text-lg font-normal mb-2" for="username">  Remarks </label>
                                  <input class="shadow appearance-none border border-red-500 rounded w-full py-1 text-gray-700 mb-1 leading-tight focus:outline-none focus:shadow-outline" id="approvedBy" wire:model.defer="remarks" type="text">
                                  </br>
                                  <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                                      @error('remarks') <span class="error">{{ $message }}</span> @enderror
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="px-6 py-2">
                                  <label class="block text-gray-900 text-sm font-normal mb-2" for="username">
                                    @hasanyrole('herdmanager')
                                      <button wire:click="addNewDR()" class="bg-blue-500 w-20 hover:bg-blue-800 text-white font-normal py-2 px-2  mx-3 rounded">Add New</button>
                                    @endhasanyrole
                                  </label>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- Right Panel Graph Card-->

                    <!-- left Panel Graph Card-->
                    <div class="w-full md:w-1/2 p-3">
                      <div class="bg-orange-100 border border-gray-800 rounded shadow">
                        <div class="border-b border-gray-800 p-3">
                          <h5 class="font-bold uppercase text-gray-900">Temperature and Humidity</h5>
                        </div>
                        <div class="p-5">
                          <div align="center" class="container w-full mx-auto">
                            <div class="bg-indigo-100 box-content rounded-lg font-bold shadow p-4  ">
                              <canvas id="TandH" height="350" width="450"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- / End of Left Panel Graph Card-->
                  </div>
                  <!-- include the graph -->
                  <!-- end of temp humdity graph -->
                  <!--Divider-->
                  </br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/table Card-->
      </div>
      <!--/ Console Content-->
      <!--end of the block-->
    </div>
  </div>
    ////////////////////
    <script>
        window.addEventListener('load', ()=>{
            Livewire.emit('emitDrawTHGraphs');
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        window.addEventListener('drawTHGraphs', e => {
            document.addEventListener('livewire:update', function () {
            
                var x1 = e.detail.xth;
                var t1 = e.detail.temp;
                var h1 = e.detail.humid;
                
                var xth = JSON.parse(x1);
                var temp = JSON.parse(t1);
                var humid = JSON.parse(h1);
            
                var xaxis = xth;
                var TandH = document.getElementById("TandH").getContext("2d");
            
                Chart.defaults.global.defaultFontFamily = "Lato";
                Chart.defaults.global.defaultFontSize = 18;
                Chart.Legend.prototype.afterFit = function() {
                  this.height = this.height + 20;
                };
                var dataTandH = [{
                    label: "Temp [C]",
                    data: temp,
                    lineTension: 0,
                    fill: false,
                    borderColor: 'red'
                  },
                  {
                    label: "Humidity [%]",
                    data: humid,
                    lineTension: 0,
                    fill: false,
                    borderColor: 'blue'
                  }];
            
                var thData = {
                  labels: xaxis,
                  datasets: dataTandH
                };
            
                var chartOptions = {
                  legend: {
                    display: true,
                    position: 'top',
                    labels: {
                      boxWidth: 80,
                      fontColor: 'black'
                    }
                  },
                  responsive: false
            
                };
            
                var lineChart = new Chart(TandH, {
                  type: 'line',
                  data: thData,
                  options: chartOptions
                });
                ////////////////
            });
        });
    </script>
</div>

