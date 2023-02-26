@extends('layouts.nGlobal')
@section('content')
    <!--Container-->
    <div class="container w-full mx-auto pt-20">
  	    <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
      		<!--Console Content-->
      		<div class="flex flex-wrap">
      		    
                    @include('herdmanager.flexwrapManager')
                
      	    </div>
      	    <!--End of Console content-->
    
          	<!--Divider-->
          	<hr class="border-b-2 border-gray-600 my-2 mx-4">
          	<!--Divider-->
      		<div class="flex flex-row flex-wrap flex-grow mt-2">
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.herdDataPieGraph')
                </div>
                
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.liveGoatInfo')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.goatAgeProfile')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.hemoglobin')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.weight')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.temperature')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.respRate')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.mucMemb')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.rumenContracts')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.rbc')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.platelets')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.pcv')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.lft')
                </div>
    
                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.kft')
                </div>

                <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('graphs.tempHumid')
                </div>
    
                <div class="w-full md:w-full sm:w-full p-3">
                     @include('herdmanager.herdmanCalendar')
                </div>
                
                <div class="w-full md:w-full sm:w-full p-3">
                    @include('herdmanager.herdmanAppointments')
                </div>
    
      		    <div class="w-full md:w-1/3 sm:w-full p-3">
                    @include('herdmanager.upcomingImmunizations')
                </div>
      	        <!--/ Console Content-->
      	    </div>
        </div>
    </div>
@include('grafScripts.graphScripts')
