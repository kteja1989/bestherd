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
use App\Models\Immunogen;

use App\Traits\Base;
use App\Traits\HerdFileUploadTrait;
use App\Traits\Fileupload;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageImmunogens extends Component
{
    use Base;
    use WithFileUploads;
    use HerdFileUploadTrait;
    
    public $immunogens, $immunogen_id = null;
    public $nameImngn, $codeImngn, $descImngn;
    public $postedBy, $status, $dateUpdated;

    //button display
    public $addNew = true, $edsop_id, $fileref=[];
    
    
    public function render()
    {
        if(Auth::user()->hasRole('herdmanager'))
        {
            $this->postedBy = Auth::user()->name;
            $depts = Department::where('department_id', 3)->get();
            $this->immunogens = Immunogen::where('department_id', 3)->get();
            //dd($sops);
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunogen Dashboad displayed ');
            return view('livewire.goats.manage-immunogens');
        }
    }
    
    public function addNewImmunogen()
    {
        $validatedData  = $this->validate(
        [   
            'nameImngn' => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'codeImngn' => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'descImngn' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
        ],
        [
            'nameImngn.required'  => 'Error: The :attribute is required.',
            'nameImngn.nameImngn' => 'Error: The :attribute must be letters, dash and underscore only.',

            'codeImngn.required'  => 'Error: The :attribute is required.',
            'codeImngn.codeImngn' => 'Error: The :attribute must be letters, dash and number only.',

            'descImngn.required'  => 'Error: The :attribute cannot be empty.',
            'descImngn.descImngn' => 'Error: The :attribute must be letters, dash and underscore only.',
        ],
        [ 
            'nameImngn' => 'Immunogen Name',
            'codeImngn' => 'Immunogen Code',
            'descImngn' => 'Description',
        ]);
        
        $nImmngn = new Immunogen();
        $nImmngn->department_id = 3;
        $nImmngn->name = $this->nameImngn;
        $nImmngn->code = $this->codeImngn;
        $nImmngn->description = $this->descImngn;
        $nImmngn->posted_by =  $this->postedBy;
        $nImmngn->status = 'active';
        //dd($nImmngn);
        $nImmngn->save();    
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Immunogen Added with ID '.$nImmngn->immunogen_id);
        $this->lwMessage = "New Immunogen Added";
        
        $this->resetImmunogenForm();
        $this->addNew = true;
        
    }
    
    public function editImngnData($immunogen_id)
    {
        $imngn = Immunogen::where('immunogen_id', $immunogen_id)->first();
       // dd($imngn);
        $this->immunogen_id = $immunogen_id;
        $this->nameImngn = $imngn->name;
        $this->codeImngn = $imngn->code;
        $this->descImngn = $imngn->description;
        $this->postedBy = $imngn->posted_by;
        $this->status = $imngn->status;
        $this->addNew = false;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Edit info Displayed for Immunogen ID '.$immunogen_id);
    }
    
    public function updateImngnData($immunogen_id)
    {
        
        $validatedData  = $this->validate(
        [   'nameImngn' => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'codeImngn' => 'required|string|regex:/^[A-Za-z0-9-_ ]+$/',
            'descImngn' => 'required|string|regex:/^[A-Za-z0-9-_,. ]+$/',
            'postedBy'  => 'required|string|regex:/^[A-Za-z0-9. ]+$/',
            'status'    => 'required|string|regex:/^[A-Za-z]+$/'
        ],
        [
            'nameImngn.required'  => 'Error: The :attribute must be selected.',
            'nameImngn.nameImngn' => 'Error: The :attribute must be letters, Numbers, dash and underscore only.',
            'codeImngn.required'  => 'Error: The :attribute must be selected.',
            'codeImngn.codeImngn' => 'Error: The :attribute must be letters, Numbers, dash and underscore only.',
            'descImngn.required'  => 'Error: The :attribute cannot be empty.',
            'descImngn.descImngn' => 'Error: The :attribute must be letters, Numbers, dash and underscore only.',
            'postedBy.postedBy'   => 'Error: The :attribute cannot be empty.',
            'postedBy.postedBy'   => 'Error: The :attribute must be letters, .',
            'status.required'     => 'Error: The :attribute cannot empty',
            'status.status'       => 'Error: The :attribute must a number only',
        ],
        [ 
            'nameImngn' => 'Immunogen Name',
            'codeImngn' => 'Immunogen Code',
            'descImngn' => 'Description',
            'postedBy'  => 'Posted By',
            'status'    => 'Status',
        ]);
        
        $input['name'] = $this->nameImngn;
        $input['code'] = $this->codeImngn;
        $input['description'] = $this->descImngn;
        $input['posted_by'] = $this->postedBy;
        $input['status'] = $this->status;

        $sopresult = Immunogen::where('immunogen_id', $immunogen_id)->update($input);
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Edited Data for Immunogen ID '.$immunogen_id);
        $this->lwMessage = "Immunogen Data Updated";
        
        $this->resetImmunogenForm();
        $this->addNew = true;
    }
    
    public function resetImmunogenForm()
    {
        $this->nameImngn = null;
        $this->codeImngn = null;
        $this->descImngn = null;
        $this->postedBy = null;
        $this->status = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Reset Immunogen data form ');
    }
    
    
    
}
