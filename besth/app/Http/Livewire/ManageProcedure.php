<?php

namespace App\Http\Livewire;

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
use Validator;

class ManageProcedure extends Component
{
    public $title, $description, $versionId, $approvedBy, $approvedDate;
    public $approvedRef, $authority, $validTill, $lwMessage;
    public $departments, $dept, $actvits;
    
    public function render()
    {
        /*
        if(Auth::user()->hasAnyRole('pisg','pilg','piblg','pient','manager'))
        {
            $depts = Department::all();
            $activities = Activity::all();
            $procedures = Procedure::with('activits')->with('dept')->where('pi_id', Auth::id())->get();
            
            return view('livewire.manage-procedure')->with(['procedures'=>$procedures, 'activities'=>$activities, 'depts'=>$depts]);
        }
        */
        
        if(Auth::user()->hasRole('herdmanager'))
        {
            $depts = Department::all();
            $activities = Activity::all();
            //$procedures = Procedure::where('department_id', 3)->get();
            $procedures = Sop::with('activits')->where('department_id', 3)->get();
            //dd($procedures);
            return view('livewire.manage-procedure')->with(['procedures'=>$procedures, 'activities'=>$activities, 'depts'=>$depts]);
        }

    }

    public function addNew()
    {
        $validatedData     = $this->validate(
        [   'dept'         => 'required|alpha_dash',
            'actvits'         => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'title'        => 'required|string|regex:/^[A-Za-z0-9:-_. ]+$/',
            'description'  => 'required|string|regex:/^[A-Za-z0-9:-_. ]+$/',
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
            'versionId'    => 'Version Id',
            'approvedBy'   => 'Approved By',
            'approvedDate' => 'Approval Date',
            'approvedRef'  => 'Approval Reference',
            'authority'    => 'Authority',
            'validTill'    => 'Validity Date'
        ]);
          
        $procs = new Procedure();
        $procs->department_id = $this->dept;
        $procs->title = $this->title;
        $procs->description = $this-> description;
        $procs->version_id = $this->versionId;
        $procs->approved_by = $this->approvedBy;
        $procs->approved_date = $this->approvedDate;
        $procs->approved_reference = $this->approvedRef;
        $procs->approved_authority = $this->authority;
        $procs->validity_date =  $this->validTill;
        $procs->pi_id =  Auth::id();
        $procs->status = 'Active';
        $procs->save();
        $this->lwMessage = "New Protocol Added";
        
        $this->resetProcedureForm();
    }
    
    public function resetProcedureForm()
    {
        $this->dept = null;
        $this->actvits = null;
        $this->title = null;
        $this-> description = null;
        $this->versionId = null;
        $this->approvedBy = null;
        $this->approvedDate = null;
        $this->approvedRef = null;
        $this->authority = null;
        $this->validTill = null;
    }

}
