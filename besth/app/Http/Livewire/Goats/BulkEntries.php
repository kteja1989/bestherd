<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Project;
use App\Models\Assent;
use App\Models\User;

//Models for herds

use App\Models\Goat;
use App\Models\Goatfile;
use App\Models\Goathealth;
use App\Models\Goatsera;
use App\Models\Health;
use App\Models\Herd;
use App\Models\Immunedgoats;
use App\Models\Immunization;
use App\Models\Serum;
use App\Models\Tempgoat;

use App\Traits\Base;
use Livewire\WithPagination;

use App\Traits\Fileupload;
use Livewire\WithFileUploads;
use Validator;
use App\Imports\GoatImport;
use App\Imports\GoathealthImport;

use Maatwebsite\Excel\Facades\Excel;
use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class BulkEntries extends Component
{
    use Base;
    
    use WithFileUploads;
    //use ProjectQueries;

    //comman variables
    public $user_name, $immunizations;

    //upload form variables
    public $sampleExcel, $sampleGHExcel;

    //message variables
    public $addBulkPostMessage;

    public $goatUploadError = false;
    public $goatUploadErrorMessage = null;

    public $goatUploadSuccess = false;
    public $goatUploadSuccessMessage = null;

    public $ghUploadError = false;
    public $ghUploadErrorMessage = null;

    public $ghUploadSuccess = false;
    public $ghUploadSuccessMessage = null;
    
    public $addHerdMessage = "none";
    
    //new entries table 
    public $goat_id, $upGoat_id, $downGoat_id, $newGoatDetails=[]; 
    public $nge = [], $bufileref = [], $bugoatImages=[];
    public $flag = [];
    //public $count, $badRows = [], $badRowCount, $errors;
    public $gerrors = [], $errows = [], $sucesup = [], $iteration;
    
    //panel openings
    public $viewGoatEntries = false;
    public $viewHealthEntries = false;

    public $pendingEntries;

    public $reply, $confirmDelete = false;
    
    public $minAge = 160, $maxAge = 570;
    
    //listeners
    protected $listeners = [
        'deleteTempgoatRows' => 'clearNewGoatEntries',
        'refreshComponent' => '$refresh'
    ];
    
    public function render()
    {
        //$this->newGoatDetails = Tempgoat::all();
        //$this->setNewGoatEntries($this->newGoatDetails);
        $this->newGoatDetails = Tempgoat::all();
        if(count($this->newGoatDetails) > 0)
        {
            $this->pendingEntries = true;
            //$this->setNewGoatEntries($this->newGoatDetails);
            //$this->viewGoatEntries = true;
        }
        return view('livewire.goats.bulk-entries');
    }
    
    //....... All modal pop-up here .......//
    public function modalConifrmModal()
    {
        $this->emit("openModal", 'confirm-modal',
                  ['message'=> "This action will delete all entries"]);
    }
    //....... End of modal pop-up here .......//

    public function downloadGoatEntryTemplate()
    {
        // get pis folder, modify the column
        $path = storage_path('templates/GoatImportTemplate.xlsx');
        $headers = array(
            'Content-Type: application/xls',
        );
        return response()->download($path);
    }

    // bulk posting of goat information
    public function processGoatBulkUpload()
    {
        $this->goatUploadError = false;
        $this->goatUploadSuccess = false;
        $this->ghUploadError = false;
        $this->ghUploadSuccess = false;
        //dd($this->sampleExcel);

        //$this->viewGoatEntries = true;
        //$this->newGoatDetails = Tempgoat::all();
        //dd($this->newGoatDetails = Tempgoat::all());
        //$qrgOld = Tempgoat::whereDate('created_at', date('Y-m-d'))->count();
        
        // we dont need the container id as it is going to be
        // entered through the sheet, just left the info for future use, if any.
        // now we need to invoke the excel object and retrieve the data.
        if($this->sampleExcel != null)
        {
            $allowedExtension = ['xls', 'xlsx'];
            //for testing, in reality, pass on the user's folder name fromm DB.
            //$piFolder = Auth::user()->folder;
            $piFolder = "demoherdman";
            $destPath = "public/institutions"."/".$piFolder."/";

            foreach ($this->sampleExcel as $key => $value)
            {
                $filename = $value->getClientOriginalName();
                $oExt = $value->getClientOriginalExtension();
                $check = in_array($oExt, $allowedExtension);

                if($check )
                {
                    $fileName = "";
                    $code8 = $this->generateCode(8);
                    $fileName = $code8."_".Auth::user()->id.".".$oExt;
                    $fxt[$key] = $value->storeAs($destPath, $fileName);
                    
                    $gImport = new GoatImport();
                    Excel::import($gImport, $destPath.$fileName);
                    
                    $this->gerrors[] = $gImport->errors;
                    $this->errows = $gImport->ermsg;
                    $this->sucesup = $gImport->upsuces;
                    
                    if($gImport->count > 0)
                    {
                        $this->goatUploadSuccessMessage = "Message: Import of ".$gImport->count." Members Successful";
                        $this->goatUploadSuccess = true;
                        $this->newGoatDetails = Tempgoat::all();
                        $this->setNewGoatEntries($this->newGoatDetails);
                        $this->viewGoatEntries = true;
                    }

                    $this->sampleExcel = [];
                    $this->iteration++;
                    
                    /*
                        //now show the latest entries from tempgoat db
                        if($this->goatUploadSuccess)
                        {
                            $this->setNewGoatEntries($this->newGoatDetails);
                            $this->viewGoatEntries = true;
                        }
                        else{
                            $this->goatUploadErrorMessage = "Message: Upload unsuccessful";
                            $this->goatUploadError = true;
                        }
                    */
                }
                else {
                    $this->goatUploadErrorMessage = "Message: File types must be xls or xlsx";
                    $this->goatUploadError = true;
                }
            }
        }
        else {
            $this->goatUploadErrorMessage = "Message: File Not Selected, select File";
            $this->goatUploadError = true;
        }
    }
    
    public function showPendingEntries()
    {
        $this->setNewGoatEntries($this->newGoatDetails);
        $this->viewGoatEntries = true;
    }
    
    public function setNewGoatEntries($newGoatDetails)
    {
        if(count($newGoatDetails) > 0 )
        {
            foreach($newGoatDetails as $key => $val)
            {
                $date1 = $val->dob;
                $days = $this->daysBetween($date1,  date('Y-m-d'));
                    
                if($days < $this->minAge || $days > $this->maxAge)
                {
                    $this->flag[$val->goat_id] = true;
                }
                else {
                    $this->flag[$val->goat_id] = false;
                }
                
                $this->nge[$val->goat_id][1] = $val->gender;
                $this->nge[$val->goat_id][2] = $val->genetic_background;
                $this->nge[$val->goat_id][3] = $val->dob;
                $this->nge[$val->goat_id][4] = $val->source;
                $this->nge[$val->goat_id][5] = $val->quarantine_start;
                $this->nge[$val->goat_id][6] = $val->quarantine_end;
                $this->nge[$val->goat_id][7] = $val->source_reference;
                $this->nge[$val->goat_id][8] = $val->remark;
                $this->nge[$val->goat_id][9] = $val->herd_id;
            }
        }
        else {
            $newGoatDetails = [];
        }
        //dd($this->flag);
    }
    
    public function processNewGoatEntries()
    {
        $count = 0;
        
        $validatedData = $this->validate( 
        [
            'nge.*.9'  => 'required|integer', //herd_id
            'nge.*.1'  => 'required|alpha',   //gender
            'nge.*.2'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/', // genetic background
            'nge.*.3'  => 'required|date',    // date of birth
            'nge.*.4'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/', 
            'nge.*.5'  => 'required|date|after:nge.*.3',  //quarantine start
            'nge.*.6'  => 'required|date|after:nge.*.5',  //quarantine end
            'nge.*.7'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
          //'nge.*.8'  => 'nullable|string|regex:/^[A-Za-z0-9_. ]+$/'
        ],
        [
            'nge.*.9.required' => 'The :attribute cannot be empty.',
            'nge.*.9.nge.*.9'  => 'The :attribute must be Letters and Dash only.',

            'nge.*.1.required' => 'The :attribute cannot be empty.',
            'nge.*.1.nge.*.1'  => 'The :attribute must be valid date.',
            
            'nge.*.2.required' => 'The :attribute cannot be empty.',
            'nge.*.2.nge.*.2'  => 'The :attribute must be Letters and Dash only.',

            'nge.*.3.required' => 'The :attribute cannot be empty.',
            'nge.*.3.nge.*.3'  => 'The :attribute must be valid date.',
            
            'nge.*.4.required' => 'The :attribute cannot be empty.',
            'nge.*.4.nge.*.4'  => 'The :attribute must be Letters and Dash only.',
            
            'nge.*.5.required' => 'The :attribute cannot be empty.',
            'nge.*.5.nge.*.5'  => 'The :attribute must be valid date.',
            
            'nge.*.6.required' => 'The :attribute cannot be empty.',
            'nge.*.6.nge.*.6'  => 'The :attribute must be valid date.',
           
            'nge.*.7.required' => 'The :attribute cannot be empty.',
            'nge.*.7.nge.*.7'  => 'The :attribute must be Letters and Dash only.',

          //'nge.*.8.nge.*.8'  => 'The :attribute must be valid date.',
        ],
        [
            'nge.*.9' => 'Herd ID',
            'nge.*.1' => 'Gender',
            'nge.*.2' => 'Genetic Background',
            'nge.*.3' => 'Date of Birth',
            'nge.*.4' => 'Source',
            'nge.*.5' => 'Quarantine Start',
            'nge.*.6' => 'Quarantine End',
            'nge.*.7' => 'Source Reference',
          //'nge.*.8' => 'Remark'
        ]);
        
        //dd($this->nge);
        
        //$key will give the tempgoat_id to be deleted
        foreach($this->nge as $key => $val)
        {
            // default import into quarantine only
            $hInfo = Herd::where('category', 'quarantine')->where('gender', $this->nge[$key][1])->first();
            $herd_id = $hInfo->herd_id;
            
            //check here whether capacity reached or not
            $totalSize = $hInfo->total_size;
             
            //increade herd count by each additon
            $totalCount = $hInfo->total_count;
            
            $diff = $totalSize - $totalCount;
            
            if($diff > 0)
            {
                //validate aga of the goat before entry
                $date1 = $this->nge[$key][3];
                $days = $this->daysBetween($date1,  date('Y-m-d'));
            
                if($days > $this->minAge && $days < $this->maxAge )
                {
                    // once clear make an entry
                    $newGoat = new Goat();
                    
                    $newGoat->herd_id = $herd_id;
                    $newGoat->dob = $this->nge[$key][3];
                    $newGoat->gender = $this->nge[$key][1];
                    $newGoat->age = $this->monthsBetweenTwoDates($this->nge[$key][3], date('Y-m-d'));
                    $newGoat->age_unit = "months";
                    $newGoat->source = $this->nge[$key][4];
                    $newGoat->genetic_background = $this->nge[$key][2];
                    $newGoat->source_reference = $this->nge[$key][7];
                    $newGoat->source_ref_file = "null";
                    $newGoat->quarantine_start = $this->nge[$key][5];
                    $newGoat->quarantine_end = $this->nge[$key][6];
                    $newGoat->inducted_date = date('Y-m-d');
                    $newGoat->status = 'active';
                    $newGoat->remark = null;
                    //dd($newGoat);
                    $result = $newGoat->save();
                    
                    if($result)
                    {
                        $result = Herd::where('herd_id', $herd_id)->update(['total_count' => ($totalCount + 1) ]);
                        $count = $count + 1;
                    }
                    
                    /*
                    //upload file here
                    if($this->buoatImages != null)
                    {
                        foreach ($this->goatImages as $key => $value)
                        {
                            $this->uploadGoatImages($newGoat->goat_id, $key, $value);
    
                        }//foreach loop
                    }// if statement
                    else {
                        $this->goatImgUploadSuccessMsg = "Message: Image File Not Selected, select File";
                        $this->goatUploadError = true;
                    }//end of image file upload

                    //upload file here
                    if($this->bufileref != null)
                    {
                        foreach ($this->bufileref as $key => $value)
                        {
                            $this->uploadFileRefs($newGoat->goat_id, $key, $value);
    
                        }//foreach loop
                    }// if statement
                    else {
                        $this->goatImgUploadSuccessMsg = "Message: Ref File Not Selected, select File";
                        $this->goatUploadError = true;
                    }//end of ref file upload
                    */
                    
                    //now dete the row in tempgoat db table
                    $result = Tempgoat::where('goat_id', $key)->delete();
                }
                else {
                    $this->goatUploadErrorMessage = "Message: Goat Age either < 160 days or > 570 days";
                    $this->goatUploadError = true;
                }
            
            }// if statement
            else {
                $this->goatImgUploadSuccessMsg = "Message: Total Entries Crossed Herd Capacity";
                $this->goatUploadError = true;
            }
        
        }//foreach loop
        
        //now show the message.
        if($count > 0)
        {
            $this->goatUploadSuccessMessage = "Message: Upload Successful: ".$count." Goats Added";
            $this->goatUploadSuccess = true;
            $this->viewGoatEntries = false;
        }
        else {
            $this->viewGoatEntries = true;
        }

    }
    
    /*
    public function deleteTempgoatRows()
    {
        dd("emitting correctly", $this->reply);
    }
    */
    
    public function clearNewGoatEntries()
    {
        $this->confirmDelete = true;
    }
    
    public function deleteConfirmed()
    {
        $result = Tempgoat::query()->truncate();
        if($result)
        {
            $this->goatUploadError = false;
            $this->goatUploadSuccess = false;
            $this->pendingEntries = false;
            $this->goatUploadSuccess = false;
            $this->viewGoatEntries = false;
            $this->confirmDelete = false;
        }
    }
    
    public function uploadGoatImages($goat_id, $key, $value)
    {
        $allowedExts = ['jpeg', 'jpg'];
        //for testing, in reality, pass on the user's folder name fromm DB.
        //$piFolder = Auth::user()->folder;
        $piFolder = "goatimages";
        $goatFolder = $goat_id;
        $destPath = "public/institutions"."/".$piFolder."/";

        $filename = $value->getClientOriginalName();
        $oExt = $value->getClientOriginalExtension();
        $check = in_array($oExt, $allowedExts);

        if($check)
        {
            $fileName = "";
            $code10 = $this->generateCode(10);
            $fileName = $code10."_".$goat_id.".".$oExt;
            $fxt[$key] = $value->storeAs($destPath, $fileName);
            
            //now store the filename in db Mugshot
            $nMugShot = new Mugshot();
            $nMugShot->goat_id = $goat_id;
            $nMugShot->user_id = Auth::user()->id;
            $nMugShot->user_name = Auth::user()->name;
            $nMugShot->date_uploaded = date('Y-m-d');
            $nMugShot->image = $fileName;
            $nMugShot->notes = "none";
            $nMugShot->save();

            $this->goatImgUploadSuccessMsg = "Message: Image Upload Successful";
            $this->goatUploadSuccess = true;

            $this->goatImages = null;
        }// if statement
        else {
            $this->goatImgUploadSuccessMsg = "Message: File types must be jpeg or jpg";
            $this->goatUploadError = true;
        }
    }
    
    
    public function uploadFileRefs($goat_id, $key, $value)
    {
        $allowedExts = ['pdf'];
        //for testing, in reality, pass on the user's folder name fromm DB.
        //$piFolder = Auth::user()->folder;
        $year = date('Y');
        $piFolder = "goatfiles"."/".$year;
        $goatFolder = $goat_id;
        $destPath = "public/institutions"."/".$piFolder."/";
        
        $filename = $value->getClientOriginalName();
        $oExt = $value->getClientOriginalExtension();
        $check = in_array($oExt, $allowedExts);
        
        if($check)
        {
            $fileName = "";
            $code15 = $this->generateCode(15);
            $fileName = $code15."_".$goat_id.".".$oExt;
            $fxt[$key] = $value->storeAs($destPath, $fileName);
            
            //now store the filename in db Mugshot
            $nGtFile = new Goatfile();
            $nGtFile->goat_id = $goat_id;
            $nGtFile->user_id = Auth::user()->id;
            $nGtFile->user_name = Auth::user()->name;
            $nGtFile->date_uploaded = date('Y-m-d');
            $nGtFile->filepath = $destPath;
            $nGtFile->filename = $fileName;
            $nGtFile->notes = "none";
            $nGtFile->save();

            $this->goatImgUploadSuccessMsg = "Message: Image Upload Successful";
            $this->goatUploadSuccess = true;

            $this->goatImages = null;
        }// if statement
        else {
            $this->goatImgUploadSuccessMsg = "Message: File types must be jpeg or jpg";
            $this->goatUploadError = true;
        }
    }



///////////////////////////////////////////////////////////////////////////////////////////
    //////////// goat health parameter entries ////////////////
    public function downloadGoatHealthEntryTemplate()
    {
        // get pis folder, modify the column
        $path = storage_path('templates/GoatHealthDataImportTemplate.xlsx');
        $headers = array(
            'Content-Type: application/xls',
        );
        return response()->download($path);
    }
    
    // bulk posting of goat information
    public function processBulkHealthParamUpload()
    {
        $this->ghUploadError = false;
        $this->ghUploadSuccess = false;
        $this->goatUploadError = false;
        $this->goatUploadSuccess = false;
        //dd($this->sampleExcel);
        // we dont need the container id as it is going to be
        //entered through the sheet, just left the info for future use, if any.
        //now we need to invoke the excel object and retrieve the data.
        if($this->sampleGHExcel != null)
        {
            $allowedExtension = ['xls', 'xlsx'];
            //for testing, in reality, pass on the user's folder name fromm DB.
            //$piFolder = Auth::user()->folder;
            $piFolder = "demoherdman";
            $destPath = "public/institutions"."/".$piFolder."/";

            foreach ($this->sampleGHExcel as $key => $value)
            {
                $filename = $value->getClientOriginalName();
                $oExt = $value->getClientOriginalExtension();
                $check = in_array($oExt, $allowedExtension);
                if($check )
                {
                    $fileName = "";
                    $code8 = $this->generateCode(8);
                    $fileName = $code8."_".Auth::user()->id.".".$oExt;
                    $fxt[$key] = $value->storeAs($destPath, $fileName);
                    $result = Excel::import(new GoathealthImport, $destPath.$fileName);
                    $qr = Goathealth::where('date_observed', date('Y-m-d'))->count();
                    $this->ghUploadSuccessMessage = "Message: Import of ".$qr." Health Records Successful";
                    $this->ghUploadSuccess = true;
                    $this->sampleGHExcel = null;
                }
                else {
                    $this->ghUploadErrorMessage = "Message: File types must be xls or xlsx";
                    $this->ghUploadError = true;
                }
            }
        }
        else {
            $this->ghUploadErrorMessage = "Message: File Not Selected, select File";
            $this->ghUploadError = true;
        }
    }

}
