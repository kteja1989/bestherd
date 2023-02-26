<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
    <div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Details of Goat Id: {{ $goat_id }}</h5>
        </div>
        <div class="p-5">
                <table class="w-full p-5 text-pink-700">
                    <thead>
                        <tr>
                            <th align="left">General</th>
                        </tr>
                    </thead>
                    <tbody> 
                    </tbody>    
                </table>
                <table class="w-full p-5 text-gray-700">
                    <thead>
                        <tr>
                          <th class="text-left text-gray-900">Gender </br> Age</th>
                          <th class="text-left text-gray-900">Genetic </br> Background</th>
                          <th class="text-left text-gray-900">Source </br> Ref</th>
                          <th class="text-left text-gray-900">Quarant </br> Start</th>
                          <th class="text-left text-gray-900">Quarant </br> End</th>
                          <th class="text-left text-gray-900">Inducted</br> On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-sm text-gray-900" align="left">
                                {{ $goatDetails->gender }}, </br> {{ $goatDetails->age }}  {{ $goatDetails->age_unit }}
                            </td>
                            <td class="text-sm text-gray-900" align="left">
                                {{ $goatDetails->genetic_background }}
                            </td>
                            <td class="text-sm text-gray-900" align="left">
                                {{ $goatDetails->source_reference }} </br> {{ $goatDetails->source_ref_file }}
                            </td>
                            <td class="text-sm text-gray-900" align="left">
                                {{ date('d-m-Y', strtotime($goatDetails->quarantine_start)) }}
                            </td>
                            <td class="text-sm text-gray-900" align="left">
                                {{ date('d-m-Y', strtotime($goatDetails->quarantine_end)) }} 
                            </td>
                            <td class="text-sm text-gray-900" align="left">
                                {{ date('d-m-Y', strtotime($goatDetails->inducted_date)) }} 
                            </td>
                        </tr>
                        <tr>
                            @if($goatDetails->remark != null)
                            <td colspan="4" class="text-sm text-red-800" align="left">
                                Note: {{ $goatDetails->remark }}
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <hr class="border-b-2 border-gray-600 my-2 mx-1">
                <table class="w-full p-5 text-pink-700">
                    <thead>
                        <tr>
                            <th align="left">Images</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- end of table -->
                @if(count($goatImgs) > 0)
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach($goatImgs as $row)
                                <td>
                                    <button wire:click="modalGoatImage({{ $row->mugshot_id }})" class="bg-blue-500  hover:bg-gray-800 text-white font-normal p-1 rounded">
                                        <img class="w-28 h-28  " src="{{ asset($row->path.$row->image) }}" alt="User Avatar">
                                    </button>
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                @else
                    <table class="w-full p-5 text-gray-700">
                        <thead>
                            <tr>
                                <th align="left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-sm text-gray-800" align="left">
                                    Images Not Found
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            <hr class="border-b-2 border-gray-600 my-2 mx-1">
            <div class="flex justify-center items-center p-3">
                <input class="w-full appearance-none border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="text" wire:model.defer="imagenotes" value="profile" placeholder = "Image Notes" name="flexRadioDefault" id="picturenotes">
                </br>
                <label class="error text-orange-900 text-sm font-normal pt-0 mb-0" for="usercode">
                    @error('imagenotes') <span class="error">{{ $message }}</span> @enderror
                </label>
            </div>
            
            <div class="flex justify-center items-center p-3">
                <div id="my_camera"></div>
            </div>
            
                <div class="flex justify-center items-center px-10 p-3">


                    <input type="button" class = "bg-blue-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-4 rounded" value="Front Cam" onClick="front_camera()">
                    <input type="button" class = "bg-blue-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-4 rounded" value="Back Cam" onClick="back_camera()">
                    <input type="button" class = "bg-blue-500 w-22 hover:bg-blue-800 text-white font-normal py-2 px-4 mx-4 rounded" value="Take Snapshot" onClick="take_snapshot()">
                    <input hidden type="text" class="image-tag" id="imageTag" wire:model="imageTag">
                <br/>
                </div>
                
                
          
            <div class="flex justify-center items-center p-3">
                
                <div id="results">
                    
                    Captured image will appear here...
                </div>
            </div>
            <div class="col-md-12 text-center">
                <br/>

            </div>
            
			<hr class="border-b-2 border-gray-600 my-2 mx-1">
			
			<div class="p-2">
			    <div class="flex justify-center items-center p-3">
			      <input class="bg-indigo-100 box-content rounded-lg font-bold shadow h-70 w-74 p-2  " type="button" value="Save Snapshot" onClick="saveSnap()">
				</div>
			</div>
			
			
			<hr class="border-b-2 border-gray-600 my-2 mx-1">
            <!--  -->
        </div>
	</div>
</div>
<!--/table Card-->



    <script>
        window.addEventListener('cam-sel', event => {
            Webcam.reset();
            var camera = event.detail.cameraMsg;
            switch (camera) {
                case "front":
                    Webcam.set({
                        width: 390,
                        height: 250,
                        image_format: 'jpeg',
                        jpeg_quality: 90,
                        constraints: {
                            facingMode: 'user'
                        }
                    });
                break;
                case "back":
                Webcam.set({
                    width: 390,
                    height: 250,
                    image_format: 'jpeg',
                    jpeg_quality: 90,
                    constraints: {
                       facingMode: 'environment'
                    }
                });
                break;
            }
            Webcam.attach( '#my_camera' );
        })
    </script>

    <script>
        window.addEventListener('alert', event => { 
             toastr[event.detail.type](event.detail.message, 
             event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
        });
    </script>
    