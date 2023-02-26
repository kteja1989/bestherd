<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

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
use App\Models\Health;
use App\Models\Goathealth;

use App\Traits\Base;
//use App\Traits\IssueRequest;
//use App\Traits\StrainConsumption;
//use App\Traits\ProjectStrainsById;
//use App\Traits\FormD;
//use App\Traits\costByProjectId;
//use App\Traits\ProjectQueries;
//use App\Traits\IssueRequestQueries;
use App\Traits\Fileupload;
use Livewire\WithFileUploads;
use Validator;

use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageHealthrecords extends Component
{
    use Base;
//	use ProjectQueries;
	
	//comman variables
	public $user_name; 
	
	//herd id
	public $herdIds;
	
	//dahsboard
	public $health_id, $herd_id, $heatlthRecords, $atrRequest, $immunizations;
	
	//ATR variables
	public $atr_goatids, $atr_notes, $atr_diagnosis, $atr_medication, $atr_remark, $quarantine;
	public $atrQuarant, $select_herd;
	
	public $healthInfATR, $goatIdsMentioned, $goatIdsYes=false, $atr_goatids2, $atr_option;
	public $openInpIds= false, $herdSelect=false, $herdGender, $sopIdFollwed;
	//panel variables
	public $atrUpdateForm;
	
	
    public function render()
    {
        if($this->atr_option == 1)
        {
            $this->atr_goatids = null;
            $this->openInpIds = false;
            $this->herdSelect = false;
        }
        
        if($this->atr_option == 2)
        {
            $this->openInpIds = true;
            $this->herdSelect = false;
        }
        
        if($this->atr_option == 3)
        {
            $this->openInpIds = true;
            $this->herdSelect = true;
        }
        
        if($this->atr_option == 4)
        {
            
            $this->openInpIds = false;
            $this->herdSelect = false;
            $this->atr_goatids = null;
            $this->atr_option = null;
        }

        
        $this->herdIds = Herd::where('category', 'sick')->get();
        $this->heatlthRecords = Health::all();
        $this->immunizations = Immunization::all();
        //dd($this->heatlthRecords);
        
        return view('livewire.goats.manage-healthrecords');
    }
    
    public function atrRequestClick($health_id)
    {
        $this->health_id = $health_id;
        $this->healthInfATR = Health::where('health_id', $health_id)->first();
        $this->herd_id = intval($this->healthInfATR->herd_id);
        $herdIdGender = Herd::where('herd_id', $this->herd_id)->value('gender');
        $this->sopIdFollwed = intval($this->healthInfATR->sop_id);
        $this->herdGender = Herd::where('category','sick')->where('gender', $herdIdGender)->first();
        
        $this->atrRequest = true;
    }
    
    public function saveATRDetails($health_id)
    {
        //get the sop id that is being followed
        if($this->quarantine)
        {
            $validatedData = $this->validate(
            [
                'atr_goatids'    => 'required|regex:/^[0-9; ]+$/',
                'select_herd'    => 'required|regex:/^[0-9 ]+$/',
            ],
            [
                'atr_goatids.required'          => 'Error: The :attribute cannot be empty.',
                'atr_goatids.atr_goatids'       => 'Error: The :attribute must be Number only.',
                'select_herd.required'          => 'Error: The :attribute cannot be empty.',
                'select_herd.select_herd'       => 'Error: The :attribute must be number only.',
            ],
            [ 
                'atr_goatids'    => 'Goat ID',
                'select_herd'    => 'Herd',
            ]);
        }
        
        $this->atr_diagnosis = null;
        
        $validatedData = $this->validate(
        [
            'atr_notes'      => 'required|string|regex:/^[A-Za-z0-9-,_. ]+$/',
            //'atr_diagnosis'  => 'required|string|regex:/^[A-Za-z0-9-,_. ]+$/',
            'atr_medication' => 'required|string|regex:/^[A-Za-z0-9-,_. ]+$/',
        ],
        [
            'atr_notes.required'            => 'Error: The :attribute cannot be empty.',
            'atr_notes.atr_notes'           => 'Error: The :attribute must be a number.',
            //'atr_diagnosis.required'        => 'Error: The :attribute cannot be empty.',
            //'atr_diagnosis.atr_diagnosis'   => 'Error: The :attribute must be letters only.',
            'atr_medication.required'       => 'Error: The :attribute cannot be empty.',
            'atr_medication.atr_medication' => 'Error: The :attribute must be letters only.',
        ],
        [ 
            'atr_notes'      => 'ATR',
            //'atr_diagnosis'  => 'Diagnosis',
            'atr_medication' => 'Medication',
        ]);
        
        $goatIdsChecked = array_filter(explode(';', $this->atr_goatids));
        $selectedHerd = intval($this->select_herd);
        
        $notes = "Notes:".$this->atr_notes;
        $diagnosis = "Diagnosis:".$this->healthInfATR->diagnosis;
        $action_taken = "Medication:".$this->atr_medication;
        $atr_remark = $this->atr_remark;
        $report = $notes.";".$diagnosis."; ".$action_taken;
        
        $result = $this->updateHealthInfos($health_id, $report, $atr_remark);
        
        //make diagnostic entries to all or the goat selected goats in the herd
        $herdGoats = Goat::where('herd_id', $this->herd_id)->get();
        
        $currentherd_id = $this->herd_id;
        //dd($currentherd_id, $notes, $diagnosis, $goatIdsChecked, $selectedHerd);
        foreach($herdGoats as $row)
        {
            $goatID = $row->goat_id;
            
            //now update health infos of all goats present in the herd. this should
            //be executed first. Not after moving out of this herd.
            //if normal goat are not to be entered an all is well entries to prevent
            //db fill-up uncomment below 4 lines (189-192) and comment-out line 187
            
            //  $result = $this->updateGoatHealthInfos($goatID, $diagnosis, $action_taken);
            
            if($this->atr_option == 2)
            {
                $result = $this->updateGoatHealthInfos($goatID, $diagnosis, $action_taken);
            }
            
            //check if the goat id is in the array of goats to be moved to sick herd
            // if yes move those goats.
            
            if(in_array($goatID, $goatIdsChecked))
            {
                if($this->atr_option == 3)
                {
                    $result = $this->moveGoatsFromHerdToHerd($goatID, $currentherd_id, $selectedHerd);
                }
            }

        }
        
        $this->atr_notes = null;
        $this->atr_diagnosis = null;
        $this->atr_medication = null;
        $this->atr_remark = null;
        
        $this->atrRequest = false;
    }
    
    public function updateHealthInfos($health_id, $report, $atr_remark)
    {
        $healthRec = Health::where('health_id',$health_id)->first();
        $healthRec->action_taken = $report;
        $healthRec->atr_on = date('Y-m-d');
        $healthRec->atr_acted_by = Auth::user()->name;
        $healthRec->remarks = $healthRec->remarks.";".$this->atr_remark;
        $healthRec->update();
    }
    
    public function updateGoatHealthInfos($goatID, $diagnosis, $action_taken)
    {
        //retrive the sop_id and show and record as per the sop
        
        $newGoatHealth = new Goathealth(); // not a new record?? it should update
        $newGoatHealth->sop_id = $this->sopIdFollwed;
        $newGoatHealth->goat_id = $goatID;
        $newGoatHealth->observations = $diagnosis;
        $newGoatHealth->date_observed = date('Y-m-d');
        $newGoatHealth->action_taken = $action_taken;
        $newGoatHealth->save();
        $newGoatHealth = null;
    }
    
    public function moveGoatsFromHerdToHerd($goatID, $currentherd_id, $selectedHerd)
    {
        //move from current herd to sick herd just change the herd id of the goat from 
        //start to destination id.
        $remark = "Goat Id ".$goatID." moved from herd id ".$currentherd_id." to herd id ".$selectedHerd." on ".date('d-m-Y');
        Goat::where('goat_id', $goatID)->update(['herd_id'=> $selectedHerd, 'remark' => $remark]);
        
        $oldHerdCount = intval(Herd::where('herd_id', $currentherd_id)->value('total_count'));
        Herd::where('herd_id', $currentherd_id)->update(['total_count' => $oldHerdCount-1, 'notes' => $remark]);
        
        $newHerdCount = intval(Herd::where('herd_id', $selectedHerd)->value('total_count'));
        Herd::where('herd_id', $selectedHerd)->update(['total_count' => $newHerdCount+1, 'notes' => $remark]);
        
        return true;
    }

}
