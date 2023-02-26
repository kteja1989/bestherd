<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

//use App\Models\Project;
//use App\Models\Assent;
//use App\Models\User;

use App\Models\Exitedgoat;
use App\Models\Goat;
use App\Models\Herd;

use App\Traits\Base;
//use App\Traits\IssueRequest;
//use App\Traits\StrainConsumption;
//use App\Traits\ProjectStrainsById;
//use App\Traits\FormD;
//use App\Traits\costByProjectId;
//use App\Traits\ProjectQueries;
//use App\Traits\IssueRequestQueries;
use App\Traits\Fileupload;

use App\Traits\GoatManagementTrait;
use App\Traits\HerdDashboardTrait;

use Livewire\WithFileUploads;

use Validator;

use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageGoats extends Component
{
    use Base;
 //   use ProjectQueries;
	use GoatManagementTrait;
    use HerdDashboardTrait;

    public $allHerds;
    //dashboard variables
    public $agp, $agpfull, $agc, $goatArray=[];
    
    public $goat_exit, $newherd_id, $exit_remark;

    public $panelTitle;
    //variables
    public $gt2y, $gt3y, $gt4y, $gt5y, $gt6y, $gt7y, $gt8y, $gt9y, $gt10y;
    public $y0001, $y0102, $y0203,$y0304,$y0405,$y0506,$y0607,$y0708,$y0809,$y0910,$ygt10;
    
    //panels and buttons
    public $showDashButton = true;
    public $viewHerdInf = false;
    public $viewGoatProfile = false;
    public $exitFormMessage = null;
    
    public function render()
    {
      $result = $this->agedGoatCount();
      $this->agc = $result['agc'];
      $this->allHerds = Herd::all();
      return view('livewire.goats.manage-goats');
    }
    
    public function fetchOT00years($y0001)
    {
      $this->y0001 = $y0001;
      $this->panelTitle = "Age Band 0 - 1 years";
      $this->agpfull = $this->agedGoatsGT00years();
      $this->viewGoatProfile = true;
      //  dd("02-03 years age", $this->gt2y);
    }
    
    public function fetchOT01years($y0102)
    {
      $this->y0102 = $y0102;
      $this->panelTitle = "Age Band 1 - 2 years";
      $this->agpfull = $this->agedGoatsGT01years();
      $this->viewGoatProfile = true;
      //  dd("02-03 years age", $this->gt2y);
    }

    public function fetchOT02years($y0203)
    {
      $this->y0203 = $y0203;
      $this->panelTitle = "Age Band 2 - 3 years";
      $this->agpfull = $this->agedGoatsGT02years();
      $this->viewGoatProfile = true;
      //  dd("02-03 years age", $this->gt2y);
    }

    public function fetchOT03years($y0304)
    {
      $this->y0304 = $y0304;
      $this->panelTitle = "Age Band 3 - 4 years";
      $this->agpfull = $this->agedGoatsGT03years();
      $this->viewGoatProfile = true;
        //dd("03-04 years age", $this->gt3y);
    }

    public function fetchOT04years($y0405)
    {
      $this->panelTitle = "Age Band 4 - 5 years";
      $this->agpfull = $this->agedGoatsGT04years();
      $this->viewGoatProfile = true;
      //  dd("04-05 years age", $this->gt4y);
    }

    public function fetchOT05years($y0506)
    {
      $this->panelTitle = "Age Band 5 - 6 years";
      $this->agpfull = $this->agedGoatsGT05years();
      $this->viewGoatProfile = true;
      //  dd("05-06 years age", $this->gt5y);
    }

    public function fetchOT06years($y0607)
    {
      $this->panelTitle = "Age Band 6 - 7 years";
      $this->agpfull = $this->agedGoatsGT06years();
      $this->viewGoatProfile = true;
      //  dd("06-07 years age", $this->gt6y);
    }

    public function fetchOT07years($y0708)
    {
      $this->panelTitle = "Age Band 7 - 8 years";
      $this->agpfull = $this->agedGoatsGT07years();
      $this->viewGoatProfile = true;
      //  dd("07-08 years age", $this->gt7y);
    }

    public function fetchOT08years($y0809)
    {
      $this->panelTitle = "Age Band 8 - 9 years";
      $this->agpfull = $this->agedGoatsGT08years();
      $this->viewGoatProfile = true;
      //  dd("08-09 years age", $this->gt8y);
    }

    public function fetchOT09years($y0910)
    {
      $this->panelTitle = "Age Band 9 - 10 years";
      $this->agpfull = $this->agedGoatsGT09years();
      $this->viewGoatProfile = true;
      //  dd("09-10 years age", $this->gt9y);
    }

    public function fetchOT10years($ygt10)
    {
      $this->panelTitle = "Greater than 10 years";
      $this->agpfull = $this->agedGoatsGT10years();
      $this->viewGoatProfile = true;
      //  dd("> 10 years age", $this->gt10y);
    }
    
    public function processGoatProfile()
    {
        $this->exitFormMessage = null;
        //dd($this->goatArray);
        if( Auth::user()->hasAnyRole(['herdmanager']) ) 
        {
            
            
            $validatedData = $this->validate(
            [
                'goat_exit'   => 'required|string|regex:/^[A-Za-z-_ ]+$/',
                'exit_remark' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
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
                
            $this->exitFormMessage = null;
        
            $values =[
                        "newherd", 
                        "non_responder", 
                        "under_weight",
                        "vices",
                        "limb_deformities",
                        "nervous_disorder",
                        "dead", 
                        "retired", 
                        "unknownCI"
                        ];
            
            //remove all checked once but unchecked later
            $goatArray = array_filter($this->goatArray);
        
            if(!empty($goatArray))
            {
                
                if(in_array($this->goat_exit, $values))
                {
                   
                    foreach($goatArray as $key => $val)
                    {
                        $goat_id = intval($val);

                        //first make entry in the goat table, change status to
                        //reason assigned
                        $exGoat = Goat::where('goat_id', $goat_id)->first();
                        $origHerdId = $exGoat->herd_id;
                        
                        $goatExited = Goat::where('goat_id', $goat_id)->first()->toArray();
                        
                        if($this->goat_exit == $values[0] )
                        {
                            //first check the newherd id is present and valid
                            if($this->newherd_id != null)
                            {
                                //second check the gender of the goat of with the destination herd gender
                                $destGender = Herd::where('herd_id', intval($this->newherd_id))->value('gender');
                                $goatGender = Goat::where('goat_id', $goat_id)->value('gender');
            
                                if($goatGender === $destGender)
                                {
                                    $msg = "Moved from herd ".$origHerdId." to herd ".$this->newherd_id." on ".date("d-m-Y");
                                    $exGoat->herd_id = $this->newherd_id; //change the present herd id to new herd id
                                    $exGoat->status = 'active';
                                    $exGoat->remark = $exGoat->remark.";;;".$msg.";;;".$this->exit_remark;
                                    $exGoat->update();
            
                                    //next reduce the herd count by one.
                                    $hsize1  = Herd::where('herd_id', $origHerdId)->value('total_count');
                                    $result1 = Herd::where('herd_id', $origHerdId)->update(['total_count' => ($hsize1 - 1)]);
            
                                    //now increase the herd count of destination herd by one
                                    $hsize2 = Herd::where('herd_id', $this->newherd_id)->value('total_count');
                                    $result2 = Herd::where('herd_id', $this->newherd_id)->update(['total_count' => ($hsize2 + 1)]);
                                    
                                    //dd($exGoat, $origHerdId, $hsize1,  $this->newherd_id, $hsize2);
                                    
                                    //success closes the forms
                                    $this->exitFormMessage = "Goats Moved To Herd ".$this->newherd_id." Successfully";
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
                            //now make an entry in exitedgoats table and delete the entry in goat table.
                            
                            $goatExited['goat_id'] = $goat_id;
                            $goatExited['exit_age'] = $this->monthsBetweenTwoDates($exGoat->dob, date('Y-m-d'));
                            $goatExited['status'] = $this->goat_exit;
                            $goatExited['remark'] = $exGoat->remark.";;;".$this->exit_remark." on ".date("Y-m-d");
                            unset($goatExited['created_at']);
                            unset($goatExited['updated_at']);
                            $result = Exitedgoat::create($goatExited);
                            
                            // now delete the parent row.
                            $res = Goat::where('goat_id', $goat_id)->delete();
            
                            //next reduce the herd count by one.
                            $herdsize = intval(Herd::where('herd_id', $exGoat->herd_id)->value('total_count'));
                            $result = Herd::where('herd_id', $exGoat->herd_id)->update(['total_count' => $herdsize - 1]);
                            //success closes the forms
                            $this->exitFormMessage = "Exit of Goats Success";
                        }
                    
                    }
                
                }
                else {
                    $this->exitFormMessage = "Error: Select Exit Radio Button";
                }

            }
            else {
                $this->exitFormMessage = "Goat ID Not Checked";
            }    
            
            $this->goat_exit = [];
            $this->exit_remark = null;
                
        }
        else {
		    return view('livewire.permError');
	    }

    }

}
