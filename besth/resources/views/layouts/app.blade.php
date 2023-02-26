<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Meissa - BEST</title>
        <meta name="author" content="name">
        <meta name="description" content="description here">
        <meta name="keywords" content="keywords,here">

        <title>{{ config('app.name', 'Meissa-BEST') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="{{ asset('lcss/all.css') }}" rel="stylesheet" crossorigin="anonymous">

        <!-- Styles xxxx -->
        <link rel="stylesheet" href="../css/app.css">
        <link href="{{ asset('lcss/tailwind.min.css')}}" rel="stylesheet" >
        <style>
    				.bg-black-alt  {
    				background:#edf2f7;
    			}
    				.text-black-alt  {
    				color:#1a202c;
    			}
    				.border-black-alt {
    				border-color: #edf2f7;
    			}
    		</style>
        <!-- Scripts -->
        <script src="../js/app.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @hasanyrole('pisg|pilg|piblg|pient')
            	@include('layouts.nNavbarInvestigator')
            @endhasrole
            
            @hasrole('investigator')
                @include('layouts.nNavbarInvestigator')
            @endhasrole
            
            @hasrole('researcher')
                @include('layouts.nNavbarResearcher')
            @endhasrole
            
            @hasrole('veterinarian')
                @include('layouts.nNavbarVet')
            @endhasrole
            
            @hasrole('facility_help')
                @include('layouts.nNavbarFacilitHelp')
            @endhasrole
            
            @hasrole('manager')
                @include('layouts.nNavbarManager')
            @endhasrole
            
            @hasrole('herdmanager')
                @include('layouts.nNavbarHerdManager')
            @endhasrole
            
            @hasrole('herdasstimmun')
				@include('layouts.nNavbarImmAssistant')
			@endhasrole
			
			@hasrole('herdserum')
				@include('layouts.nNavbarSerumAssistant')
			@endhasrole

			@hasrole('herdvet')
				@include('layouts.nNavbarHerdVeternarians')
			@endhasrole			
            
            @hasrole('admin')
                @include('layouts.nNavbarAdmin')
            @endhasrole

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-13 px-4 sm:px-6 lg:px-8">

                </div>
            </header>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!--begin footer-->
      			@include('layouts.nFooter')
      		<!--end of footer-->
        </div>
    </body>
    <!--scripts-->

    @livewireScripts
    @livewire('livewire-ui-modal')
    @livewireResourceTimeGridScripts
    @include('layouts.nScripts')
</html>
