<?php

namespace App\Http\Livewire\Goats;

//extends
use Livewire\Component;

// frame work
use File;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

//Models for herds
use App\Models\Adjuvant;
use App\Models\Assent;
use App\Models\Feed;
use App\Models\Goat;
use App\Models\Goathealth;
use App\Models\Goatsera;
use App\Models\Goattiter;
use App\Models\Health;
use App\Models\Herd;
use App\Models\Immunedgoats;
use App\Models\Immunization;
use App\Models\Mugshot;
use App\Models\Procedure;
use App\Models\Project;
use App\Models\Serum;
use App\Models\User;

//Traits
use App\Traits\Base;
use App\Traits\Fileupload;
use App\Traits\ProjectQueries;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class SearchHerds extends Component
{
    use Base;

    public $scanGoatId, $goat_id, $goatDetails, $goatHealthInfos, $imm_infom, $seraGoat, $healthGoat;
    public $newherd_id;
    
    public $goat_exit, $exit_remark;
    public $herdInfo, $allHerds;
    
    //form search variables
    public $scanError = null, $immScanError = null, $healthScanError = null;
    public $immMessage = null, $healthMessage = null;
    
    //modal variables
    public $herd_id;

    // health form search
    public $scanHealthInfo;
    
    //panel openings
    public $viewSearchGoatForm = false;
    public $showDashButton = false;
    public $viewGoatInfo = false;
    public $viewSingleGoatInfo = false;
    public $exitFormMessage = null;
    public $showImmSearchForm = false;
    public $showHealthSearchForm = false;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdasstserum','herdvet']) )
        {
            return view('livewire.goats.search-herds');
        }
        else {
            return view('livewire.permError');
        }
        
    }
    
    public function viewHerdSearchForm()
    {
        $this->scanError = "Not Open yet";
        $this->viewSearchGoatForm = true;
        //dd("reached search form");
    }
    
    public function viewGoatSearchForm()
    {
        $this->scanError = null;
        //dd("reached search form");
        $this->showImmSearchForm = false;
        $this->viewSingleGoatInfo = false;
        $this->showHealthSearchForm = false;
        $this->viewSearchGoatForm = true;
    }
    
    public function updatedScanGoatId()
    {
        $this->scanError = null;
        $this->viewSingleGoatInfo = false;

        $validatedData = $this->validate(
        [   
            'scanGoatId'    => 'numeric|regex:/^[0-9 ]+$/',
        ],
        [
            'scanGoatId.scanGoatId' => 'The :attribute must be Number only.',
        ],
        [
            'scanGoatId' => 'Goat Id'
        ]);

        if( $this->scanGoatId != null)
        {
            $result = Goat::where('goat_id', ltrim($this->scanGoatId, '0'))->first();
            
            if($result)
            {
                $this->viewGoatDetails(ltrim($this->scanGoatId, '0'));
            }
            else {
                $this->scanError = "Goat Id Not Found";
            }

        }
    }
    
    //individual goat information
    public function viewGoatDetails($goat_id)
    {
        $this->scanError = null;
        $this->scanGoatId = null;

        $this->viewGoatInfo = false;
        
        $this->allHerds = Herd::all();
        $this->goat_id = $goat_id;
        $this->goatDetails = Goat::where('goat_id', $goat_id)->first();
        $this->herdInfo = Herd::where('herd_id', $this->goatDetails->herd_id)->get();

        if($this->goatDetails != null)
        {
            $this->goatDetails->age = $this->monthsBetweenTwoDates($this->goatDetails->dob, date('Y-m-d'));
            $this->goatHealthInfos = Goathealth::with('sops')->where('goat_id', $goat_id)->get();
            $this->imm_info = Immunedgoats::with('immunztion')->where('goat_id', $goat_id)->get();
            $this->seraGoat = Goatsera::with('serum')->where('goat_id', $goat_id)->get();
            $this->goatImgs = Mugshot::where('goat_id', $goat_id)->get();
            $this->goatTiterVal = Goattiter::with('titer')->where('goat_id', $goat_id)->get();
            $this->viewSingleGoatInfo = true;
        }
        else {
            $this->scanError = "Goat Id Not Found";
        }

    }
    
    public function modalImmInfo($immunization_id)
    {
        $result = Immunization::where('immunization_id', $immunization_id)->first('herd_id');
        
        $this->herd_id = intval($result->herd_id);
        //dd($this->herd_id);
        $this->emit("openModal", 'show-immunizations',
                  ["immunization_id" => $immunization_id, 
                  'herd_id' => $this->herd_id, 
                  'goat_id'=>$this->goat_id]);
    }
    
    public function modalSerumInfo($serum_id)
    {
        $result = Serum::where('serum_id', $serum_id)->first('herd_id');
        
        $this->herd_id = intval($result->herd_id);
        
        $this->emit("openModal", 'plasma-details',
                  ["serum_id" => $serum_id,
                  'herd_id' => $this->herd_id,
                  'goat_id'=>$this->goat_id]);
    }
    
    public function viewImmSearchForm()
    {
        $this->scanError = "Not Open yet";
        $this->viewSearchGoatForm = true;
    }
    
    public function viewPlasmaSearchForm()
    {
        $this->scanError = "Not Open yet";
        $this->viewSearchGoatForm = true;
    }
    
    public function viewHealthSearchForm()
    {
        $this->scanError = "Not Open yet";
        $this->viewSearchGoatForm = true;
    }
    
    public function saveExitDetails($goat_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //$this->viewImmInf = false;
            $this->goat_id = $goat_id;
            $this->exitFormMessage = null;

            $validatedData = $this->validate(
            [
                'goat_exit'   => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                'exit_remark' => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
            ],
            [
                'goat_exit.required'      => 'Error: The :attribute Radio Button not checked.',
                'goat_exit.goat_exit'     => 'Error: The :attribute must be letters only.',
                'exit_remark.required'    => 'Error: The :attribute cannot be empty.',
                'exit_remark.exit_remark' => 'Error: The :attribute must be letters only.',
            ],
            [
                'goat_exit'   => 'Goat Exit',
                'exit_remark' => 'Exit Reason',
            ]);
            
            $newHerd = "newherd";
            
            //first make entry in the goat table, change status to
            //reason assigned
            $exGoat = Goat::where('goat_id', $goat_id)->first();

            if($this->goat_exit == $newHerd )
            {
                //first check the newherd id is present and valid
                if($this->newherd_id != null)
                {
                    //second check the gender of the goat of with the destination herd gender
                    $destGender = Herd::where('herd_id', intval($this->newherd_id))->value('gender');
                    $goatGender = Goat::where('goat_id', $goat_id)->value('gender');

                    if($goatGender === $destGender)
                    {
                        $exGoat->herd_id = $this->newherd_id; //change the present herd id to new herd id
                        $exGoat->status = 'active';
                        $exGoat->remark = $this->exit_remark;
                        $exGoat->update();

                        //next reduce the herd count by one.
                        $herdsize1 = intval(Herd::where('herd_id', $this->herd_id)->value('total_count'));
                        $result = Herd::where('herd_id', $this->herd_id)->update(['total_count' => $herdsize1 - 1]);

                        //now increase the herd count of destination herd by one
                        $herdsize2 = intval(Herd::where('herd_id', $this->newherd_id)->value('total_count'));
                        $result2 = Herd::where('herd_id', $this->newherd_id)->update(['total_count' => $herdsize2 + 1]);
                        $this->viewSingleGoatInfo = false;
                        $this->exitFormMessage = null;
                    }
                    else {
                        $this->exitFormMessage = "Error: Goat Gender and Destination Herd Gender Mismatch";
                    }
                }
                else {
                    $this->exitFormMessage = "Error: Must Select Destination Herd";
                }
            }
            else {
                $exGoat->status = $this->goat_exit;
                $exGoat->remark = $this->exit_remark;
                $exGoat->update();

                //next reduce the herd count by one.
                $herdsize = intval(Herd::where('herd_id', $this->herd_id)->value('total_count'));
                $result = Herd::where('herd_id', $herd_id)->update(['total_count' => $herdsize - 1]);
                $this->viewSingleGoatInfo = false;
                $this->exitFormMessage = null;
            }
            //success closes the forms
            
        }
        else {
		        return view('livewire.permError');
	    }
    }
}
