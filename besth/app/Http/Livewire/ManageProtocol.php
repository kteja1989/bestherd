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
use App\Models\Protocol;
use App\Models\Assent;
use App\Models\User;
use App\Models\Department;

use App\Traits\Base;
use Validator;

class ManageProtocol extends Component
{
    public $title, $description, $versionId, $approvedBy, $approvedDate;
    public $approvedRef, $authority, $validTill, $lwMessage;
    public $departments, $dept;
    
    public function render()
    {
        if(Auth::user()->hasAnyRole('pisg','pilg','piblg','pient','manager','herdmanager'))
        {
            $depts = Department::all();
            $protocols = Protocol::where('pi_id', Auth::id())->get();

            return view('livewire.manage-protocol')->with(['protocols'=>$protocols, 'depts'=>$depts]);
        }

    }

    public function addNew()
    {
        $proto = new Protocol();
        $proto->department_id = $this->dept;
        $proto->title = $this->title;
        $proto->description = $this-> description;
        $proto->version_id = $this->versionId;
        $proto->approved_by = $this->approvedBy;
        $proto->approved_date = $this->approvedDate;
        $proto->approved_reference = $this->approvedRef;
        $proto->approved_authority = $this->authority;
        $proto->validity_date =  $this->validTill;
        $proto->pi_id =  Auth::id();
        $proto->status = 'Active';
        $proto->save();
        $this->lwMessage = "New Protocol Added";
    }

}
