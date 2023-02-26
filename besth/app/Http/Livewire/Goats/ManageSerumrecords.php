<?php

namespace App\Http\Livewire\Goats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Project;
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

class ManageSerumrecords extends Component
{
    use Base, SerumDataUpdateTrait;
//  	use ProjectQueries;
  	
  	//dashboard variables
  	public $serum_id, $herd_id, $serumData, $serData, $goatInfo, $imGoatArray, $immunizations;

  	//serum form variables
  	public $edserproc_id, $edserbatch_id, $edseruser_name, $edsernotes;
  	
    public $messagex, $serumvolume;

  	//panel variables
  	public $viewSerumForm = false, $error=[];
    
  	//Error messages
  	public $serumErrorMessage = null;

  	//goat details
  	public $curGoatList, $goats, $viewGoatList = false;
  	
  	//panels
  	public $viewGoatInfo = false;

    public function render()
    {
        $this->serumData = Serum::all();
        $this->immunizations = Immunization::all();
        //dd($this->serumData);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum main dashboard displayed');
        return view('livewire.goats.manage-serumrecords');
    }

    // animals from
    public function fetchSeraCollectedGoats($serum_id)
    {
        $blank = array();
        $this->serum_id = $serum_id;
        $this->serData = Serum::where('serum_id', $serum_id)->first();
        $this->herd_id = intval($this->serData->herd_id);

        $this->edserproc_id = $this->serData->sop_id;
        $this->edserbatch_id = $this->serData->batch_code;
        $this->edseruser_name = $this->serData->auth_by;
        $this->edsernotes = $this->serData->notes;

        $this->goatInfo = Goat::with('goatTiter')->with('goatWeight')->where('herd_id', $this->herd_id)->get();

        $this->imGoatArray = Goatsera::where('serum_id', $serum_id)->get();

        $this->getGoatIdVolumeArray($this->imGoatArray);

        //dd($this->imGoatArray);
        $this->viewSerumForm = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Details displayed for Serum ID '.$serum_id);
        //dd($serum_id, $this->serData, intval($this->serData->herd_id), $this->goatInfo);
    }

    //fetch incomplete sera
    public function fetchGoatsToBeCollected($serum_id)
    {
        //dd($serum_id);
    }

    //fetch incomplete sera
    public function updated($serumvolume)
    {
        $this->messagex = null;
        foreach($this->serumvolume as $key => $val)
        {
            if(!array_key_exists($key, $this->imGoatArray))
            {
                if(is_numeric(trim($val)))
                {
                    //introduce a check point elimination of already entered values
                    $result = $this->serumDataUpdate($this->serum_id, $key, $val);
                    //$this->serumvolume[$key] = null;
                    
                    //dd($this->imGoatArray);
                    if($result)
                    {
                        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Details posted for Serum volume '.intval($val));
                        $this->error[$key] = intval($val)." ml collected ";
                    }
                    else {
                        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] DB posting failed for Serum volume '.intval($val));
                        $this->error[$key] = intval($val)." DB Posting Failed ";
                    }
                }
                    else {
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Valid volume number not entered ');
                    $this->error[$key] = $val." Not a valid number";
                }
            }
        }
    }

    public function getGoatIdVolumeArray($inpArray)
    {
        $darray = array();
        foreach($inpArray as $row)
        {
            $darray[$row->goat_id] = $row->volume;
        }
        $this->imGoatArray = $darray;
        //dd($this->imGoatArray);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum Goat ID array processed ');
        //$this->error = array_fill(0, count($inpArray)+200, 'Not Collected');
    }

}