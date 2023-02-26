<?php

use Illuminate\Support\Facades\Route;


// Framework, nothing to edit or modify
use \Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
//-------------------------------------------------------//

// All roles
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
//-------------------------------------------------------//

//use App\Http\Controllers\ManageStrainsController;


// Facility - Manager
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\InfrastructureController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\FacilityHelpController;
//-------------------------------------------------------//

//Breeding routes
use App\Http\Controllers\BreedingHomeController;
use App\Http\Controllers\breeding\CVTermsController;
use App\Http\Controllers\breeding\ManageColonyController;
use App\Http\Controllers\breeding\SamplesController;
use App\Http\Controllers\breeding\ExperimentsController;
use App\Http\Controllers\breeding\SearchController;
//-------------------------------------------------------//

//livewire - Project Management

use App\Http\Livewire\ManageReports;
use App\Http\Livewire\ManageTasks;

use App\Http\Livewire\ManageProtocol;
use App\Http\Livewire\ManageProcedure;
use App\Http\Livewire\ShowUsers;
//-------------------------------------------------------//

//livewire - Elaboratory Book 
use App\Http\Livewire\Elabnotes\ElaBook;
use App\Http\Livewire\ManageSamples;
use App\Http\Livewire\ManageRepositories;

//livewire - Facility Management
use App\Http\Livewire\Occupancy;
use App\Http\Livewire\Reorganize;
use App\Http\Livewire\CompleteAllottment;
//-------------------------------------------------------//




//livewire - Herd management
use App\Http\Livewire\Goats\TermsBase;
use App\Http\Livewire\Goats\HerdColors;
use App\Http\Livewire\Goats\HerdFeeds;
use App\Http\Livewire\Goats\HerdDefaults;
use App\Http\Livewire\Goats\ManageGoats;
use App\Http\Livewire\Goats\ManageHerd;
use App\Http\Livewire\Goats\ManageImmunogens;
use App\Http\Livewire\Goats\ManageImmunizations;
use App\Http\Livewire\Goats\ManageSerumrecords;
use App\Http\Livewire\Goats\ManageTiters;
use App\Http\Livewire\Goats\ManageHealthrecords;
use App\Http\Livewire\Goats\HerdAdministration;

use App\Http\Livewire\Goats\BulkEntries;
use App\Http\Livewire\Goats\AnimalsAcquired;
use App\Http\Livewire\Goats\AnimalReceivers;
use App\Http\Livewire\Goats\AnimalSupplies;
use App\Http\Livewire\Goats\DailyRecords;
use App\Http\Livewire\Goats\HerdReports;
use App\Http\Livewire\Goats\SearchHerds;

use App\Http\Livewire\Goats\ManageAdjuvants;
use App\Http\Livewire\Goats\FeedSuppliers;
use App\Http\Livewire\Goats\ManageSops;
use App\Http\Livewire\Goats\ManageActivities;

use App\Http\Livewire\UploadGoatimages;

//-------------------------------------------------------//

//Livewiere - Search Engines
//-------------------------------------------------------//

