<?php

namespace App\Http\Livewire\Goats;

// extends
use Livewire\Component;

// framework
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

// models
use App\Models\Acquiredanimals;
use App\Models\Department;
use App\Models\Receiver;
use App\Models\Species;

// traits
use App\Traits\Base;
use App\Traits\HerdFileUploadTrait;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class AnimalReceivers extends Component
{
    use Base;
    use HerdFileUploadTrait;
    
    //landing page variables
    public $animalReceivers;
    
    //form variables
    public $recevName, $recevAddress, $validDate, $recevRegis, $recevRegisFile;
    public $fileref=[];
    
    public function render()
    {
        $this->animalReceivers = Receiver::all();
        return view('livewire.goats.animal-receivers');
    }

    public function saveAnimalReceiverInfo()
    {
        $nRec = new Receiver();
        $nRec->name = $this->recevName;
        $nRec->address = $this->recevAddress;
        $nRec->registration_detail = $this->recevRegis;
        $nRec->valid_date = $this->validDate;
        $nRec->regis_file = $this->recevRegisFile;
        $nRec->posted_by = Auth::user()->name;
      
        //upload file here
        if($this->fileref != null)
        {
            $filetype = "docs";
            $result = $this->uploadHerdFiles(3, $filetype, $this->fileref);
        }
        //end of file upload
        
        //dd($nRec);
        $nRec->save();
        $this->resetRecFormInfo();
    }

    public function resetRecFormInfo()
    {
        $this->recevName = null;
        $this->recevAddress = null;
        $this->recevRegis = null;
        $this->validDate = null;
        $this->recevRegisFile = null;
        $this->fileref = null;
    }
    
}
