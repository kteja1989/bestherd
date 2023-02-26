@extends('layouts.nGlobal')
@section('content')
  <!--Container-->
  <div class="container w-full mx-auto pt-20">
  	<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
  		<!--Console Content-->
  		<div class="flex flex-wrap">
          <!--Metric Card 1 -->
          <div class="w-full md:w-1/2 xl:w-1/3 p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded p-3 bg-green-600">
                    <a href="/manage-herd" >
                      <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                    </a>
                  </div>
                </div>
                <div class="flex-1 text-left md:text-center">
                  <h4 class="font-bold uppercase text-gray-900">Herds</h5>
                </div>
              </div>
            </div>
          </div>
          <!--/End Metric Card 1-->
      		<!--Metric Card-->
      		<div class="w-full md:w-1/2 xl:w-1/3 p-3">
      			<div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
      				<div class="flex flex-row items-center">
      					<div class="flex-shrink pr-4">
      						<div class="rounded p-3 bg-blue-600">
      							<a href="manage-serumrecords" >
      								<i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
      							</a>
      						</div>
      					</div>
      					<div class="flex-1 text-right md:text-center">
      						<h5 class="font-bold uppercase text-gray-900">Serum</h5>
      						<h3 class="font-normal text-left text-1xl text-gray-600">Incomplete: {{ $seraIncomp }} Completed: {{ $seraComp }}</h3>
      					</div>
      				</div>
      			</div>
      		</div>
      		<!--/Metric Card-->

          <!--Metric Card 2 -->
          <div class="w-full md:w-1/2 xl:w-1/3 p-3">
            <div class="bg-orange-100 border border-gray-800 rounded shadow p-2">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded p-3 bg-orange-600">
                    <a href="search-herds" >
                      <i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                    </a>
                  </div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h5 class="font-bold uppercase text-gray-900">Searches</h5>
                  <h5 class="font-normal text-left text-sm text-gray-800"></h5>
                </div>
              </div>
            </div>
          </div>
          <!--/End Metric Card 2-->
  	    </div>
  	    <!--End of Console content-->

    	<!--Divider-->
    	<hr class="border-b-2 border-gray-600 my-2 mx-4">
    	<!--Divider-->
  		<div class="flex flex-row flex-wrap flex-grow mt-2">
  			<!-- Left Panel Graph Card-->
  			<!-- / End of Left Panel Graph Card-->
      		<!-- Right Panel Graph Card-->

            <div class="w-full md:w-full sm:w-full p-3">
              <div class="bg-orange-100 border border-gray-800 rounded shadow">
                <div class="border-b border-gray-800 p-3">
                  <h5 class="font-bold uppercase text-gray-600">Events Dashboard: Logged IN {{ date('d-m-Y H:i:s')}}</h5>
                </div>
                <div class="p-5">
                  <div class='overflow-x-auto w-full'>
                  <table class="w-full md:full mx-3 text-gray-700">
                    <thead>
                      <tr>
                        <th class="text-center text-gray-900">Events Calender: {{ date('d-m-Y H:i:s')}}</th>
                      </tr>
                    </thead>
                      <tbody>
                        <tr>
                          <td class="text-sm text-gray-900" align="left">
                            <div id="cht1">
                              <livewire:herd-calendar
                                before-calendar-view="livewire.calendar.header"
                              />
                            </div>
                            </br></br></br></br>
                          </td>
                        </tr>
                      </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>

            <div class="w-full md:w-full sm:w-full p-3">
              <div class="bg-orange-100 border border-gray-800 rounded shadow">
                <div class="border-b border-gray-800 p-3">
                  <h5 class="font-bold uppercase text-gray-600">Appointments: Logged IN {{ date('d-m-Y')}}</h5>
                </div>
                <div class="p-5">
                  <div class='overflow-x-auto w-full'>
                  <table class="w-full md:full mx-3 text-gray-700">
                    <thead>
                      <tr>
                        <th class="text-center text-gray-900">Calender: Appointments {{ date('d-m-Y')}}</th>
                      </tr>
                    </thead>
                      <tbody>
                        <tr>
                          <td class="text-sm text-gray-900" align="left">
                            <div id="cht1">
                              <livewire:appointments-grid
                                starting-hour="10"
                                ending-hour="17"
                                interval="15"
                              />
                            </div>
                            </br></br></br></br>
                          </td>
                        </tr>
                      </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>

  	        <!--/ Console Content-->
  	    </div>
      </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
  window.onload = function() {
    ////////////////
    ////////////////
  };
</script>