//Superadmin - Controller of Admin_Application
use App\Http\Controllers\NewuserController;
use App\Http\Controllers\ExpiredAccountController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'web',
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
        
    require __DIR__.'/auth.php';

    Route::get('/home/passwordReset', [
      'middleware'  => ['auth', 'verified'],
      'uses' => 'App\Http\Controllers\HomeController@passwordReset'
    ])->name('home/passwordReset');

    Route::post('/home/pwupdate', [
      'middleware'  => ['auth', 'verified'],
      'uses' => 'App\Http\Controllers\HomeController@updatePassword'
    ])->name('home.pwupdate');

    Route::middleware(['auth','verified','isChecked'])->group(function() {
        
        //Auth::routes(['verify' => true]); // top line in routes.web
        //------ home routes with checks ------//
        Route::get('/home', [
            //'middleware'  => ['auth', 'verified'],
            'uses' => 'App\Http\Controllers\HomeController@index'
        ])->name('home');
        // -------------- //
        
        // -- Test Livewire component -- //
        
        // -------------- //
        
        // -- Livewire component -- //
        // -- PI group: Investigator, Researcher, Veternarian and Facility help -- //

        Route::get('manage-reports', ManageReports::class);
        Route::get('manage-tasks', ManageTasks::class);
        Route::resource('manage-group', GroupManagementController::class);
        // -------------- //
        
        // -- Investigator Exclusive -- //
        Route::view('/details','livewire.detailsHome')->name('view-details');
        
        //Route::view('/pigroup', 'livewire.phome.pigroupHome')->middleware('can:isPi')->name('view-pigroup');
        // -------------- //
        
        // -- PI group: Investigator, Researcher, Veternarian and Facility help -- //
        Route::get('manage-protocol', ManageProtocol::class);
        Route::get('manage-procedure', ManageProcedure::class);
        Route::get('manage-sops', ManageSops::class);
        // -------------- //
        
        //-- DELETE this line -- 
      
        // -------------- //
        
        // -- Download controller actions only -- //
        //Route::get('/managerdownload/{id}', [DownloadController::class, 'getSubProjFile'])->name('managerSubProject.download');
        //Route::get('/adminDownload/{id}', [DownloadController::class, 'getProjFile'])->name('adminProject.download');
        //Route::get('/tpdownload/{id}', [DownloadController::class, 'getPiTempProjFile'])->name('pitempproject.download');
        //Route::get('/download/{id}', [DownloadController::class, 'getPiProjFile'])->name('piproject.download');
        //Route::get('/report/{id}', [DownloadController::class, 'getMaintainReportFile'])->name('maintenance.report');
        // -------------- //
        
        // -------Veternarian role ------- //
        Route::resource('/vet', VetController::class);
        // -------------- //
        
        // -------Facility Help role------- //
        Route::resource('/faclithelp', FacilityHelpController::class);
        // -------------- //
        
        // -------Goat Farming role------- //
        Route::get('terms-base', TermsBase::class);
        Route::get('feed-suppliers', FeedSuppliers::class);
        Route::get('manage-adjuvants', ManageAdjuvants::class);
        Route::get('herd-colors', HerdColors::class);
        Route::get('herd-feeds', HerdFeeds::class);
        Route::get('herd-defaults', HerdDefaults::class);
        Route::get('manage-goats', ManageGoats::class);
        Route::get('manage-herd', ManageHerd::class);
        Route::get('manage-immunogens', ManageImmunogens::class);
        Route::get('manage-immunizations', ManageImmunizations::class);
        Route::get('manage-serumrecords', ManageSerumrecords::class);
        Route::get('manage-titers', ManageTiters::class);
        Route::get('manage-healthrecords', ManageHealthrecords::class);
        Route::get('manage-activities', ManageActivities::class);
        Route::get('herd-reports', HerdReports::class);
        Route::get('herd-administration', HerdAdministration::class);
        Route::get('animals-acquired', AnimalsAcquired::class);
    	Route::get('animal-receivers', AnimalReceivers::class);
    	Route::get('animal-supplies', AnimalSupplies::class);
    	Route::get('daily-records', DailyRecords::class);
    	Route::get('bulk-entries', BulkEntries::class);
    	Route::get('search-herds', SearchHerds::class);
    	Route::get('upload-goatimages', UploadGoatimages::class);
        // -------------- //
        
        // --------------------------------------------------------- //
        //    All Manager for projects, Facility and Breeding home   //
        // --------------------------------------------------------- //
        // Routes shown on P-Home Menu bar

        Route::get('/projectsmanager/{id}/submitted', [ProjectsManagerController::class, 'submitted'])->name('projectsmanager.submitted');
        Route::resource('/projectsmanager', ProjectsManagerController::class);
        Route::resource('/usageapproval', UsageApprovalController::class);

        Route::resource('/facility', FacilityController::class);

        Route::post('billing/setperdiem', [BillingController::class, 'setperdiem'])->name('billing.setperdiem');
        Route::get('billing/perdiem', [BillingController::class, 'perdiem'])->name('billing.perdiem');
        Route::resource('/billing', BillingController::class);
        Route::post('strain-manage/updatestatus', [StrainManageController::class, 'updatestatus'])->name('strains.updatestatus');
        Route::get('strain-manage/changestatus', [StrainManageController::class, 'changestatus'])->name('strains.changestatus');
        Route::resource('/strain-manage', StrainManageController::class);



        // Routes for Manager Facility
        Route::resource('/building', BuildingController::class);
        Route::resource('/floor', FloorController::class);
        Route::resource('/room', RoomController::class);
        Route::resource('/rack', RackController::class);
        Route::resource('/roomsnracks', RoomsnRacksController::class);
        Route::resource('/assignslots', AssignSlotsController::class);

        Route::post('/reshuffle/cageUpdate', [ReshuffleController::class, 'cageUpdate']);
        Route::get('/reshuffle/fetchCages', [ReshuffleController::class, 'fetchCages']);
        Route::get('/reshuffle/fetchRacks', [ReshuffleController::class, 'fetchRacks']);
        Route::resource('/reshuffle', ReshuffleController::class);

        Route::resource('/infrastructure', InfrastructureController::class);
        Route::resource('/maintenance', MaintenanceController::class);
        
        // -- Livewire Manager -- //
       
        // -------------- //
        
        // -------------- //
        
        // Routes shown on B-Home Menu bar
        
        // -------------- //
        
        
        // -------------- //
        
        
        
        
        
        // ---------------------------------------------------- //
        //    All Super Admin - Service provide routes          //
        // ---------------------------------------------------- //
        // Routes shown on Menu bar
        Route::resource('/users', UserController::class);
        Route::post('users_mass_destroy', ['uses' => '\App\Http\Controllers\UserController@massDestroy', 'as' => 'users.mass_destroy']);
        Route::resource('/massmail', MassMailerController::class);
        Route::resource('/createuser', NewuserController::class);
        Route::resource('/roles', RoleController::class);
        Route::post('roles_mass_destroy', ['uses' => '\App\Http\Controllers\RoleController@massDestroy', 'as' => 'roles.mass_destroy']);
        Route::resource('/permissions', PermissionController::class);
        Route::post('permissions_mass_destroy', ['uses' => '\App\Http\Controllers\PermissionController@massDestroy', 'as' => 'permissions.mass_destroy']);
        // -------------- //
        
    }); // end of auth and verified middle check for all routes

}); // end of complete tenancy implementation check for all routes
