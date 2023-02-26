<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

//use App\Models\Project;
//use App\Models\Assent;
use App\Models\User;

//Models for herds
use App\Models\Herd;
use App\Models\Goat;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Serum;
use App\Models\Goatsera;

use App\Models\Titer;
use App\Models\Goattiter;

use App\Traits\Base;
use App\Traits\SerumDataUpdateTrait;
//use App\Traits\IssueRequest;
//use App\Traits\StrainConsumption;
//use App\Traits\ProjectStrainsById;
//use App\Traits\FormD;
//use App\Traits\costByProjectId;
//use App\Traits\ProjectQueries;
//use App\Traits\IssueRequestQueries;
//use App\Traits\Fileupload;
//use Livewire\WithFileUploads;
use Validator;

use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageTiters extends Component
{
    use Base, SerumDataUpdateTrait;
//  	use ProjectQueries;
  	
  	//dashboard variables
  	public $serum_id, $herd_id, $serumData, $serData, $goatInfo, $imGoatArray, $immunizations;

  	//serum form variables
  	public $edserproc_id, $edserbatch_id, $edseruser_name, $edsernotes;
  	
  	//titer details 

    public $messagex, $serumvolume;

  	//panel variables
  	public $viewSerumForm = false, $error=[];
    public $viewTiterInfo = false; 
    
  	//Error messages
  	public $serumErrorMessage = null;
  	public $titerErrorMessage = null;
  	
  	//graph titer
  	public $titerscat;
  	
  	//goat details
  	public $curGoatList, $goats, $viewGoatList = false;
  	
  	//panels
  	public $viewGoatInfo = false;
    public $viewTiterDetail = false;
    
    
    
    public function render()
    {
        $this->serumData = Serum::all();
        $this->immunizations = Immunization::all();
        //dd($this->serumData);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Form Displayed');
        return view('livewire.goats.manage-titers');
    }
    
    public function fetchTiterDetails($serum_id)
    {
        $this->viewSerumForm = false;
        
        $result = Serum::where('serum_id', $serum_id)->first();
        
        $this->herd_id = $result->herd_id;
        
        $this->allHerds = Herd::where('category', '<>', 'quarantine')->get();
        $this->herdInfo = Herd::where('herd_id', $this->herd_id)->get();
        $this->curGoatList = Goat::where('herd_id', $this->herd_id)->get(); //orig
            
        // panel visibility
        if(count($this->curGoatList) > 0)
        {
            $this->viewGoatList = true;
        }
        else {
            $this->viewGoatList = false;
        }
        
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Details Displayed');
        //dd($serum_id, $this->herd_id);
        $this->viewGoatInfo = true;
    }
    
    public function viewGoatTiterDetails($goat_id)
    {
        $this->viewSerumForm = false;
        
        $x1 = ["x"=>1, "y"=>256];
        $x2 = ["x"=>1, "y"=>512];
        $x3 = ["x"=>1, "y"=>256];
        $titer = [];
        array_push($titer, $x1, $x2, $x3);
        
        $this->titerscat = json_encode($titer);
        
        
        $this->goat_id = $goat_id;
        
        $this->goat_titer = Goattiter::where('goat_id', $goat_id)->orderBy('goattiter_id', 'desc')->take(5)->get();
       // $this->goat_sera = Goatsera::where('goat_id', $goat_id)->orderBy('goatsera_id', 'desc')->take(5)->get();
        //dd($this->herd_id, $this->goat_id, $this->goat_titer);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Details Displayed for Goat ID :'.$goat_id);
        $this->viewTiterDetail = true;
        
        $this->dispatchBrowserEvent('drawTiterGraph', ['assets'=> $this->titerscat]);
    }
}
