<!--Table Card-->
<div class="w-full md:w-1/2 p-3">
	<div class="bg-orange-100 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <h5 class="font-bold uppercase text-gray-900">Titer Details - Herd Id: {{ $herd_id }}</h5>
        </div>
        <div class="p-5">
            <!-- insert table -->
            <!-- insert table -->
    	    <table class="w-full p-5 text-gray-700">
    	      <thead>
    	        <tr>
    	          <th class="content-center">Titer Values</th>
    	        </tr>
    	      </thead>
    	      <tbody>
    	        <tr>
    	          <td colspan="3"></td>
    	        </tr>
    	      </tbody>
    	    </table>
    	    <!-- end of table -->
    	    <hr class="border-b-2 border-gray-600 my-2 mx-1">
    	    <!-- List of samples found as table -->
    	    <table class="w-full p-5 text-gray-700">
                <thead>
                    <tr>
                        <th align="left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
        				<td></td>
                    </tr>
    	        </tbody>
    	    </table>
    	    <!--  -->
        	<hr class="border-b-2 border-gray-600 my-2 mx-1">
        	<div class="flex flex-row flex-wrap flex-grow mt-2">
                <div class="w-full md:w-full sm:w-full p-3">
                    @include('graphs.titers')
                </div>
            </div>
        </div>
	</div>

    @push('scripts')
    <script>
        //alert('loaded');
        //@this.emit('drawTiterGraph');
    </script>
    <script type="text/javascript">
        window.addEventListener('drawTiterGraph', e => {
            document.addEventListener('livewire:update', function () {

                var assetsx = JSON.parse(e.detail.assets);
                var goatId = 312;
                // for(var key in assetsx){
                //   var hbscatx = assetsx['titerscat'];
                // };
                //var hbscat = ["256", "512", "256"];
                //alert("inside this " + hbscat);
                ////////////// Hemoglobin Plot /////////////////////
                var ctx = document.getElementById("canvas34").getContext("2d");
                new Chart(ctx, {
                    type: "scatter",
                    data: {
                      datasets: [{
                        label: 'Titer',
                        pointRadius: 4,
                        backgroundColor: "rgba(255,0,0,0.5)",
                        pointBackgroundColor: "rgba(255,0,0,0.5)",
                        barThickness: 10,
                        maxBarThickness:18,
                        data: assetsx,
                        }]
                        
                        },
                        options: {
                            elements: {
                                rectangle: {
                                  borderWidth: 1,
                                  borderColor: '#c1c1c1',
                                  borderSkipped: 'bottom'
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: true,
                            title: {
                                display: true,
                                text: 'Goat ID: ' + goatId
                            },
                            scales: {
                                xAxes: [{
                                  ticks:{
                                    min:0,
                                    max:12
                                  }
                                  //barThickness: 10,  // number (pixels) or 'flex'
                                  //maxBarThickness: 18 // number (pixels)
                                }],
                                yAxes: [{
                                  ticks: {
                                    min: 0,
                                    max: 1000,
                                    maxTicksLimit: 10,
                                  }
                                }]
                            }
                        }
                });
                ////////////////
            });
        });
    </script>
 
    @endpush
    @stack('scripts')
</div>
<!--/table Card-->
