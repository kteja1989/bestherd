<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Species;
use App\Models\Acquiredanimals;
use App\Models\Department;
use App\Models\Receiver;
use App\Models\Supply;

use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class AnimalSupplies extends Component
{
    use Base;

    //landing page variables
    public $animSupplies, $species, $receivers, $dept;

    public $lwMessage;

    //form variables
    public $receiverId, $suppliedNotes, $IDsupplied,$totalSupplied,$femaleSupplied,$maleSupplied,$speciesSupplied;

    public function render()
    {
        $this->animSupplies = Supply::with('species')->get();
        $this->species = Species::all();
        $this->receivers = Receiver::all();
        return view('livewire.goats.animal-supplies');
    }

    public function saveSupplyInfo()
    {
        $this->lwMessage = null;
        $nSup = new SUpply();
        $nSup->species_id = $this->speciesSupplied;
        $nSup->male = $this->maleSupplied;
        $nSup->female = $this->femaleSupplied;
        $nSup->total_supplied = $this->totalSupplied;
        $nSup->ids = $this->IDsupplied;
        $nSup->notes = $this->suppliedNotes;
        $nSup->receiver_id = $this->receiverId;
        $nSup->authorized_by = Auth::user()->name;
        //Now determine whether the validy date is ok
        $valid_date = Receiver::where('receiver_id', $this->receiverId)->value('valid_date');

        if(strtotime($valid_date) >= strtotime(date('Y-m-d')))
        {
          $nSup->valid_date = $valid_date;
          $nSup->save();
          $this->resetSupplyForm();
        }
        else {
          $this->lwMessage = "Receiver's Validity Expired";
        }
    }

    public function resetSupplyForm()
    {
      $this->speciesSupplied = null;
      $this->maleSupplied = null;
      $this->femaleSupplied = null;
      $this->totalSupplied = null;
      $this->IDsupplied = null;
      $this->suppliedNotes = null;
      $this->receiverId = null;
    }
}
