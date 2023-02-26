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

use App\Models\Activity;
use App\Models\Department;

use App\Traits\Base;
use Validator;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageActivities extends Component
{
    //form variables
    public $activit_name, $activit_desc, $activit_dept;
    
    //messages
    public $lwMessage=null;
    
    public function render()
    {
        if(Auth::user()->hasAnyRole('pisg','pilg','piblg','pient','manager','herdmanager'))
        {
            $depts = Department::all();
            $activities = Activity::with('user')->get();
            return view('livewire.goats.manage-activities')->with(['depts'=>$depts, 'activities' => $activities]);
        }
    }
    
    public function addNewActivity()
    {
        $act = new Activity();
        $act->activity = $this->activit_name;
        $act->description = $this->activit_desc;
        $act->created_by = Auth::id();
        //dd($act);
        $act->save();
        
        $this->resetActivityForm();
        $this->lwMessage = "New Activity Added";
    }
    
    public function resetActivityForm()
    {
        $this->activit_dept = null;
        $this->activit_name = null;
        $this->activit_desc = null;
    }
    
    public function deleteActivity($activity_id)
    {
        //dd($activity_id);
        $this->lwMessage = "Not Coded Yet";
    }
}
