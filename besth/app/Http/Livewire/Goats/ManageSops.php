<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Gate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Project;
use App\Models\Procedure;
use App\Models\Assent;
use App\Models\User;
use App\Models\Department;
use App\Models\Sop;
use App\Models\Activity;

use App\Traits\Base;
use App\Traits\HerdFileUploadTrait;
use App\Traits\Fileupload;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageSops extends Component
{
    use Base;
    use WithFileUploads;
    use HerdFileUploadTrait;
    
    public $title, $description, $versionId, $approvedBy, $approvedDate;
    public $approvedRef, $authority, $validTill, $lwMessage;
    public $departments, $dept, $actvits;
    
    //button display
    public $repeat_time, $repeat_time_unit;
    public $addNew = true, $edsop_id, $fileref=[];
    
    public function render()
    {
        /*
        if(Auth::user()->hasAnyRole('pisg','pilg','piblg','pient','manager'))
        {
            $depts = Department::all();
            $activities = Activity::all();
            $procedures = Sop::with('activits')->with('dept')->where('pi_id', Auth::id())->get();
            
            return view('livewire.goats.manage-sops')->with(['procedures'=>$procedures, 'activities'=>$activities, 'depts'=>$depts]);
        }
        */
        
        if(Auth::user()->hasRole('herdmanager'))
        {
            $depts = Department::where('department_id', 3)->get();
            $activities = Activity::all();
            //$procedures = Procedure::where('department_id', 3)->get();
            $sops = Sop::with('activits')->where('department_id', 3)->get();
            //dd($sops);
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] SOP Landing page displayed');
            return view('livewire.goats.manage-sops')->with(['sops'=>$sops, 'activities'=>$activities, 'depts'=>$depts]);
        }

    }

    public function addNewSop()
    {

        $validatedData     = $this->validate(
        [   'dept'         => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'actvits'      => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'title'        => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'description'  => 'required|string|regex:/^[A-Za-z0-9-_,. ]+$/',
            'repeat_time'  => 'required|integer',
            'repeat_time_unit' => 'required|string|regex:/^[A-Za-z]+$/',
            'versionId'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedBy'   => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedDate' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedRef'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'authority'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'validTill'    => 'required|date'
        ],
        [
            'dept.required'            => 'Error: The :attribute must be selected.',
            'dept.dept'                => 'Error: The :attribute must be letters, dash and underscore only.',
            
            'actvits.required'      => 'Error: The :attribute must be selected.',
            'actvits.actvits'          => 'Error: The :attribute must be letters, dash and number only.',
            
            'title.required'           => 'Error: The :attribute cannot be empty.',
            'title.title'              => 'Error: The :attribute must be letters, dash and underscore only.',
            'description.required'     => 'Error: The :attribute cannot be empty.',
            'description.description'  => 'Error: The :attribute must be letters, dash and underscore only.',
            
            'repeat_time.required' => 'Error: The :attribute cannot empty',
            'repeat_time.repeat_time' => 'Error: The :attribute must a number only',
            
            'repeat_time_unit.required' => 'Error: The :attribute cannot be empty',
            'repeat_time_unit.repeat_time_unit' => 'Error: The :attribute must be letters only',
            
            'versionId.required'       => 'Error: The :attribute cannot be empty.',
            'versionId.versionId'      => 'Error: The :attribute must be letters, dash and underscore only.',
            'approvedBy.required'      => 'Error: The :attribute cannot be empty.',
            'approvedBy.approvedBy'    => 'Error: The :attribute must be Letters and Dash only.',
            'approvedDate.required'    => 'Error: The :attribute cannot be empty.',
            'approvedDate.approvedDate'=> 'Error: The :attribute must be Letters and Dash only.',
            'approvedRef.required'     => 'Error: The :attribute cannot be empty.',
            'approvedRef.approvedRef'  => 'Error: The :attribute must be Letters and Dash only.',
            'authority.required'       => 'Error: The :attribute cannot be empty.',
            'authority.authority'      => 'Error: The :attribute must be Letters and Dash only.',
            'validTill.required'       => 'Error: The :attribute cannot be empty.',
            'validTill.validTill'      => 'Error: The :attribute must be Date.',
            
        ],
        [ 
            'dept'         => 'Department',
            'actvits'      => 'Activity Group',
            'title'        => 'Title',
            'description'  => 'Description',
            'repeat_time' => 'Repeation Time',
            'repeat_time_unit' => 'Repeatition Time Unit',
            'versionId'    => 'Version Id',
            'approvedBy'   => 'Approved By',
            'approvedDate' => 'Approval Date',
            'approvedRef'  => 'Approval Reference',
            'authority'    => 'Authority',
            'validTill'    => 'Validity Date'
        ]);
          
          
        $sops = new Sop();
        $sops->department_id = $this->dept;
        $sops->activity_id = $this->actvits;
        $sops->title = $this->title;
        $sops->description = $this-> description;
        $sops->repeat_time = $this->repeat_time;
        $sops->repeat_unit = $this->repeat_time_unit;
        $sops->version_id = $this->versionId;
        $sops->approved_by = $this->approvedBy;
        $sops->approved_date = $this->approvedDate;
        $sops->approved_reference = $this->approvedRef;
        $sops->approved_authority = $this->authority;
        $sops->validity_date =  $this->validTill;
        $sops->pi_id =  Auth::id();
        $sops->status = 'Active';
        $sops->save();    
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Saved New SOP ID '.$sops->sop_id);
        //upload doc file here
        if($this->fileref != null)
        {
            $data = $this->validate(
            [
                'fileref.*' => 'nullable|mimes:pdf'
            ],
            [
                'fileref.*' => 'The :attribute must be pdf only.'
            ],
            [
                'fileref.*' => 'SOP File'
            ]);
        
            $filetype = "sops";
            
            $result = $this->uploadHerdFiles($sops->sop_id, $filetype, $this->fileref);
            $this->fileref = [];
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Saved New SOP File for ID '.$sops->sop_id);
        }// if statement
                    

        $this->lwMessage = "New Protocol Added";
        
        $this->resetProcedureForm();
        $this->addNew = true;
    }
    
    public function editSOP($sop_id)
    {
        $edsop = Sop::with('activits')->where('department_id', 3)->where('sop_id', $sop_id)->first();
        //dd($sop_id, $edsop);
        
        $this->edsop_id = $sop_id;
        $this->dept = $edsop->department_id;
        $this->actvits = $edsop->activity_id;
        $this->title = $edsop->title;
        $this->description = $edsop->description;
        $this->repeat_time = $edsop->repeat_time;
        $this->repeat_time_unit = $edsop->repeat_unit;
        $this->versionId = $edsop->version_id;
        $this->approvedBy = $edsop->approved_by;
        $this->approvedDate = date('Y-m-d', strtotime($edsop->approved_date));
        $this->approvedRef = $edsop->approved_reference;
        $this->authority = $edsop->approved_authority;
        $this->validTill = date('Y-m-d', strtotime($edsop->validity_date));
        $this->addNew = false;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Info Displayed for Editing SOP ID '.$sop_id);
    }
    
    public function updateSop($sop_id)
    {
        $validatedData     = $this->validate(
        [   'dept'         => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'actvits'      => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'title'        => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'description'  => 'required|string|regex:/^[A-Za-z0-9-_,. ]+$/',
            'repeat_time'  => 'required|integer',
            'repeat_time_unit' => 'required|string|regex:/^[A-Za-z]+$/',
            'versionId'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedBy'   => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedDate' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'approvedRef'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'authority'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'validTill'    => 'required|date'
        ],
        [
            'dept.required'            => 'Error: The :attribute must be selected.',
            'dept.dept'                => 'Error: The :attribute must be letters, dash and underscore only.',
            
            'actvits.required'      => 'Error: The :attribute must be selected.',
            'actvits.actvits'          => 'Error: The :attribute must be letters, dash and number only.',
            
            'title.required'           => 'Error: The :attribute cannot be empty.',
            'title.title'              => 'Error: The :attribute must be letters, dash and underscore only.',
            'description.required'     => 'Error: The :attribute cannot be empty.',
            'description.description'  => 'Error: The :attribute must be letters, dash and underscore only.',
            
            'repeat_time.required' => 'Error: The :attribute cannot empty',
            'repeat_time.repeat_time' => 'Error: The :attribute must a number only',
            
            'repeat_time_unit.required' => 'Error: The :attribute cannot be empty',
            'repeat_time_unit.repeat_time_unit' => 'Error: The :attribute must be letters only',
            
            'versionId.required'       => 'Error: The :attribute cannot be empty.',
            'versionId.versionId'      => 'Error: The :attribute must be letters, dash and underscore only.',
            'approvedBy.required'      => 'Error: The :attribute cannot be empty.',
            'approvedBy.approvedBy'    => 'Error: The :attribute must be Letters and Dash only.',
            'approvedDate.required'    => 'Error: The :attribute cannot be empty.',
            'approvedDate.approvedDate'=> 'Error: The :attribute must be Letters and Dash only.',
            'approvedRef.required'     => 'Error: The :attribute cannot be empty.',
            'approvedRef.approvedRef'  => 'Error: The :attribute must be Letters and Dash only.',
            'authority.required'       => 'Error: The :attribute cannot be empty.',
            'authority.authority'      => 'Error: The :attribute must be Letters and Dash only.',
            'validTill.required'       => 'Error: The :attribute cannot be empty.',
            'validTill.validTill'      => 'Error: The :attribute must be Date.',
            
        ],
        [ 
            'dept'         => 'Department',
            'actvits'      => 'Activity Group',
            'title'        => 'Title',
            'description'  => 'Description',
            'repeat_time' => 'Repeation Time',
            'repeat_time_unit' => 'Repeatition Time Unit',
            'versionId'    => 'Version Id',
            'approvedBy'   => 'Approved By',
            'approvedDate' => 'Approval Date',
            'approvedRef'  => 'Approval Reference',
            'authority'    => 'Authority',
            'validTill'    => 'Validity Date'
        ]);
        
        $input['department_id'] = $this->dept;
        $input['activity_id'] = $this->actvits;
        $input['title'] = $this->title;
        $input['description'] = $this-> description;
        $input['repeat_time'] = $this->repeat_time;
        $input['repeat_unit'] = $this->repeat_time_unit;
        $input['version_id'] = $this->versionId;
        $input['approved_by'] = $this->approvedBy;
        $input['approved_date'] = $this->approvedDate;
        $input['approved_reference'] = $this->approvedRef;
        $input['approved_authority'] = $this->authority;
        $input['validity_date'] =  $this->validTill;
        $input['pi_id'] =  Auth::id();
        $input['status'] = 'Active';
        
        $sopresult = Sop::where('sop_id', $sop_id)->update($input);
        
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Updated Data for SOP ID '.$sop_id);
        
        //upload doc file here
        if($this->fileref != null)
        {
            $data = $this->validate(
            [
                'fileref.*' => 'nullable|mimes:pdf'
            ],
            [
                'fileref.*' => 'The :attribute must be pdf only.'
            ],
            [
                'fileref.*' => 'SOP File'
            ]);
        
            $filetype = "sops";
            
            $result = $this->uploadHerdFiles($sop_id, $filetype, $this->fileref);
            $this->fileref = [];
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] File uploaded for SOP ID '.$sop_id);
        }// if statement
                    
        
        $this->lwMessage = "New Protocol Added";
        
        $this->resetProcedureForm();
        $this->addNew = true;

    }
    
    public function downloadSOP($sop_id)
    {
        $res = Sop::where('sop_id', $sop_id)->first();
        $path = "app/".$res->path.$res->filename;
        $path = storage_path($path);
        $headers = array(
            'Content-Type: application/pdf',
        );
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Download requeste processed for SOP ID '.$sop_id);
        return response()->download($path);
    }
    
    public function resetProcedureForm()
    {
        $this->dept = null;
        $this->actvits = null;
        $this->title = null;
        $this-> description = null;
        $this->repeat_time = null;
        $this->repeat_time_unit = null;
        $this->versionId = null;
        $this->approvedBy = null;
        $this->approvedDate = null;
        $this->approvedRef = null;
        $this->authority = null;
        $this->validTill = null;
        unset($this->fileref);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Reset form for SOP ID ');
    }

}
