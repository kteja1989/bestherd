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
                        <!-- insert table -->
                        <!-- insert table -->
                        </br></br>
                    </div>
                </div>
                <!--/table Card-->

                <!-- panel opening/closing -->
                @if($viewHerdInf)
                    @include('livewire.goats.herdInfoImage')
                @endif

                @if($viewSingleGoatInfo)
                    @include('livewire.goats.goatImageCapture')
                @endif
            </div>
            <!--/ Console Content-->
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script language="JavaScript">
    
        function front_camera() {
            Livewire.emit('frontCamera', '', true);
        }
        
        function back_camera() {
            Livewire.emit('backCamera', '', true);
        }
        
        function take_snapshot() {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img id="imgTag" src="' + data_uri + '" width="270px" height="250px" />';
            } );
            //var message = "Snapshot Successful"; // works but dont use
            //Livewire.emit('snapShotSuccess', message, true); // works but dont use
            //Webcam.reset(); important line to keep camera off
        }
        
        function saveSnap(){
           // Get base64 value from <img id='imageprev'> source
           var base64image = document.getElementById("imgTag").src;
           Livewire.emit('processImage', base64image, true);
           /*
           Webcam.upload( base64image, 'upload.php', function(code, text) {
                console.log('Save successfully');
               //console.log(text);
           });
            */
        }
        
    </script>

</div>
