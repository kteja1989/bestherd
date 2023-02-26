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

use App\Models\Herdefaults;

use App\Traits\Base;

use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HerdDefaults extends Component
{
    use Base;
    
    public $hdefs,$herdefault_id, $title, $description, $versionId, $approvedBy, $approvedDate;
    public $approvedRef, $authority, $validTill, $lwMessage;
    
    
    //form variables.
    public $def_desc, $def_value, $def_unit, $old_value, $created_by, $created_at, $updated_at;
   
   
    //panel opening
    public $editHerdDefault = false;
    
    public function render()
    {
        $this->hdefs = Herdefaults::all();
        return view('livewire.goats.herd-defaults')->with(['hdefs'=>$this->hdefs]);
    }
    
    public function addNewHerdDefault()
    {
        dd("reached");
    }
    
    public function updateHerdDefault($herdefault_id)
    {
        dd("reached 2 ");
    }
    
    public function editDefault($herdefault_id)
    {
        $this->editHerdDefault = true;
        $edefs = Herdefaults::where('herdefault_id', $herdefault_id)->first();
        
        $this->def_desc = $edefs->description;
        $this->def_value = $edefs->value;
        $this->def_unit = $edefs->unit;
        $this->created_by = $edefs->created_by;
        $this->created_at = $edefs->created_at;
        //dd($edefs);
        //dd("reached 33 ".$herdefault_id);
    }
}
