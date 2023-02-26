<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use App\Models\Species;
use App\Models\Acquiredanimals;
use App\Models\Department;

use App\Traits\Base;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class AnimalsAcquired extends Component
{
    use Base;
    
    //landing page variables
    public $animacquried, $depts, $dept;
    
    //form variables
    public $totalAcquired, $species, $species_acq, $sex, $dob, $acquiredDate, $supplierRef;
    
    public function render()
    {
        $this->species = Species::all();
        $this->depts = Department::all();
        $this->animacquried = Acquiredanimals::all();
        return view('livewire.goats.animals-acquired');
    }
    
    public function showAnimalAcqData()
    {
        $this->species = Species::all();
    }
    
    public function saveAnimalAcquisitionForm()
    {
        $newAcqAnim = new Acquiredanimals();
        
        $newAcqAnim->department = $this->dept;
        $newAcqAnim->total_acquired = $this->totalAcquired;
        $newAcqAnim->date_acquired = $this->acquiredDate;
        $newAcqAnim->species_id = $this->species_acq;
        $newAcqAnim->sex = $this->sex;
        $newAcqAnim->age = $this->monthsBetweenTwoDates($this->dob, date('Y-m-d'));
        $newAcqAnim->age_unit = "months";
        $newAcqAnim->supplier_code = $this->supplierRef;
        //dd($newAcqAnim);
        $newAcqAnim->save();
        
    }
    
    public function showAnimalAcqEditForm()
    {
        
    }
    
    public function updateAnimalAcqEditForm()
    {
        
    }
    
}
