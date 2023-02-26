<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use App\Models\Tempproject;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

//Models for herds
use App\Models\Herd;
use App\Models\Goat;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Serum;
use App\Models\Goatsera;
use App\Models\Health;
use App\Models\Goathealth;

use App\Traits\Base;
use App\Traits\DashAdminTrait;
//use App\Traits\DashPiTrait;
use App\Traits\HerdDashboardTrait;
use App\Traits\HerdTaskAlertTrait;
use App\Traits\DashTempHumidityGraphTrait;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HomeController extends Controller
{
    //
	use Base;
	use HasRoles;
	use DashAdminTrait;
	// DashPiTrait
    use HerdDashboardTrait;
    use HerdTaskAlertTrait;
    use DashTempHumidityGraphTrait;

	public function __construct()
    {
      //$this->middleware(['role:admin|manager|investigator|researcher']);
    }

    public function index()
    {
        $timetag = date("Y-m-d H:i:s");
		//check for expired/suspended account
		$exp = strtotime(Auth::user()->expiry_date);
		$tod = strtotime(date('Y-m-d'));
		if( $exp < $tod)
		{
		    $msg = "Your Account Expired on ".date('d-m-Y', strtotime(Auth::user()->expiry_date))." Contact Service Provider";
 			//return  view('norole.noroleHome');
 			Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] account expired');
 			return  view('errors.dashboard')->with('msg', $msg);
 			 
		}

		// all is well from here on

		$user = Auth::user();
	  	$roles = $user->getRoleNames();
	  	$groupTasks = Task::with('user')
                    	  	->where('category', 'group')
                    	  	->get();
	  	$personalTasks = Task::with('user')
                        	  	->where('self_id', Auth::id())
                        	  	->where('status', 'Active')->where('category', 'personal')
                        	  	->get();



  		if( Auth::user()->hasRole('veterinarian') )
  		{
  		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
  			return view('veterinarian.vetHome')->with([
  									'personalTasks'=>$personalTasks,
  									'groupTasks'=> $groupTasks
  									]);
  		}

  		if( Auth::user()->hasRole('facility_help') )
  		{
  		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
  			return view('facilithelp.facithelpHome')
  							->with(['personalTasks'=>$personalTasks,
  											'groupTasks'=> $groupTasks ]);
  		}

  		if( Auth::user()->hasRole('asstlab') )
  		{
  		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');

  		}

  		if( Auth::user()->hasRole('asstfacility') )
  		{
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
  		}

		//herd management
		if( Auth::user()->hasRole('herdmanager') )
		{
		    $hcount = $this->herdInfoCount();
		   // dd($hcount);
			$hrdCount = $hcount[0];
			$hif = $hcount['hif'];
		    $goatsAlive = $this->liveGoatCount();
		    $goatsDead = $this->deadGoatCount();
		    $goatsRetired = $this->retiredGoatCount();
		    $goatsSick = $this->sickGoatCount();
		    $retVal = $this->agedGoatCount();
		    $activeImms = $this->activeImmunizations();
			$incompImms = $this->incompleteImmunizations();
			$immAlerts = $this->upcomingImmunizations();
			$seraIncomp = $this->serumIncomplete();
			$seraComp = $this->serumComplete();
			$colors = $this->allColors();
			$sops = $this->allSOPs();
			$feeds = $this->allFeeds();
			$adjuvants = $this->allAdjuvants();
			$quaran = $this->inQuarantine();
			
			$tandh = $this->processTempHumidGraphData();

			$hstat = ['Capacity', 'Occupancy', 'Vacant'];
			$hstinf = [$hif['total_size'], $hif['total_count'], $hif['toal_vacancy']];
			
			/*
			$hstinf1 = $hcount[1];
			$hstinf2 = $hcount[2];
			$hstinf3 = $hcount[3];
			$hstinf4 = $hcount[4];
			$hstinf5 = $hcount[5];
			$hstinf6 = $hcount[6];
			$hstinf7 = $hcount[7];
			$hstinf8 = $hcount[8];
			$hstinf9 = $hcount[9];
			*/
			
			//dd($hstinf1,$hstinf2,$hstinf3,$hstinf4,$hstinf5,$hstinf6,$hstinf7);
			//
	        
			$agedGoatCount = $retVal['agc'];
			$graphVals = $retVal['grp'];
			
			foreach($graphVals as $row)
			{
			        $ageBand[] = $row['age_band'];
			        $ag[] = $row['count'];
			}

            if(empty($ageBand))
            {
                $ageBand = ['0-1','1-2','2-3','3-4','4-5','5-6','6-7','7-8'];
	            $ag[] = null;
            }
            
			$goatStatus = ['Alive', 'Sick', 'Ret', 'Dead'];
			$goatsStatData = [$goatsAlive, $goatsSick, $goatsRetired, $goatsDead];
			
			//get goat health parameters
			//$hb = $this->getHbParam();
			//$hbx = json_encode($hb[0], JSON_NUMERIC_CHECK);
			//$hb = json_encode($hb[1], JSON_NUMERIC_CHECK);
			//dd($hstinf7,	$hbx, $hb);
			//$wt = $this->getWeightParam();
			//$rbc = $this->getRBCParam();
			
			$xcd = $this->getGoathealthParams();
			//dd($xcd);
			$hbscat = $xcd['hbscat'];
			$wtscat = $xcd['wtscat'];
			$tpscat = $xcd['tpscat'];
			$rrscat = $xcd['rrscat'];
			$mmscat = $xcd['mmscat'];
			$rcscat = $xcd['rcscat'];
			
			$rbcscat = $xcd['rbcscat'];
			$pltscat = $xcd['pltscat'];
			$pcvscat = $xcd['pcvscat'];
			$lftscat = $xcd['lftscat'];
			$kftscat = $xcd['kftscat'];
			$rtpcrscat = $xcd['rtpcrscat'];
			
			$totInfraItems = $this->totalInfraItems();
			

		        $homePageAndPath = 'herdmanager.herdManagerHome';
		    

			
			Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view($homePageAndPath)
			                ->with(['herdCount'=>$hrdCount,
									'htotal_size'=>$hif['total_size'],
									'htotal_count'=>$hif['total_count'],
			                        'goatsAlive'=>$goatsAlive,
			                        'goatsDead'=>$goatsDead,
			                        'goatsRet'=>$goatsRetired,
			                        'goatsSick'=>$goatsSick,
			                        'activeImms'=>$activeImms,
									'incompImms'=> $incompImms,
			                        'agedGoatCount' => $agedGoatCount,
									'immAlerts' => $immAlerts,
									'seraIncomp' => $seraIncomp,
									'seraComp' => $seraComp,
									'colors' => $colors,
									'sops' => $sops,
									'feeds' => $feeds,
									'adjuvants' => $adjuvants,
									'quaran' => $quaran,
									'ageBand' => $ageBand,
									'goatNum' =>$ag,
									'totInfraItems'=> $totInfraItems,
									'tandh' => $tandh,
									'date_observed'=> $xcd['date_observed'],
									'mhb' => $xcd['mhb'],
									'mwt' => $xcd['mwt'],
									'mtp' => $xcd['mtp'],
									'mrr' => $xcd['mrr'],
									'mmm' => $xcd['mmm'],
									'mrc' => $xcd['mrc'],
									'mrbc'=> $xcd['mrbc'],
									'mplt'=> $xcd['mplt'],
									'mpcv'=> $xcd['mpcv'],
									'mlft'=> $xcd['mlft'],
                                    'mkft'=> $xcd['mkft'],
                                    'mrtpcr'=> $xcd['mrtpcr']
									])
									->with('ageBand', json_encode($ageBand,JSON_NUMERIC_CHECK))
									->with('goatNum', json_encode($ag,JSON_NUMERIC_CHECK))
									->with('goatStatus', json_encode($goatStatus, JSON_NUMERIC_CHECK))
									->with('goatsStatData', json_encode($goatsStatData,JSON_NUMERIC_CHECK))
									->with('hstat', json_encode($hstat,JSON_NUMERIC_CHECK))
									->with('hstinf', json_encode($hstinf,JSON_NUMERIC_CHECK))
									/*
									->with('hstinf1', json_encode($hstinf1,JSON_NUMERIC_CHECK))
									->with('hstinf2', json_encode($hstinf2,JSON_NUMERIC_CHECK))
									->with('hstinf3', json_encode($hstinf3,JSON_NUMERIC_CHECK))
									->with('hstinf4', json_encode($hstinf4,JSON_NUMERIC_CHECK))
									->with('hstinf5', json_encode($hstinf5,JSON_NUMERIC_CHECK))
									->with('hstinf6', json_encode($hstinf6,JSON_NUMERIC_CHECK))
									->with('hstinf7', json_encode($hstinf7,JSON_NUMERIC_CHECK))
									->with('hstinf8', json_encode($hstinf8,JSON_NUMERIC_CHECK))
									->with('hstinf9', json_encode($hstinf9,JSON_NUMERIC_CHECK))
									*/
									->with('xaxis', json_encode($xcd['xaxis'],JSON_NUMERIC_CHECK))
                                    ->with('hbscat', json_encode($xcd['hbscat']))
                                    ->with('wtscat', json_encode($xcd['wtscat']))
                                    ->with('tpscat', json_encode($xcd['tpscat']))
                                    ->with('rrscat', json_encode($xcd['rrscat']))
                                    ->with('mmscat', json_encode($xcd['mmscat']))
                                    ->with('rcscat', json_encode($xcd['rcscat']))
                                    ->with('rbcscat', json_encode($xcd['rbcscat']))
                                    ->with('pltscat', json_encode($xcd['pltscat']))
                                    ->with('pcvscat', json_encode($xcd['pcvscat']))
                                    ->with('lftscat', json_encode($xcd['lftscat']))
                                    ->with('kftscat', json_encode($xcd['kftscat']))
                                    ->with('rtpcrscat', json_encode($xcd['rtpcrscat']));
            //Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');

		}

        if( Auth::user()->hasRole('herdasstimmun') )
		{
			$activeImms = $this->activeImmunizations();
			$incompImms = $this->incompleteImmunizations();
			$immAlerts = $this->upcomingImmunizations();
			
			Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view('herdasstimmun.herdImmAsstHome')
					    ->with([
							'activeImms'=>$activeImms,
							'incompImms'=> $incompImms,
							'immAlerts' => $immAlerts,
						]);
		}

        if( Auth::user()->hasRole('herdasstserum')  )
		{
			$seraIncomp = $this->serumIncomplete();
			$seraComp = $this->serumComplete();
			
			Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view('herdasstserum.herdSerumAsstHome')
					->with([
							'seraIncomp' => $seraIncomp,
							'seraComp' => $seraComp,
						]);
		}

        if( Auth::user()->hasRole('herdvet') )
		{
		    $hcount = $this->herdInfoCount();
			$hrdCount = $hcount[0];
			$hif = $hcount['hif'];
		    $goatsAlive = $this->liveGoatCount();
		    $goatsDead = $this->deadGoatCount();
		    $goatsRetired = $this->retiredGoatCount();
		    $goatsSick = $this->sickGoatCount();
		    $retVal = $this->agedGoatCount();
		    $activeImms = $this->activeImmunizations();
			$incompImms = $this->incompleteImmunizations();
			$immAlerts = $this->upcomingImmunizations();
			$seraIncomp = $this->serumIncomplete();
			$seraComp = $this->serumComplete();
			$colors = $this->allColors();
			$sops = $this->allSOPs();
			$feeds = $this->allFeeds();
			$adjuvants = $this->allAdjuvants();
			$quaran = $this->inQuarantine();
			
			$tandh = $this->processTempHumidGraphData();

			$hstat = ['Total Size', 'Occupancy', 'Vacant'];
			$hstinf = [$hif['total_size'], $hif['total_count'], $hif['toal_vacancy']];
			$hstinf1 = $hcount[1];
			$hstinf2 = $hcount[2];
			$hstinf3 = $hcount[3];
			$hstinf4 = $hcount[4];
			$hstinf5 = $hcount[5];
			$hstinf6 = $hcount[6];
			$hstinf7 = $hcount[7];
			$hstinf8 = $hcount[8];
			$hstinf9 = $hcount[9];
			//dd($hstinf1,$hstinf2,$hstinf3,$hstinf4,$hstinf5,$hstinf6,$hstinf7);
		    //$ageBand = ['1-2','2-3','3-4','4-5','5-6','6-7','7-8'];
	
			$agedGoatCount = $retVal['agc'];
			$graphVals = $retVal['grp'];
			
			foreach($graphVals as $row)
			{
			        $ageBand[] = $row['age_band'];
			        $ag[] = $row['count'];
			}

			$goatStatus = ['Alive', 'Sick', 'Ret', 'Dead'];
			$goatsStatData = [$goatsAlive, $goatsSick, $goatsRetired, $goatsDead];
			//get goat health parameters
			$hb = $this->getHbParam();
			
			//$hbx = json_encode($hb[0], JSON_NUMERIC_CHECK);
			//$hb = json_encode($hb[1], JSON_NUMERIC_CHECK);
			//dd($hstinf7,	$hbx, $hb);
			$wt = $this->getWeightParam();
			
			$rbc = $this->getRBCParam();
			
			$xcd = $this->getGoathealthParams();
			//dd($xcd);
			$hbscat = $xcd['hbscat'];
			$wtscat = $xcd['wtscat'];
			$tpscat = $xcd['tpscat'];
			$rrscat = $xcd['rrscat'];
			$mmscat = $xcd['mmscat'];
			$rcscat = $xcd['rcscat'];
			
			$rbcscat = $xcd['rbcscat'];
			$pltscat = $xcd['pltscat'];
			$pcvscat = $xcd['pcvscat'];
			$lftscat = $xcd['lftscat'];
			$kftscat = $xcd['kftscat'];
			$rtpcrscat = $xcd['rtpcrscat'];
			
			$totInfraItems = $this->totalInfraItems();
			Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view('herdvet.herdVetHome')
			                ->with(['herdCount'=>$hrdCount,
									'htotal_size'=>$hif['total_size'],
									'htotal_count'=>$hif['total_count'],
			                        'goatsAlive'=>$goatsAlive,
			                        'goatsDead'=>$goatsDead,
			                        'goatsRet'=>$goatsRetired,
			                        'goatsSick'=>$goatsSick,
			                        'activeImms'=>$activeImms,
									'incompImms'=> $incompImms,
			                        'agedGoatCount' => $agedGoatCount,
									'immAlerts' => $immAlerts,
									'seraIncomp' => $seraIncomp,
									'seraComp' => $seraComp,
									'colors' => $colors,
									'sops' => $sops,
									'feeds' => $feeds,
									'adjuvants' => $adjuvants,
									'quaran' => $quaran,
									'ageBand' => $ageBand,
									'goatNum' =>$ag,
									'totInfraItems'=> $totInfraItems,
									'tandh' => $tandh,
									'date_observed'=> $xcd['date_observed'],
									'mhb' => $xcd['mhb'],
									'mwt' => $xcd['mwt'],
									'mtp' => $xcd['mtp'],
									'mrr' => $xcd['mrr'],
									'mmm' => $xcd['mmm'],
									'mrc' => $xcd['mrc'],
									'mrbc'=> $xcd['mrbc'],
									'mplt'=> $xcd['mplt'],
									'mpcv'=> $xcd['mpcv'],
									'mlft'=> $xcd['mlft'],
                                    'mkft'=> $xcd['mkft'],
                                    'mrtpcr'=> $xcd['mrtpcr']
									])
									->with('ageBand', json_encode($ageBand,JSON_NUMERIC_CHECK))
									->with('goatNum', json_encode($ag,JSON_NUMERIC_CHECK))
									->with('goatStatus', json_encode($goatStatus, JSON_NUMERIC_CHECK))
									->with('goatsStatData', json_encode($goatsStatData,JSON_NUMERIC_CHECK))
									->with('hstat', json_encode($hstat,JSON_NUMERIC_CHECK))
									->with('hstinf', json_encode($hstinf,JSON_NUMERIC_CHECK))
									->with('hstinf1', json_encode($hstinf1,JSON_NUMERIC_CHECK))
									->with('hstinf2', json_encode($hstinf2,JSON_NUMERIC_CHECK))
									->with('hstinf3', json_encode($hstinf3,JSON_NUMERIC_CHECK))
									->with('hstinf4', json_encode($hstinf4,JSON_NUMERIC_CHECK))
									->with('hstinf5', json_encode($hstinf5,JSON_NUMERIC_CHECK))
									->with('hstinf6', json_encode($hstinf6,JSON_NUMERIC_CHECK))
									->with('hstinf7', json_encode($hstinf7,JSON_NUMERIC_CHECK))
									->with('hstinf8', json_encode($hstinf8,JSON_NUMERIC_CHECK))
									->with('hstinf9', json_encode($hstinf9,JSON_NUMERIC_CHECK))
									->with('xaxis', json_encode($xcd['xaxis'],JSON_NUMERIC_CHECK))
                                    ->with('hbscat', json_encode($xcd['hbscat']))
                                    ->with('wtscat', json_encode($xcd['wtscat']))
                                    ->with('tpscat', json_encode($xcd['tpscat']))
                                    ->with('rrscat', json_encode($xcd['rrscat']))
                                    ->with('mmscat', json_encode($xcd['mmscat']))
                                    ->with('rcscat', json_encode($xcd['rcscat']))
                                    ->with('rbcscat', json_encode($xcd['rbcscat']))
                                    ->with('pltscat', json_encode($xcd['pltscat']))
                                    ->with('pcvscat', json_encode($xcd['pcvscat']))
                                    ->with('lftscat', json_encode($xcd['lftscat']))
                                    ->with('kftscat', json_encode($xcd['kftscat']))
                                    ->with('rtpcrscat', json_encode($xcd['rtpcrscat']));
			
		}



        
        // only for management of users
        if( Auth::user()->hasRole('bestadmin') )
		{
		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return redirect()->route('users.index');
		}


        //for management of roles and permissions.
		if( Auth::user()->hasRole('admin') )
		{
		    
			$users = count(User::all());
			$subProjects = Tempproject::where('status', 'submitted')->get();
			$activeProjects = Project::where('status', 'active')->get();
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view('supadmin.supadminHome')->with([
									'users'=>$users,
									'groupTasks'=> 0
								 ]);
		}

        if( Auth::user()->hasRole('guest') || Auth::user()->hasRole('norole') )
		{
		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] dashboard requested');
			return view('norole.noRoleHome');
		}
        // end of herd management roles
        
		$msg = "Your account is freshly registered or has no assigned role or not activated. Contact Service Provider";
		Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Guest user requesting for dashboard');
      	return view('norole.noRoleHome')->with(['slot'=>$msg]);
    }

		 public function passwordReset(Request $request)
		 {
			 	//$token = $this->generateCode(80);
				//$request->route()->parameter('token') = $this->generateCode(80);
				$request->email = Auth::user()->email;
				Log::channel('activity')->info('Logged in user [ '.$request->email.' ] password reset requested');
			 	return view('auth.reset-pw', ['request' => $request]);
			 //return view('auth.reset-password');
		 }

		 public function updatePassword(Request $request)
		 {
				 $input = $request->all();

				 $rules = [
						 'email'    => 'required|email',
						 'password' => 'nullable|required_with:password_confirmation|string|confirmed',
						 //'current_password' => 'required',
				 ];

				 $validation = Validator::make( $input, $rules);

				 if ( $validation->fails() ) 
				 {
				        Log::channel('activity')->info('Logged in user [ '.$request->email.' ] validation failed');
						return redirect()->back()->withErrors($validation)->withInput();
				 }
				 else {

					 $result = User::where('email', $input['email'])->update([
														 'password' => Hash::make($input['password']),
														 'first_login' => date('Y-m-d')]);
                    Log::channel('activity')->info('Logged in user [ '.$request->email.' ] password reset successful');
					 return  redirect('/home');
				 }
		 }

		 public function expiredAccount()
		 {
				 $msg = "Your Account Expired on ".date('d-m-Y', strtotime(Auth::user()->expiry_date))." Contact Service Provider";
				 //return  view('norole.noroleHome');
				 Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] account expired');
				 return  view('errors.dashboard')->with('msg', $msg);
		 }

		 public function accountSuspended()
		 {
				 $msg = "Your Account Suspended. Contact Service Provider";
				 //return  view('norole.noroleHome');
				 Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] account suspended');
				 return  view('errors.dashboard')->with('msg', $msg);
		 }
}
