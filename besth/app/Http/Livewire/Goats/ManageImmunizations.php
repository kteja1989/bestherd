<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

//Frame work
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Livewire\WithFileUploads;
use Validator;
use File;

// projects
//use App\Models\Project;
//use App\Models\Assent;
use App\Models\User;

//Models for herds
use App\Models\Adjuvant;
use App\Models\Event;
use App\Models\Goat;
use App\Models\Goathealth;
use App\Models\Goatsera;
use App\Models\Herd;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Procedure;
use App\Models\Sop;

// Traits
use App\Traits\Base;
//use App\Traits\costByProjectId;
use App\Traits\Fileupload;
//use App\Traits\FormD;
//use App\Traits\IssueRequest;
//use App\Traits\IssueRequestQueries;
//use App\Traits\ProjectQueries;
//use App\Traits\ProjectStrainsById;
//use App\Traits\StrainConsumption;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageImmunizations extends Component
{
    use Base;
//	use ProjectQueries;

	//dashboard variable
	public $immunizations = [];

    public $herd_id;
    
    //immunization form variables
    public $editimsop_id, $editimm_date, $adjuvants, $editimmgen_code,  $editimadjuvant_code,  $editimmunogen_volume, $editimmunogen_site;
    public $editimmunogen_route, $editimsample_desc, $editsample_volume, $editsampbatch_id, $editsample_source;
    public $editsupplied_by, $editsample_ref, $editremark, $editfrom_id, $editto_id, $imm_status;
    public $editimfreqnumber, $imfrequnit, $fullpartial, $scanGoatId2, $scannedGoatIds, $scanError2;
    public $idsDone, $remaining, $remainingGoats, $gis=[];
    //edit form variables
    public $immunization_id, $immun_id, $imDet;

	//panels
	public $showDetails = false;
    public $viewEditImmInfo = false;

    //message variables
    public $immErrorMsgEdit = null;

    public function render()
    {
        $this->immunizations = Immunization::all();
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization dashboard displayed');
        return view('livewire.goats.manage-immunizations');
    }

    public function fullDetails($immunization_id)
    {
        $this->viewEditImmInfo = false;
        $this->imDet = Immunization::where('immunization_id', $immunization_id)->first();
        $this->showDetails = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Info Displayed for Immunization ID '.$immunization_id);
    }

    public function editImmunizationInfo($immunization_id)
    {
        $this->showDetails = false;

        $this->immunization_id = $immunization_id;
        $this->immun_id = $immunization_id;
        $this->imDet = Immunization::where('immunization_id', $immunization_id)->first();
        
        $this->herd_id = $this->imDet->herd_id;
        $this->imsops = Sop::where('department_id', 3)->where('activity_id', 2)->get();
        $this->adjuvants = Adjuvant::all();
        //show goat ids already done
        $this->idsDone = Immunedgoats::where('immunization_id',$immunization_id)->pluck('goat_id');
        
        $this->remaining = Goat::where('herd_id', $this->imDet->herd_id)->pluck('goat_id');
        
        if(count($this->idsDone) > 0 )
        {
            foreach($this->idsDone as $row)
            {
                $da[] = $row;
                sort($da);
            }
        }
        else {
            $da[] = null;
        }
        
        foreach($this->remaining as $row)
        {
            $dax[] = $row;
        }
        
        sort($da);
        sort($dax);
        $this->remainingGoats = array_diff($dax, $da);
        sort($this->remainingGoats);
        
        //fill the form with Data
        $this->editimm_date = date('Y-m-d', strtotime($this->imDet->immunization_date));
        $this->editimsop_id = $this->imDet->sop_id;
        $this->editimmgen_code = $this->imDet->immunogen_code;
        
        $this->editimadjuvant_code = $this->imDet->adjuvent_code;
        $this->editimfreqnumber = $this->imDet->frequency;
        $this->imfrequnit = $this->imDet->frequency_unit;
        $this->editimmunogen_volume = $this->imDet->immunogen_volume;
        $this->editimmunogen_site = $this->imDet->immunogen_site;
        $this->editimmunogen_route = $this->imDet->immunogen_route;
        $this->editimsample_desc = $this->imDet->sample_desc;
        $this->editsample_volume = $this->imDet->sample_volume;
        $this->editsampbatch_id = $this->imDet->batch_id;
        $this->editsample_source = $this->imDet->sample_source;
        $this->editsupplied_by = $this->imDet->supplied_by;
        $this->editsample_ref = $this->imDet->sample_ref;
        $this->editauth_by = $this->imDet->auth_by;
        $this->editimngen_code = $this->imDet->status;
        $this->editremark = $this->imDet->remark;
        
        $this->imm_status = $this->imDet->status;
        //dd($this->imsop_id, $this->adjuvants);
        $this->viewEditImmInfo = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Info Dsplayed for Editing of Immunization ID '.$immunization_id);
    }

    public function updatedScanGoatId2()
    {
        $this->scanError2 = null;
        $this->viewSingleGoatInfo = false;
        
        $validatedData = $this->validate(
        [
            'scanGoatId2' => 'numeric|regex:/^[0-9 ]+$/',
        ],
        [
            'scanGoatId2.scanGoatId2' => 'The :attribute must be Number only.',
        ],
        [
            'scanGoatId2' => 'Goat Id'
        ]);

        if( $this->scanGoatId2 != null)
        {
            $result = Goat::where('herd_id', $this->herd_id)->where('goat_id', ltrim($this->scanGoatId2, '0'))->first();
            if($result)
            {
                $result2 = Immunedgoats::where('immunization_id', $this->immunization_id)->where('goat_id', ltrim($this->scanGoatId2, '0'))->first();
                if(!$result2)
                {
                    if(!in_array($this->scanGoatId2, $this->gis))
                    {
                        $this->scannedGoatIds = $this->scannedGoatIds." ; ".$this->scanGoatId2;
                        array_push($this->gis, $this->scanGoatId2);
                        $this->scanGoatId2 = null;
                    }
                    else{
                        $this->scanError2 = "Already Scanned";
                    }
                }
                else {
                    $this->scanError2 = "Already Immunized";
                }
            }
            else{
                $this->scanError2 = "Goat Id Not Found";
            }
        }
    }


    public function saveImmunizationDetails($immunization_id)
    {
        $this->immErrorMsgEdit = null;
        //perform validations
        $this->immunization_id = $immunization_id;
        $imDetail = Immunization::where('immunization_id', $immunization_id)->first();
        $herdGoats = Goat::where('herd_id', $imDetail->herd_id)->get();

        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //dd($immunization_id);
            if($immunization_id !=  null)
            {
                //now save the individual goat immunized data through loop
                if(count($this->gis) > 0)
                {
                    //$gis = array_filter(explode(" ; ", $this->scannedGoatIds));
                    $validatedData = $this->validate(
                    [
                        'editimm_date'        => 'required|date',
                        'editimsop_id'        => 'required|regex:/^[0-9]+$/',
                        'editimmgen_code'     => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'editimadjuvant_code' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'editimfreqnumber'    => 'required|regex:/^[0-9]+$/',
                        'imfrequnit'          => 'required|string|regex:/^[A-Za-z]+$/',
                        
                        'editimmunogen_volume' => 'required|integer',
                        'editimmunogen_site'  => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'editimmunogen_route' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'editimsample_desc'   => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'editsample_volume'   => 'required|integer',
                        'editsampbatch_id'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'editsample_source'   => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'editsupplied_by'     => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'editsample_ref'      => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'editauth_by'         => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'editremark'          => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                    ],
                    [
                        'editimm_date.required' => 'Error: The :attribute cannot be empty.',
                        'editimm_date.editimm_date' => 'Error: The :attribute must be Datr only.',
                        'editimsop_id.required' => 'Error: The :attribute cannot be empty.',
                        'editimsop_id.editimsop_id' => 'Error: The :attribute must be letters only.',
                        'editimmgen_code.required' => 'Error: The :attribute cannot be empty.',
                        'editimmgen_code.editimmgen_code' => 'Error: The :attribute must be letters only.',
                        'editimadjuvant_code.required' => 'Error: The :attribute cannot be empty.',
                        'editimadjuvant_code.editimadjuvant_code' => 'Error: The :attribute must be letters only.',
                        
                        'editimfreqnumber.required'  => 'Error: The :attribute cannot be empty.',
                        'editimfreqnumber.editimfreqnumber' => 'Error: The :attribute must be number only.',
                        
                        'editimfrequnit.required'  => 'Error: The :attribute cannot be empty.',
                        'editimfrequnit.editimfrequnit' => 'Error: The :attribute must be letters only.',
                        
                        'editimmunogen_volume.required' => 'Error: The :attribute cannot be empty.',
                        'editimmunogen_volume.editimmunogen_volume' => 'Error: The :attribute must be Number only.',
                        'editimmunogen_site.required' => 'Error: The :attribute cannot be empty.',
                        'editimmunogen_site.editimmunogen_site' => 'Error: The :attribute must be letters only.',
                        'editimmunogen_route.required' => 'Error: The :attribute cannot be empty.',
                        'editimmunogen_route.editimmunogen_route' => 'Error: The :attribute must be letters only.',
                        'editimsample_desc.required' => 'Error: The :attribute cannot be empty.',
                        'editimsample_desc.editimsample_desc' => 'Error: The :attribute must be letters only.',
                        'editsample_volume.required' => 'Error: The :attribute cannot be empty.',
                        'editsample_volume.editsample_volume' => 'Error: The :attribute must be letters only.',
                        'editsampbatch_id.required' => 'Error: The :attribute cannot be empty.',
                        'editsampbatch_id.editsampbatch_id' => 'Error: The :attribute must be letters only.',
                        'editsample_source.required' => 'Error: The :attribute cannot be empty.',
                        'editsample_source.editsample_source' => 'Error: The :attribute must be letters only.',
                        'editsupplied_by.required' => 'Error: The :attribute cannot be empty.',
                        'editsupplied_by.editsupplied_by' => 'Error: The :attribute must be letters only.',
                        'editsample_ref.required' => 'Error: The :attribute cannot be empty.',
                        'editsample_ref.editsample_ref' => 'Error: The :attribute must be letters only.',
                        'editauth_by.required' => 'Error: The :attribute cannot be empty.',
                        'editauth_by.editauth_by' => 'Error: The :attribute must be letters only.',
                        'editremark.required' => 'Error: The :attribute cannot be empty.',
                        'editremark.editremark' => 'Error: The :attribute must be letters only.',
                    ],
                    [
                        'editimsop_id'     => 'SOP ID',
                        'editimmgen_code'    => 'Immunogen Code',
                        'editimadjuvant_code'    => 'Adjuvent Code',
                        'editimfreqnumber' => 'Immunization Frequncy',
                        'editimfrequnit' => 'Frequency Unit',
                        'editimmunogen_volume' => 'Immunogen Volume',
                        'editimmunogen_site' => 'Immunization Site',
                        'editimmunogen_route' => 'Immunization Route',
                        'editimsample_desc' => 'Sample Description',
                        'editsample_volume' => 'Sample Volume',
                        'editsampbatch_id' => 'Sample Batch Id',
                        'editsample_source' => 'Sample Source',
                        'editsupplied_by' => 'Sample Supplied By',
                        'editsample_ref' => 'Sample Reference',
                        'editauth_by' => 'Authorized By',
                        'editremark' => 'Remarks',
                    ]);
                    
                    $input['project_id'] = 1;
                    $input['herd_id'] = $imDetail->herd_id;
                    $input['posted_by'] = Auth::user()->name;
                    $input['immunization_date'] = $this->editimm_date;
                    $input['sop_id'] = $this->editimsop_id;
                    $input['immunogen_code'] = $this->editimmgen_code;
                    $input['frequency'] = $this->editimfreqnumber;
                    $input['frequency_unit'] = $this->imfrequnit;
                    $input['adjuvent_code'] = $this->editimadjuvant_code;
                    $input['immunogen_volume'] = $this->editimmunogen_volume;
                    $input['immunogen_site'] = $this->editimmunogen_site;
                    $input['immunogen_route'] = $this->editimmunogen_route;
                    $input['sample_desc'] = $this->editimsample_desc;
                    $input['sample_volume'] = $this->editsample_volume;
                    $input['batch_id'] = $this->editsampbatch_id;
                    $input['sample_source'] = $this->editsample_source;
                    $input['supplied_by'] = $this->editsupplied_by;
                    $input['sample_ref'] = $this->editsample_ref;
                    $input['auth_by'] = $this->editauth_by;
                    $input['remark'] = $this->editremark;
                   
                    
                    /*
                    $imDetail->project_id = 1; //change this to actual value after testing;
                    $imDetail->herd_id = $imDetail->herd_id;
                    $imDetail->posted_by = Auth::user()->name;
                    $imDetail->immunization_date = $this->editimm_date;
                    $imDetail->sop_id = $this->editimsop_id;
                    $imDetail->immunogen_code = $this->editimmgen_code;
                    $imDetail->frequency = $this->editimfreqnumber;
                    $imDetail->frequency_unit = $this->imfrequnit;
                    $imDetail->adjuvent_code = $this->editimadjuvant_code;
                    $imDetail->immunogen_volume = $this->editimmunogen_volume;
                    $imDetail->immunogen_site = $this->editimmunogen_site;
                    $imDetail->immunogen_route = $this->editimmunogen_route;
                    $imDetail->sample_desc = $this->editimsample_desc;
                    $imDetail->sample_volume = $this->editsample_volume;
                    $imDetail->batch_id = $this->editsampbatch_id;
                    $imDetail->sample_source = $this->editsample_source;
                    $imDetail->supplied_by = $this->editsupplied_by;
                    $imDetail->sample_ref = $this->editsample_ref;
                    $imDetail->auth_by = $this->editauth_by;
                    $imDetail->remark = $this->editremark;
                    */
                    
                    //first get whether immunizing full herd or partially
                    //if full herd, enter into goat ids of all in that herd.
                    //if partially, enter only for the ids selected.
                    
                    $imDetail->total_immunized = $imDetail->total_immunized + count($this->gis);
                    $input['total_immunized'] =  $imDetail->total_immunized;
                     
                    if(count($herdGoats) == $imDetail->total_immunized)
                    {
                        $input['status'] = 'complete';
                        $imDetail->status = 'complete';
                    }

                    //dd(count($herdGoats), $imDetail->total_immunized, count($this->gis), $imDetail->status, $imDetail);
                    // now save the model
                    $imDetail->update($input); //everything worked well;
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Edited Details for Immunization ID '.$immunization_id);
                    
                    $today = date('Y-m-d');
                    $booster_due = date('Y-m-d H:i:s', strtotime($today."+".$this->editimfreqnumber." days"));
                    foreach($this->gis as $row)
                    {
                        Immunedgoats::firstOrCreate(
                        [
                            'immunization_id' => $immunization_id,
                            'goat_id' => intval($row),
                            'booster_due' => $booster_due,
                            'notes' => 'immunized']
                        );
                        //dd($row->goat_id);
                        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Edited Details Immunization of Goad ID '.intval($row));
                        /*
                        $immundGoat = new Immunedgoats();
                        $immundGoat->immunization_id = $immDet->immunization_id;
                        $immundGoat->goat_id = $row->goat_id;
                        $immundGoat->notes = "immunized";
                        $immundGoat->save();
                        */
                    }
                    
                    //now post to event table for calendar Display
                    $today = date('Y-m-d');
                    $newEvent = new Event();
                    $newEvent->title = "Herd ".$this->herd_id."-R Booster Due";
                    $newEvent->description = "Booster with ".$this->editimmgen_code;
                    $newEvent->start_date = date('Y-m-d H:i:s', strtotime($today."+".$this->editimfreqnumber." days"));
                    $newEvent->priority = "high";
                    $newEvent->save();
                    
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Created Immunization Event ID '.$newEvent->event_id);
                    
                    // reset the form
                    $this->resetImmunizedForm();
                    $immDet = null;
                    $this->herd_id = null;
                    $this->viewEditImmInfo = false;
                    //$this->viewImmInf = false;
                
                }
                else {
                  $this->immErrorMsgEdit = "Must Select one ID for Immunization";
                }
            }
            else {
                $this->immErrorMsgEdit = "Immunization ID Tampered Not present";
            }
        }
        else {
          return view('livewire.permError');
        }
        //perform checks
    }

    public function resetImmunizedForm()
    {
        $this->editimm_date = null;
        $this->editimsop_id = null;
        $this->editimmgen_code = null;
        $this->editimadjuvent_code = null;
        $this->editimfreqnumber = null;
        $this->editimfrequnit = null;
        $this->editimmunogen_volume = null;
        $this->editimmunogen_site = null;
        $this->editimmunogen_route = null;
        $this->editimsample_desc = null;
        $this->editsample_volume = null;
        $this->editsampbatch_id = null;
        $this->editsample_source = null;
        $this->editsupplied_by = null;
        $this->editsample_ref = null;
        $this->editauth_by = null;
        $this->editremark = null;
        $this->editfrom_id = null;
        $this->editto_id = null;
        $this->gis = [];
        $this->scannedGoatIds = null;
        $this->remaining = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization form reset ');
    }
}
