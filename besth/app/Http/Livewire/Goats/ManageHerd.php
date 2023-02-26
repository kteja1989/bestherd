<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

//framework inclusions
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

//Models for herds project side
//use App\Models\Assent;
use App\Models\Event;
use App\Models\Feed;
//use App\Models\Project;
use App\Models\Sop;
use App\Models\User;

//Models for herds
use App\Models\Adjuvant;
use App\Models\Exitedgoat;
use App\Models\Goat;
use App\Models\Goatfile;
use App\Models\Goathealth;
use App\Models\Goatsera;
use App\Models\Goattiter;
use App\Models\Health;
use App\Models\Herd;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Mugshot;
use App\Models\Serum;
use App\Models\Titer;

// Traits used
use App\Traits\Base;
use App\Traits\CreateEditHerdTrait;
use App\Traits\ProjectQueries;
use App\Traits\HerdDashboardTrait;
use App\Traits\HerdFileUploadTrait;

use Livewire\WithPagination;

use App\Traits\Fileupload;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use File;

use App\Http\Livewire\Goats\HealthGraphs;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class ManageHerd extends Component
{
    use Base;
    use CreateEditHerdTrait;
 //   use ProjectQueries;
    use HerdDashboardTrait;
    use WithFileUploads;
    use HerdFileUploadTrait;
    
    //listeners
    protected $listeners = [
        'displayGoatGraph' => 'passToHealthGraph',
        'refreshComponent' => '$refresh'
    ];
    
    //comman variables
    public $user_name;

    //message variables
    public $addHerdMessage;
    public $messagesForm;
    public $messagesHerdMemberForm;
    public $exitFormMessage=null;
    public $scanError = null, $scanError2 = null;
    public $herdSizeMessage = false;
    
    //herd landing page variables
    public $herd_location, $herd_desc, $herd_size, $herd_category, $herd_gender, $herd_incharge;

    public $herd_id, $herdInfo, $editHerd, $herds, $editherd_desc, $editherd_location, $editTotalSize;
    public $editnewherdsize, $editherd_gender, $editherd_color;
    public $editherd_incharge, $editherd_status, $herd_total_count, $herdCategory, $herdColor;
    public $immunEntries = false, $immunizations, $herdFeeds, $feed_id, $scanGoatId, $category;
    public $editHerdMessage, $editherd_notes, $total_herd_size, $editHerdFeeds, $editfeed_id;
    public $immFitness6 = "pass", $serumFitness5 = "pass";

    //herd memeber addition variables
    public $hmem_herdId, $hmem_DoB, $hmem_genback, $hmem_source, $hmem_sourceref, $hmem_sourcefile;
    public $hmem_gender, $hmem_quarstart, $hmem_quarend, $hmem_inducton, $hmem_remarks, $hmem_multiple;
    public $newherd_id, $allHerds, $goatIdx;

    //radio selection for serum titer
    public $serumTiterRadio;

    //titer value entry
    public $titervalue = [];
    public $titersop_id, $titerserum_id, $titer_ref, $titerdone_by, $titer_date;
    public $titerauth_by, $titerErrorMessage, $titer_notes, $goatTiterVal; 
    
    //immunization variables
    public $adjuvants;
    public $imsop_id,$imsop2_id, $imngen_code, $imadjuvent_code, $imsample_desc,$sample_volume,$sampbatch_id;
    public $sample_source,$supplied_by,$sample_ref,$auth_by,$source_desc,$source_ref,$remark;
    public $immunoge_volume, $immunogen_site, $immunogen_route;
    public $imfreqnumber, $imfrequnit, $goatCount;
    public $idsDone, $remaining, $remainingGoats;
    public $scanGoatId2, $scannedGoatIds, $gis=[], $immunizeAll, $latestImmEntry;
    public $immErrorMsg = null;
    
    //goats information
    public $goats, $viewGoatList = false, $goatDetails=true,  $fullGoatDetail;
    public $imm_info, $seraGoat;
    
    //goathealth parameters graphs
    public $singleGoatHealthParams;

    //health of goats variables
    public $healthGoat=[], $goatNum, $imsop3_id;
    Public $healthsop_id, $sch_code, $physical_inspection, $health_notes;
    public $diagnosis, $suggestions, $healthremark, $healthlegend;
    public $gidArray, $goatHealthInfos, $healthsop2_id, $morning, $evening;

    //goat exit form variables
    public $goat_exit, $exit_remark;

    //serum variables
    public $selectedGoats = [], $serumCollected = [], $serumvolume=[];
    public $serproc_id, $serbatch_id, $seruser_name, $sernotes, $serumErrorMessage;

    //serum collection
   // public $serumDate, $batch_id, $notes, $sopids;
   // public $volumeGoat = 20, $sop_id, $procedure_id, $anotherField;
    
    //health parameter variables
    public $health=[], $healthx=[], $health_hb=[], $health_weight=[], $health_temp=[], $health_resprate=[], $health_rumcont=[];

    public $hb, $weight, $temp=[], $mm=[], $rr=[], $rc=[], $rbc=[], $platelet=[], $pcv=[], $lft=[], $kft=[], $rtpcr=[];
    public $messagex;

    public $dobmsg, $quarmsg;
    
    //public panels variables
    public $showDashButton = false;
    public $dashInfo = true;
    public $showNewHerdForm = false;
    public $showAddMemberForm = false;

    public $viewHerdInf = false;
    public $viewSingleGoatInfo = false;
    public $viewEditHerdForm = false;
    public $viewImmInf = false;
    public $viewSerumForm = false;
    
    public $viewSerumPanel = false;
    public $viewTiterPanel = false;
     
    public $viewHealthForm = false;
    public $hideScanField = true;
    
    public $viewImmHCFailDeatils = false;
    public $viewSerumHCFailDeatils = false;

    //green lights and exceptions
    public $immGreenLight = false;
    public $immGreenLightMessage;
    public $plasmaGreenLight = false;
    public $plasmaGreenLightMessage;
    
    //green signal messages
    public $failMsg;
    
    //goat image variables
    public $goatImgUploadSuccessMsg;
    public $goatUploadSuccess = false;
    public $goatImages=[], $goatImages2=[], $fileref=[], $goatImgs;
    public $title;
    
    //health modal variables
    public $herdHealth, $goatHealth;
    
    public function passToHealthGraph()
    {
       $this->dispatchBrowserEvent('drawGraph', ['assets'=> "working ddd"]);
    }   

    public function render()
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdasstserum','herdvet']) )
        {
            $this->immunizations = Immunization::all();
            $this->herds = Herd::all();
            $this->hideCreateHerdButton = false;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] herd dashboard displayed');
            return view('livewire.goats.manage-herd');
        }
        else {
            return view('livewire.permError');
        }
    }
    
    //....... All Dashboard info .......//
    public function showMainDashInfo()
    {
        $this->viewEditHerdForm = false;
        $this->showNewHerdForm = false;
        $this->showDashButton = false;
        $this->viewEditHerdForm = false;
        $this->viewHerdInf = false;
        $this->viewSingleGoatInfo = false;
        $this->immunEntries = false;
        $this->viewImmInf = false;
        $this->viewSerumForm = false;
        $this->viewHealthForm = false;
        
        $this->viewImmHCFailDeatils = false;
        $this->viewSerumHCFailDeatils = false;
        
        $this->dashInfo = true;
    }
    //....... End of Dashboard info .......//
    
    //....... All modal pop-up here .......//
    public function modalImmInfo($immunization_id)
    {
      $this->emit("openModal", 'show-immunizations',
                  ["immunization_id" => $immunization_id, 
                  'herd_id' => $this->herd_id, 
                  'goat_id'=>$this->goat_id]);
    }
    
    public function modalSerumInfo($serum_id)
    {
      $this->emit("openModal", 'plasma-details',
                  ["serum_id" => $serum_id,
                  'herd_id' => $this->herd_id,
                  'goat_id'=>$this->goat_id]);
    }
    
    public function modalGoatImage($image_id)
    {
      $this->emit("openModal", 'goat-image',
                  ['image_id'=>$image_id]);
    }
    
    public function modalHealthInfo($goat_id)
    {
     // $this->goatHealth = Goathealth::with('sops')->where('goat_id', $this->goat_id)->get(); 
     // $this->herdHealth = Health::with('sops')
     //                     ->where('herd_id', $this->herd_id)
     //                     ->latest('inspected_on')->first();
      //dd($this->herdHealth);
      $this->emit("openModal", 'health-modal',
                  ['goat_id'=> $this->goat_id,
                   'herd_id'=> $this->herd_id,
                  // 'goatHealth' => $this->goatHealth,
      //             'herdHealth' => $this->herdHealth
                   ]);
    }
    //....... End of modal pop-up here .......//
    
    
    public function updatedEditnewherdsize()
    {
        if($this->editnewherdsize < $this->herd_total_count)
        {
          $this->editnewherdsize = $this->herd_total_count;
          $this->herdSizeMessage = true;
        }
        else {
          $this->herdSizeMessage = false;
        }
    }


    // new herd form //////////////////////////
    public function viewNewHerdForm()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            $this->showDashButton = true;
            $this->dashInfo = false;
            $this->herdFeeds = Feed::where('species_id', 5)->get();

            $this->viewHerdInf = false;
            $this->viewImmInf = false;
            $this->viewHealthForm = false;
            $this->showAddMemberForm = false;
            $this->viewEditHerdForm = false;
            
            $this->viewImmHCFailDeatils = false;
            $this->viewSerumHCFailDeatils = false;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Herd Form displayed');
            $this->showNewHerdForm = true;
            $this->resetHerdForm();
            //$this->herd_size = 100;
        }
        else {
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Permission Error for New Herd Form');
            return view('livewire.permError');
        }
    }


    public function saveNewHerdInfo()
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            //-- the below block of code can be removed and activate line below. --//
            $validatedData = $this->validate(
            [   'herdColor'      => 'required|alpha',
                'herd_gender'    => 'required|alpha',
                'herd_category'  => 'required|alpha',
                'herd_size'      => 'required|integer',
                'herd_desc'      => 'required|regex:/^[A-Za-z0-9-_. ]+$/',
                'herd_location'  => 'required|regex:/^[A-Za-z0-9-_. ]+$/',
                'herd_incharge'  => 'required|regex:/^[A-Za-z. ]+$/',
                'feed_id'        => 'required|regex:/^[A-Za-z0-9-_. ]+$/'
            ],
            [
                'herdColor.required'            => 'Alert: The :attribute cannot be empty.',
                'herdColor.herdColor'           => 'Alert: The :attribute must be letters only.',
                'herd_category.required'        => 'Alert: The :attribute cannot be empty.',
                'herd_category.herd_category'   => 'Alert: The :attribute must be letters only.',
                'herd_gender.required'          => 'Alert: The :attribute cannot be empty.',
                'herd_gender.herd_gender'       => 'Alert: The :attribute must be letters only.',
                'herd_size.required'            => 'Alert: The :attribute cannot be empty.',
                'herd_size.integer'             => 'Alert: The :attribute must be Numbers only, no fractions.',
                
                'herd_desc.required'            => 'Alert: The :attribute cannot be empty.',
                'herd_desc.regex'               => 'Alert: The :attribute must be Letters, Dash & Underscore only.',
                
                'herd_location.required'        => 'Alert: The :attribute cannot be empty.',
                'herd_location.regex'           => 'Alert: The :attribute must be Letters and Dash only.',
                'herd_incharge.required'        => 'Alert: The :attribute cannot be empty.',
                'herd_incharge.regex'           => 'Alert: The :attribute must be Letters and Dash only.',
                'feed_id.required'              => 'Alert: The :attribute cannot be empty.',
                'feed_id.regex'                 => 'Alert: The :attribute must be Letters and Dash only.',
            ],
            [
                'herdColor'     => 'Herd Color',
                'herd_category' => 'Herd Category',
                'herd_gender'   => 'Herd Gender',
                'herd_size'     => 'Herd Size',
                'herd_desc'     => 'Herd Description',
                'herd_location' => 'Herd Location',
                'herd_incharge' => 'Herd In-Charge',
                'feed_id'       => 'Feed'
            ]);

            $addHerd = new Herd();
            $addHerd->category = $this->herd_category;
            $addHerd->color = $this->herdColor;
            $addHerd->description = $this->herd_desc;
            $addHerd->location = $this->herd_location;
            $addHerd->total_size = $this->herd_size;
            $addHerd->total_count = 0;
            $addHerd->gender = $this->herd_gender;
            $addHerd->feed_description = $this->feed_id;
            $addHerd->incharge_name = $this->herd_incharge;
            $addHerd->status = 'active';
            //dd($addHerd);
            $addHerd->save();
            //-- the above block of code can be removed and activate line below. --//
            
            //-- Every thing done by the trait CreatEditHerdTrait           --//
            //$result = $this->makeNewHerdEntry();
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Herd Data Saved');
            $this->resetHerdForm();
            $this->showDashButton = false;
            $this->dashInfo = true;
            $this->showNewHerdForm = false;
        }
		else {
		    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Permission Error for Saving New Herd Data');
		    return view('livewire.permError');
		}
    }
    ////////////////////////////////////////////
    //ideally allowed to change info of
    //herds that were not immunized. Once
    //immunization done, base information
    // such as description, and gender
    //should not be changed.

    public function editHerdInfo($herd_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            $this->showDashButton = true;
            $this->dashInfo = false;
            
            $this->viewEditHerdForm = false;
            $this->viewSingleGoatInfo = false;
            $this->viewImmInf = false;
            $this->viewHerdInf = false;
            $this->viewSerumForm = false;
            $this->showAddMemberForm = false;
            $this->viewHealthForm = false;
            
            $this->viewImmHCFailDeatils = false;
            $this->viewSerumHCFailDeatils = false;
            
            //implement here for whether allowed
            //to change base information or //
            $result = Immunization::where('herd_id', $herd_id)->get();
            $this->goatCount = Goat::where('herd_id', $herd_id)->count();
            
            If($result->count() > 0 || $this->goatCount > 0)
            {
                $this->immunEntries = false;
            }
            else{
                $this->immunEntries = true;
            }
            
            $this->herd_id = $herd_id;
            $this->editHerdFeeds = Feed::all();
            $editHerd = Herd::where('herd_id', $herd_id)->first();
            $goatsHerd = Goat::where('herd_id', $herd_id)->get();
            $this->total_herd_size = $editHerd->total_size;
            $this->herd_total_count = $goatsHerd->count();
            $this->editherd_desc = $editHerd->description;
            $this->editherd_color = ucfirst($editHerd->color);
            $this->editherd_location = $editHerd->location;
            $this->editnewherdsize = $editHerd->total_size;
            $this->editherd_gender = $editHerd->gender;
            $this->editherd_incharge = $editHerd->incharge_name;
            $this->editherd_status = $editHerd->status;
            $this->editfeed_id = $editHerd->feed_description;
            //dd("herd",$this->editHerd);
            $this->viewEditHerdForm = true;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Herd Data Displayed for Editing');
        }
        else {
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Permission Error for Editing Herd Data');
            return view('livewire.permError');
        }
    }

    public function updateHerdInfo($herd_id)
    {
        // if herd has goats, status must be active,
        //give message that empty or exits goats first.
        //dd($herd_id);
        
        $validatedData = $this->validate(
        [   
            'editherd_color'      => 'sometimes|alpha',
            'editherd_gender'     => 'sometimes|alpha',
          //'editherd_category'   => 'sometimes|alpha',
            'editnewherdsize'     => 'required|numeric',
            'editherd_desc'       => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'editherd_location'   => 'sometimes|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'editherd_incharge'   => 'sometimes|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'editfeed_id'         => 'sometimes|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'editherd_status'     => 'required|alpha'
        ],
        [
            'editherd_color.required'               => 'Error: The :attribute cannot be empty.',
            'editherd_color.editherd_color'         => 'Error: The :attribute must be letters only.',
          //'editherd_category.required'            => 'Error: The :attribute cannot be empty.',
          //'editherd_category.editherd_category'   => 'Error: The :attribute must be letters only.',
            'editherd_gender.required'              => 'Error: The :attribute cannot be empty.',
            'editherd_gender.editherd_gender'       => 'Error: The :attribute must be letters only.',
            'editnewherdsize.required'              => 'Error: The :attribute cannot be empty.',
            'editnewherdsize.editnewherdsize'       => 'Error: The :attribute must be Numbers only.',
            'editherd_desc.required'                => 'Error: The :attribute cannot be empty.',
            'editherd_desc.editherd_desc'           => 'Error: The :attribute must be Letters and Dash only.',
            'editherd_location.required'            => 'Error: The :attribute cannot be empty.',
            'editherd_location.editherd_location'   => 'Error: The :attribute must be Letters and Dash only.',
            'editherd_incharge.required'            => 'Error: The :attribute cannot be empty.',
            'editherd_incharge.editherd_incharge'   => 'Error: The :attribute must be Letters and Dash only.',
            'editfeed_id.required'                  => 'Error: The :attribute cannot be empty.',
            'editfeed_id.editfeed_id'               => 'Error: The :attribute must be Letters and Dash only.',
            
            'editherd_status.required'              => 'Error: The :attribute cannot be empty',
            'editherd_status.editherd_status'       => 'Error: The :attribute must be letters only'
        ],
        [
            'editherd_color'        => 'Herd Color',
          //'eidtherd_category'     => 'Herd Category',
            'editherd_gender'       => 'Herd Gender',
            'editnewherdsize'       => 'Herd Size',
            'editherd_desc'         => 'Herd Description',
            'editherd_location'     => 'Herd Location',
            'editherd_incharge'     => 'Herd In-Charge',
            'editfeed_id'           => 'Feed',
            'editherd_status'       => 'Herd Status'
        ]);
        
        $this->goatCount = Goat::where('herd_id', $herd_id)->count();
        
        $updHerd = Herd::where('herd_id', $herd_id)->first();
        $updHerd->description = $this->editherd_desc;
        $updHerd->location = $this->editherd_location;
        $updHerd->total_size = $this->editnewherdsize;
        $updHerd->gender = $this->editherd_gender;
        $updHerd->feed_description = $this->editfeed_id;
        $updHerd->incharge_name = $this->editherd_incharge;
        $updHerd->status = $this->editherd_status;
        $updHerd->notes = $this->editherd_notes;
        
        If( $this->editherd_status == "inactive")
        {
            if($this->goatCount == 0 )
            {
                $updHerd->save();
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Updated Herd Data Saved');
            }
            else {
                $this->editHerdMessage = "Herd Has goats, Must Exit goats first";
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Error: Status invaction: Goats present');
            }
        }
        else {
            $updHerd->save();
            //now close all forms after resetting
            $this->resetHerdEditForm();
            $this->viewEditHerdForm = false;
            $this->showDashButton = false;
            $this->dashInfo = true;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Updated Herd Data Saved');
        }
    }

    public function resetHerdForm()
    {
        $this->herd_desc =null;
        $this->herd_location = null;
        $this->herd_category = null;
        $this->herd_size = null;
        $this->herd_gender = null;
        $this->feed_id = null;
        $this->herd_incharge = null;
        $this->user_name = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Herd Form reset done');
    }

    public function resetHerdEditForm()
    {
        $this->herd_location = null;
        $this->herd_size = null;
        $this->herd_total_count = null;
        $this->herd_incharge = null;
        $this->herd_status = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Edit Herd Form reset done');
    }

    // add to members to herd
    public function showAddToHerdForm($herd_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            $this->showDashButton = true;
            $this->dashInfo = false;

            $this->viewImmInf = false;
            $this->viewEditHerdForm = false;
            $this->showNewHerdForm = false;
            $this->viewSingleGoatInfo = false;
            $this->viewSerumForm = false;
            
            $this->viewImmHCFailDeatils = false;
            $this->viewSerumHCFailDeatils = false;

            //dd($herd_id);
            $this->hmem_herdId = $herd_id;
            $this->hmem_gender = Herd::where('herd_id', $herd_id)->value('gender');
            $this->showAddMemberForm = true;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Add To Herd Form Displayed');
        }
		else {
		    return view('livewire.permError');
		}
    }
    
    public function updated($hmem_quarstart, $hmem_DoB)
    {
        $this->dobmsg = null;
    
        //validate aga of the goat before entry
        $days = $this->daysBetween($this->hmem_DoB,  date('Y-m-d'));
        
        If($days < 160)
        {
            $this->dobmsg = "Age Below 6 months";
        }
        
        If($days > 570)
        {
            $this->dobmsg = "Age Above 19 months";
        }
        
        if($hmem_quarstart != null)
        {
            $this->hmem_quarend = date('Y-m-d', strtotime($this->hmem_quarstart." +21 days"));
        }
    }

    public function addMemberToHerd($herd_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {

            $this->showDashButton = true;
            $this->dashInfo = false;
            $this->addHerdMessage = null;
    
            $this->herd_id = $herd_id;
            
            $hInfo = Herd::where('herd_id', $herd_id)->first();
            
            //check here whether capacity reached or not
            $totalSize = $hInfo->total_size;
            
            //increade herd count by each additon
            $totalCount = $hInfo->total_count;

            $diff = $totalSize - $totalCount;
            
            if($diff > 0)
            {
                //validate aga of the goat before entry
                $days = $this->daysBetween($this->hmem_DoB,  date('Y-m-d'));
            
                if($days > 160 && $days < 570)
                {
                    
                    //create new goat object, collect info and save it to db.
                    //insert validations here
                    $validatedData = $this->validate(
                    [
                        'hmem_genback'    => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                        'hmem_DoB'        => 'required|date',
                        'hmem_source'     => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'hmem_sourceref'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                        'hmem_quarstart'  => 'required|date|after:hmem_DoB',
                        'hmem_quarend'    => 'required|date|after:hmem_quarstart',
                        'hmem_sourcefile' => 'required|string|regex:/^[A-Za-z0-9_.]+$/|max:49',
                        'hmem_remarks'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/'
                    ],
                    [
                        'hmem_genback.required'           => 'The :attribute cannot be empty.',
                        'hmem_genback.hmem_genback'       => 'The :attribute must be Letters and Dash only.',
                        'hmem_DoB.required'               => 'The :attribute cannot be empty.',
                        'hmem_DoB.hmem_DoB'               => 'The :attribute must be valid date.',
                        'hmem_source.required'            => 'The :attribute cannot be empty.',
                        'hmem_source.hmem_source'         => 'The :attribute must be Letters and Dash only.',
                        'hmem_sourceref.required'         => 'The :attribute cannot be empty.',
                        'hmem_sourceref.hmem_sourceref'   => 'The :attribute must be Letters, Underscore only.',
                        'hmem_quarstart.required'         => 'The :attribute cannot be empty.',
                        'hmem_quarstart.hmem_quarstart'   => 'The :attribute must be valid date.',
                        'hmem_quarend.required'           => 'The :attribute cannot be empty.',
                        'hmem_quarend.hmem_quarend'       => 'The :attribute must be valid date.',
                        'hmem_sourcefile.required'        => 'The :attribute cannot be empty.',
                        'hmem_sourcefile.hmem_sourcefile' => 'The :attribute must be Letters Underscore only.',
                        'hmem_remarks.required'           => 'The :attribute cannot be empty.',
                        'hmem_remarks.hmem_remarks'       => 'The :attribute must be Letters and Dash only.',
                    ],
                    [
                        'hmem_genback'    => 'Genetic Background',
                        'hmem_DoB'        => 'Date of Birth',
                        'hmem_source'     => 'Source',
                        'hmem_sourceref'  => 'Source Reference',
                        'hmem_quarstart'  => 'Quarantine Start Date',
                        'hmem_quarend'    => 'Quarantine End Date',
                        'hmem_sourcefile' => 'Soure File Name',
                        'hmem_remarks'    => 'Remarks',
                    ]);
    
                 // dd($this->hmem_genback, $this->$this->hmem_DoB);
                    $newHm = new Goat();
        
                    $newHm->herd_id = $this->herd_id;
                    $newHm->dob = $this->hmem_DoB;
                    $newHm->gender = $this->hmem_gender;
                    $newHm->age = $this->monthsBetweenTwoDates($this->hmem_DoB, date('Y-m-d'));
                    $newHm->age_unit = "months";
                    $newHm->source = $this->hmem_source;
                    $newHm->genetic_background = $this->hmem_genback;
                    $newHm->source_reference = $this->hmem_sourceref;
                    $newHm->source_ref_file = $this->hmem_sourcefile;
                    $newHm->quarantine_start = $this->hmem_quarstart;
                    $newHm->quarantine_end = $this->hmem_quarend;
                    $newHm->inducted_date = date('Y-m-d');
                    $newHm->status = 'active';
                    $newHm->remark = $this->hmem_remarks;
                    //dd($newHm);
                    $newHm->save();
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Added Member To Herd successfull');
                    //upload file here
                    if($this->goatImages != null)
                    {
                        $data = $this->validate(
                        [
                            'goatImages.*' => 'nullable|mimes:jpg,jpeg'
                        ],
                        [
                            'goatImages.*' => 'The :attribute must be jpg, jpeg only.'
                        ],
                        [
                            'goatImages.*' => 'Image File'
                        ]);
                    
                        $filetype = "selfie";
                        $result = $this->uploadHerdFiles($newHm->goat_id, $filetype, $this->goatImages);
                    }
                    //end of file upload
                    
                    //upload doc file here
                    if($this->fileref != null)
                    {
                        $data = $this->validate(
                        [
                            'fileref.*' => 'nullable|mimes:pdf'
                        ],
                        [
                            'fileref.*' => 'The :attribute must be pdf only.'
                        ],
                        [
                            'fileref.*' => 'File Reference'
                        ]);
                    
                        $filetype = "docs";
                        $result = $this->uploadHerdFiles($newHm->goat_id, $filetype, $this->fileref);
                    }// if statement
    
                    $this->addHerdMessage = "Goat Id: ".$newHm->goat_id." Created";
    
                    $result = Herd::where('herd_id', $herd_id)->update(['total_count' => ($totalCount + 1)]);
        
                    if(!$this->hmem_multiple)
                    {
                        $this->resetAddherdMemberForm();
                    }
                
                }
                else {
                    $this->addHerdMessage = "Goat Age either < 160 or > 570 days";
                }
            }
            else {
              $this->addHerdMessage = "Herd Capacity Reached";
            }
            
        }
        else {
          return view('livewire.permError');
        }
    }

    public function resetAddherdMemberForm()
    {
        $this->hmem_DoB = null;
        $this->hmem_genback = null;
        $this->hmem_source = null;
        $this->hmem_sourceref = null;
        $this->hmem_sourcefile = null;
        $this->hmem_gender = null;
        $this->hmem_quarstart = null;
        $this->hmem_quarend = null;
        $this->hmem_inducton = null;
        $this->hmem_remarks = null;
    }

    ///////////////////////////////////////

    // goat individual information
    public function fetchHerdInfo($herd_id)
    {
        $this->scanGoatId = null;
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstimmun','herdserum','herdvet']) )
        {
            $this->showDashButton = true;
            $this->dashInfo = false;

            $this->viewImmInf = false;
            $this->viewEditHerdForm = false;
            $this->showNewHerdForm = false;
            $this->viewSingleGoatInfo = false;
            $this->viewSerumForm = false;
            $this->showAddMemberForm = false;
            
            $this->viewImmHCFailDeatils = false;
            $this->viewSerumHCFailDeatils = false;

            $this->herd_id = $herd_id;
            //quarantine to back to quarantine is not allowed.
            $this->allHerds = Herd::where('category', '<>', 'quarantine')->get();
            $this->herdInfo = Herd::where('herd_id', $herd_id)->get();
            $this->curGoatList = Goat::where('herd_id', $herd_id)->get(); //orig

            // panel visibility
            if(count($this->curGoatList) > 0)
            {
                $this->viewGoatList = true;
            }
            else {
                $this->viewGoatList = false;
            }
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Fetched Herd info for ID '.$herd_id);
            $this->viewHerdInf = true;
        }
		else {
		    return view('livewire.permError');
		}
    }

    public function updatedScanGoatId()
    {
        $this->scanError = null;
        $this->viewSingleGoatInfo = false;

        $validatedData = $this->validate(
        [   
            'scanGoatId'    => 'numeric',
        ],
        [
            'scanGoatId.scanGoatId' => ' :attribute must be Number.',
        ],
        [
            'scanGoatId' => 'Goat ID'
        ]);

        if( $this->scanGoatId != null)
        {
            $result = Goat::where('herd_id', $this->herd_id)->where('goat_id', ltrim($this->scanGoatId, '0'))->first();
            if($result){
                $this->viewGoatDetails(ltrim($this->scanGoatId, '0'));
            }
            else {
                $this->scanError = "Goat ID Not Found";
            }

        }
    }

    //individual goat information
    public function viewGoatDetails($goat_id)
    {
        $this->scanError = null;
        $this->scanGoatId = null;
        $this->showDashButton = true;
        $this->dashInfo = false;

        $this->viewGoatImmInfo = false;
        $this->showNewHerdForm = false;
        $this->showAddMemberForm = false;
        
        $this->viewImmHCFailDeatils = false;
        $this->viewSerumHCFailDeatils = false;

        $this->viewImmInf = false;
        $this->goat_id = $goat_id;
        
        $this->goatDetails = Goat::where('herd_id', $this->herd_id)->where('goat_id', $goat_id)->first();
        $this->goatImgs = Mugshot::where('goat_id', $goat_id)->get();

        //dd($this->goatDetails);
        if($this->goatDetails != null)
        {
            $this->goatDetails->age = $this->monthsBetweenTwoDates($this->goatDetails->dob, date('Y-m-d'));
            
            $this->goatHealthInfos = Goathealth::with('sops')->where('goat_id', $goat_id)->get();

            $this->imm_info = Immunedgoats::with('immunztion')->where('goat_id', $goat_id)->get();
            $this->seraGoat = Goatsera::with('serum')->where('goat_id', $goat_id)->get();
            $this->goatTiterVal = Goattiter::with('titer')->where('goat_id', $goat_id)->get();
 
            $this->singleGoatHealthParams = $this->getSingleGoathealthParamsById($goat_id);
            $this->dispatchBrowserEvent('drawGraph', ['assets'=> json_encode($this->singleGoatHealthParams)]);
            $this->viewSingleGoatInfo = true;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Fetched Goat Details for ID '.$goat_id);
        }
        else {
            $this->scanError = "Goat Id Not Found";
        }
    }
    
    public function emit_to_parent()
    {
       $this->emitSelf('newGraphData', $this->singleGoatHealthParams['wtscat']);
    }

    public function saveExitDetails($goat_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager']) )
        {
            $this->viewImmInf = false;
            $this->goat_id = $goat_id;
            $this->exitFormMessage = null;

            $validatedData = $this->validate(
            [
                'goat_exit'   => 'required|string|regex:/^[A-Za-z_ ]+$/',
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
            
            if(in_array($this->goat_exit, $values))
            {
                
                //first make entry in the goat table, change status to
                //reason assigned
                $exGoat = Goat::where('goat_id', $goat_id)->first();
                $goatExited = $exGoat->toArray();
                
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
                            $exGoat->herd_id = $this->newherd_id; //change the present herd id to new herd id
                            $exGoat->status = 'active';
                            $exGoat->remark = $exGoat->remark.";;;".$this->exit_remark." on ".date("Y-m-d");
                            $exGoat->update();
    
                            //next reduce the herd count by one.
                            $herdsize1 = intval(Herd::where('herd_id', $this->herd_id)->value('total_count'));
                            $result = Herd::where('herd_id', $this->herd_id)->update(['total_count' => $herdsize1 - 1]);
    
                            //now increase the herd count of destination herd by one
                            $herdsize2 = intval(Herd::where('herd_id', $this->newherd_id)->value('total_count'));
                            $result2 = Herd::where('herd_id', $this->newherd_id)->update(['total_count' => $herdsize2 + 1]);
                            
                            //success closes the forms
                            $this->viewSingleGoatInfo = false;
                            $this->exitFormMessage = null;
                            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Exit Details Recorded for Goat ID '.$goat_id);
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
                    //$exGoat->status = $this->goat_exit;
                    //$exGoat->remark = $this->exit_remark;
                    //$exGoat->update();
                    
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
                    $herdsize = intval(Herd::where('herd_id', $this->herd_id)->value('total_count'));
                    $result = Herd::where('herd_id', $this->herd_id)->update(['total_count' => $herdsize - 1]);
                    
                    //success closes the forms
                    $this->viewSingleGoatInfo = false;
                    $this->exitFormMessage = null;
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Exit Details Recorded for Goat ID '.$goat_id);
                }
            }
            else {
                $this->exitFormMessage = "Error: Form Values Tampered";
            }
        }
        else {
		    return view('livewire.permError');
	    }
    }

    public function updatedSerumTiterRadio()
    {
        $this->serumErrorMessage = null;
        $this->titerErrorMessage = null;
        
        if($this->serumTiterRadio == "serum")
        {
            $this->viewSerumPanel = true;
            $this->viewTiterPanel = false;
            $this->resetTiterDataForm();
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum Form Displayed');
        }
        
        if($this->serumTiterRadio == "titer")
        {
            $this->viewSerumPanel = false;
            $this->viewTiterPanel = true;
            $this->resetSerumCollectionForm();
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Form Displayed');
        }
    }

    // serum form display related information
    public function serumInfoForm($herd_id)
    {
        $this->serumTiterRadio = null;
        $this->viewSerumPanel = false;
        $this->viewTiterPanel = false;
        
        $this->showDashButton = true;
        $this->dashInfo = false;

        $this->viewHerdInf = false;
        $this->viewImmInf = false;
        $this->viewEditHerdForm = false;
        $this->showNewHerdForm = false;
        
        $this->viewImmHCFailDeatils = false;
        $this->viewSerumHCFailDeatils = false;
        $this->viewHealthForm = false;
        
        $this->herd_id = $herd_id;
        $this->curGoatList = Goat::with('goatTiter')->with('goatWeight')->where('herd_id', $herd_id)->get();

        $this->sopids = Sop::where('activity_id', 3)->where('department_id', 3)->get();
        
        // panel visibility
        if(count($this->curGoatList) > 0)
        {
            $this->viewGoatList = true;
        }
        else {
            $this->viewGoatList = false;
        }

        //form variables
        $this->serumDate = date('Y-m-d');
        $this->serbatch_id = $this->generateCode(8);
        $this->seruser_name = Auth::user()->name;

        // all data retrived, show the panel
        $this->viewSerumForm = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Full Details for Serum Displayed');
    }
    
    //serum data update
    public function serumDataUpdate($herd_id)
    {
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstserum']) )
        {
            if(count($this->serumvolume) > 0 )
            {
                $totalVolume = 0;
                $this->serumErrorMessage = null;

                $validatedData = $this->validate(
                [
                    'serproc_id'  => 'required|integer',
                    'serbatch_id' => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                    'sernotes'    => 'string|regex:/^[A-Za-z0-9_. ]+$/',
                ],
                [
                    'serbatch_id.required' => 'Error: The :attribute cannot be empty.',
                    'serbatch_id.serbatch_id' => 'Error: The :attribute must be letters only.',
                    'serproc_id.required' => 'Error: The :attribute cannot be empty.',
                    'serproc_id.serproc_id' => 'Error: The :attribute must be a number.',
                    'sernotes.required' => 'Error: The :attribute cannot be empty.',
                    'sernotes.sernotes' => 'Error: The :attribute must be letters only.',
                ],
                [
                    'serbatch_id'   => 'Batch Id',
                    'serproc_id' => 'SOP ID',
                    'sernotes' => 'Notes',
                ]);

                $serData = new Serum();
                $serData->herd_id = $herd_id;
                $serData->sop_id = $this->serproc_id;
                $serData->number_goats = 0;
                $serData->volume = 0;
                $serData->date_collected = date('Y-m-d');
                $serData->batch_code = $this->serbatch_id;
                $serData->auth_by = $this->seruser_name;
                $serData->notes = $this->sernotes;
                $serData->posted_by = Auth::user()->name;
                $serData->save();
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Serum Data Saved');
                
                foreach($this->serumvolume as $key => $val)
                {
                    $goatSeraUpd = new Goatsera();

                    $goatSeraUpd->serum_id = $serData->serum_id;
                    $goatSeraUpd->goat_id = $key;
                    $goatSeraUpd->volume = $val;

                    $goatSeraUpd->save();

                    $totalVolume = $totalVolume + $val;
                    $goatSeraUpd = null;
                }

                $herdStrength = Herd::where('herd_id', $herd_id)->value('total_count');

                if( count($this->serumvolume) == $herdStrength)
                {
                    $status = 'complete';
                }
                else{
                    $status = 'incomplete';
                }

                $result = Serum::where('serum_id', $serData->serum_id)
                                ->update([
                                'number_goats' => count($this->serumvolume),
                                'volume' => $totalVolume,
                                'status' => $status ]);
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum Data Updated');
                $result = $this->resetSerumCollectionForm();
                $this->viewSerumForm = false;
            }
            else {
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Error: Serum Volumes Not entered');
                $this->serumErrorMessage = "Volumes Not entered";
            }
        }
        else {
		    return view('livewire.permError');
		}
    }

    public function resetSerumCollectionForm()
    {
        //$this->herd_id = null;
        $this->serproc_id = null;
        $this->serbatch_id = null;
        $this->seruser_name = null;
        $this->sernotes = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum Data Form Reset Done');
        return true;
    }
    
    //titer entry form values
    public function titerDataUpdate($herd_id)
    {
        //dd($herd_id);
        if( Auth::user()->hasAnyRole(['herdmanager','herdasstserum']) )
        {
            if(count($this->titervalue) > 0 )
            {
                $this->titerErrorMessage = null;

                $validatedData = $this->validate(
                [
                    'titersop_id'       => 'required|integer',
                    'titerserum_id'     => 'required|integer',
                    'titer_ref'         => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
                    'titerdone_by'      => 'required|string|regex:/^[A-Za-z. ]+$/',
                    'titer_date'        => 'required|date',
                    'titerauth_by'        => 'required|string|regex:/^[A-Za-z. ]+$/',
                    'titer_notes'       => 'string|regex:/^[A-Za-z0-9-_. ]+$/',
                ],
                [
                    'titersop_id.required'        => 'Error: The :attribute cannot be empty.',
                    'titersop_id.titersop_id'     => 'Error: The :attribute must be a number.',
                    
                    'titerserum_id.required'      => 'Error: The :attribute cannot be empty.',
                    'titerserum_id.titerserum_id' => 'Error: The :attribute must be a number.',
                    
                    'titer_ref.required'          => 'Error: The :attribute cannot be empty.',
                    'titer_ref.titer_ref'         => 'Error: The :attribute must be letters only.',
                    
                    'titerdone_by.required'       => 'Error: The :attribute cannot be empty.',
                    'titerdone_by.titerdone_by'   => 'Error: The :attribute must be a number.',
                    
                    'titer_date.required'         => 'Error: The :attribute cannot be empty.',
                    'titer_date.titer_date'       => 'Error: The :attribute must be a number.',
                    
                    'titerauth_by.required'       => 'Error: The :attribute cannot be empty.',
                    'titerauth_by.titerauth_by'   => 'Error: The :attribute must be a number.',

                    'titer_notes.required'        => 'Error: The :attribute cannot be empty.',
                    'titer_notes.titer_notes'     => 'Error: The :attribute must be letters only.',
                ],
                [
                    'titersop_id'   => 'Titer SOP ID',
                    'titerserum_id' => 'Serum ID',
                    'titer_ref'     => 'Titer Reference',
                    'titerdone_by'  => 'Performed By',
                    'titer_date'    => 'Titer Date',
                    'titerauth_by'  => "Authorized By",
                    'titer_notes'   => 'Titer Notes',
                ]);
                
                $newTter = new Titer();
                
                $newTter->herd_id = $this->herd_id;
                $newTter->serum_id = $this->titerserum_id;
                $newTter->sop_id = $this->titersop_id;
                
                $newTter->titer_by = $this->titerdone_by;
                $newTter->titer_date = $this->titer_date;
                $newTter->titer_ref = $this->titer_ref;
                $newTter->auth_by = $this->titerauth_by ;
                $newTter->notes = $this->titer_notes;
                $newTter->posted_by  =  Auth::user()->name;
                
                $herdStrength = Herd::where('herd_id', $herd_id)->value('total_count');

                if( count($this->titervalue) == $herdStrength)
                {
                    $status = 'complete';
                }
                else{
                    $status = 'incomplete';
                }

                $newTter->number_goats = count($this->titervalue);
                $newTter->status = $status;
                //dd($newTter);
                $newTter->save();
                
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Data Entry Done');
                
                foreach($this->titervalue as $key => $val)
                {
                    $gtiter = new Goattiter();
                    //$gtiter->titer_id = $newTter->titer_id;
                    $gtiter->titer_id = 1;
                    $gtiter->serum_id = $this->titerserum_id;
                    $gtiter->goat_id = $key;
                    $gtiter->titer_value = $val;
                    //dd($gtiter);
                    $gtiter->save();
                    $gtiter = null;
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Data Entry Done for Goad ID '.$key);
                }
                
                $this->viewSerumForm = false;
                $this->titerErrorMessage = "Will be available soon";
            }
            else {
                $this->titerErrorMessage = "Titer Values Not entered";
            }
        }
        else {
		    return view('livewire.permError');
		}
    }
    
    //reset the titer form
    public function resetTiterDataForm()
    {
        $this->titersop_id = null;
        $this->titer_ref = null;
        $this->titerdone_by = null;
        $this->titer_notes = null;
        $this->titervalue = [];
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Titer Data Entry Form Reset');
    }

    //immunization of herds
    public function showImmunizationForm($herd_id)
    {
        $this->latestImmEntry = null;
        $this->herdStrength = intval(Herd::where('herd_id', $herd_id)->value('total_count'));
        $this->herdCategory = Herd::where('herd_id', $herd_id)->value('category');
        //$this->imsop2_id = Procedure::where('department_id', 3)->get();
        $this->imsop2_id = Sop::where('activity_id', 2)->where('department_id', 3)->get();
        $this->adjuvants = Adjuvant::all();

        //show goat ids already done
        //not exactly after first entry on today's date at the time of form entering but solution ok
        //because any other query, will return some value which is not correct for this entry
        $this->idsDone = [];
        $dax = array();
        $this->remaining = Goat::where('herd_id',$herd_id)->pluck('goat_id');

        $this->latestImmEntry = Immunization::where('herd_id', $herd_id)->latest()->first();
        
        //dd($this->latestImmEntry->immunogen_code);
        
        if(!empty($this->latestImmEntry) > 0)
        {
            $this->imsop_id = $this->latestImmEntry->sop_id;
            $this->imngen_code = $this->latestImmEntry->immunogen_code;
            
            $this->imadjuvent_code = $this->latestImmEntry->adjuvent_code;
            $this->imfreqnumber = $this->latestImmEntry->frequency;
            $this->imfrequnit = $this->latestImmEntry->frequency_unit;
            
            $this->immunoge_volume = $this->latestImmEntry->immunogen_volume;
            $this->immunogen_site = $this->latestImmEntry->immunogen_site;
            $this->immunogen_route = $this->latestImmEntry->immunogen_route;
            $this->imsample_desc = $this->latestImmEntry->sample_desc;
            $this->sample_volume = $this->latestImmEntry->sample_volume;
            $this->sampbatch_id = $this->latestImmEntry->batch_id;
            $this->sample_source = $this->latestImmEntry->sample_source;
            $this->supplied_by = $this->latestImmEntry->supplied_by;
            
            $this->sample_ref = $this->latestImmEntry->sample_ref;
            $this->auth_by = $this->latestImmEntry->auth_by;
        }

        foreach($this->remaining as $row)
        {
          $dax[] = $row;
        }
        $this->remainingGoats = array_diff($dax, $this->idsDone);

        $minGoatId = Goat::where('herd_id', $herd_id)->min('goat_id');
        $maxGoatId = Goat::where('herd_id', $herd_id)->max('goat_id');
        $goatIdx = Goat::where('herd_id', $herd_id)->get();
         //dd($this->herdStrength);
        $this->herd_id = $herd_id;
        $this->viewHerdInf = false;
        $this->viewSingleGoatInfo = false;
        $this->viewEditHerdForm = false;
        $this->viewImmHCFailDeatils = false;
        $this->viewSerumHCFailDeatils = false;
        $this->viewHealthForm = false;
        
        $this->viewImmInf = true;
        $this->showDashButton = true;
        $this->dashInfo = false;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization Form for New Immunization Entry Displayed');
    }
    
    public function updatedImmunizeAll()
    {
        if($this->immunizeAll == 1)
        {
            $this->hideScanField = false;
        }
        else {
            $this->hideScanField = true;
        }
    }

    public function updatedScanGoatId2()
    {
      $this->scanError2 = null;
      $this->viewSingleGoatInfo = false;

      $validatedData = $this->validate(
      [
        'scanGoatId2' => 'numeric|regex:/^[0-9 ]+$/',
      ],
      [
        'scanGoatId2.scanGoatId2' => 'The :attribute must be Number only.',
      ],
      [
        'scanGoatId2' => 'Goat Id'
      ]);

      if( $this->scanGoatId2 != null)
      {
        $result = Goat::where('herd_id', $this->herd_id)->where('goat_id', ltrim($this->scanGoatId2, '0'))->first();
        if($result)
        {
           //get max immmunization for the herd_id from table.
           //$maxImmId = Immunization::where('herd_id', $this->herd_id)->max('immunization_id');
  
          //$result2 = Immunedgoats::where('immunization_id', $maxImmId+1)->where('goat_id', ltrim($this->scanGoatId2, '0'))->first();
          //if(!$result2)
          //{
                if(!in_array($this->scanGoatId2, $this->gis))
                {
                  $this->scannedGoatIds = $this->scannedGoatIds." ; ".$this->scanGoatId2;
                  array_push($this->gis, $this->scanGoatId2);
                  $this->scanGoatId2 = null;
                }
                else{
                  $this->scanError2 = "Already Scanned";
                }
            /*
            }
            else {
              $this->scanError2 = "Already Immunized";
            }
           */
        }
        else{
          $this->scanError2 = "Goat Id Not Found";
        }
      }
    }

    //save immunization details
    public function saveImmunizationDetails($herd_id)
    {
      $this->immErrorMsg = null;
      if( Auth::user()->hasAnyRole(['herdmanager', 'herdasstimmun']) )
      {
        if($herd_id !=  null)
        {
            //now if immunize all is true, the variable id is transferred
            if($this->immunizeAll == 1)
            {
                $this->gis = $this->remaining;
            }
            
            if(count($this->gis) > 0)
            {
                //$this->gis = array_filter(explode(" ; ", $this->scannedGoatIds));
                $validatedData = $this->validate(
                [
                    'imsop_id'        => 'required|numeric|regex:/^[0-9]+$/',
                    'imngen_code'     => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'imadjuvent_code' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'imfreqnumber'    => 'required|numeric|regex:/^[0-9]+$/',
                    'imfrequnit'      => 'required|string|regex:/^[A-Za-z]+$/',
                    
                    'immunoge_volume' => 'required|numeric|regex:/^[0-9]+$/',
                    'immunogen_site'  => 'required|string|regex:/^[A-Za-z0-9+_. ]+$/',
                    'immunogen_route' => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'imsample_desc'   => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'sample_volume'   => 'required|numeric|regex:/^[0-9. ]+$/',
                    'sampbatch_id'    => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'sample_source'   => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'supplied_by'     => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'sample_ref'      => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'auth_by'         => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
                    'remark'          => 'required|string|regex:/^[A-Za-z0-9-,_. ]+$/',
                ],
                [
                    'imsop_id.required' => 'Error: The :attribute cannot be empty.',
                    'imsop_id.imsop_id' => 'Error: The :attribute must be selected.',
                    
                    'imngen_code.required' => 'Error: The :attribute cannot be empty.',
                    'imngen_code.imngen_code' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'imadjuvent_code.required' => 'Error: The :attribute cannot be empty.',
                    'imadjuvent_code.imadjuvent_code' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'imfreqnumber.required'  => 'Error: The :attribute cannot be empty.',
                    'imfreqnumber.imfreqnumber' => 'Error: The :attribute must be number only.',
                    
                    'imfrequnit.required'  => 'Error: The :attribute cannot be empty.',
                    'imfrequnit.imfrequnit' => 'Error: The :attribute must be letters only.',
                    
                    'immunoge_volume.required' => 'Error: The :attribute cannot be empty.',
                    'immunoge_volume.immunoge_volume' => 'Error: The :attribute must be Number only.',
                    
                    'immunogen_site.required' => 'Error: The :attribute cannot be empty.',
                    'immunogen_site.immunogen_site' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'immunogen_route.required' => 'Error: The :attribute cannot be empty.',
                    'immunogen_route.immunogen_route' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'imsample_desc.required' => 'Error: The :attribute cannot be empty.',
                    'imsample_desc.imsample_desc' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'sample_volume.required' => 'Error: The :attribute cannot be empty.',
                    'sample_volume.sample_volume' => 'Error: The :attribute must be Number only.',
                    
                    'sampbatch_id.required' => 'Error: The :attribute cannot be empty.',
                    'sampbatch_id.sampbatch_id' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'sample_source.required' => 'Error: The :attribute cannot be empty.',
                    'sample_source.sample_source' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'supplied_by.required' => 'Error: The :attribute cannot be empty.',
                    'supplied_by.supplied_by' => 'Error: The :attribute must be letters only.',
                    
                    'sample_ref.required' => 'Error: The :attribute cannot be empty.',
                    'sample_ref.sample_ref' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                    
                    'auth_by.required' => 'Error: The :attribute cannot be empty.',
                    'auth_by.auth_by' => 'Error: The :attribute must be letters only.',
                    
                    'remark.required' => 'Error: The :attribute cannot be empty.',
                    'remark.remark' => 'Error: The :attribute must be Alpha Numeric - _ only.',
                ],
                [
                    'imsop_id'     => 'Immunogen SOP ID',
                    'imngen_code'    => 'Immunogen Code',
                    'imadjuvent_code'    => 'Adjuvent Code',
                    'imfreqnumber' => 'Immunization Frequncy',
                    'imfrequnit' => 'Frequency Unit',
                    'immunoge_volume' => 'Immunogen Volume',
                    'immunogen_site' => 'Immunization Site',
                    'immunogen_route' => 'Immunization Route',
                    'imsample_desc' => 'Sample Description',
                    'sample_volume' => 'Sample Volume',
                    'sampbatch_id' => 'Sample Batch Id',
                    'sample_source' => 'Sample Source',
                    'supplied_by' => 'Sample Supplied By',
                    'sample_ref' => 'Sample Reference',
                    'auth_by' => 'Authorized By',
                    'remark' => 'Remarks',
                ]);
    
                //conver the immunized goatid to proper format
                $immDet = new Immunization();
                $immDet->project_id = 1; //change this to actual value after testing;
                $immDet->herd_id = $herd_id;
                $immDet->posted_by = Auth::user()->name;
                $immDet->sop_id = $this->imsop_id;
                $immDet->immunization_date = date('Y-m-d H:i:s');
                $immDet->immunogen_code = $this->imngen_code;
                $immDet->frequency = $this->imfreqnumber;
                $immDet->frequency_unit = $this->imfrequnit;
                $immDet->adjuvent_code = $this->imadjuvent_code;
                $immDet->immunogen_volume = $this->immunoge_volume;
                $immDet->immunogen_site = $this->immunogen_site;
                $immDet->immunogen_route = $this->immunogen_route;
                $immDet->sample_desc = $this->imsample_desc;
                $immDet->sample_volume = $this->sample_volume;
                $immDet->batch_id = $this->sampbatch_id;
                $immDet->sample_source = $this->sample_source;
                $immDet->supplied_by = $this->supplied_by;
                $immDet->sample_ref = $this->sample_ref;
                $immDet->auth_by = $this->auth_by;
                $immDet->remark = $this->remark;
                
                $herdGoats = Goat::where('herd_id', $herd_id)->get();
                $immDet->total_immunized = count($this->gis);
                
                if(count($herdGoats) == count($this->gis))
                {
                    $immDet->status = 'complete';
                }
    
                //dd($immDet);
                // now save the model
                $immDet->save(); //everything worked well;
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Immunization Data Entry Successfull');
                
                $today = date('Y-m-d');
                //now save the individual goat immunized data through loop
                foreach($this->gis as $row)
                {
                    //dd($row->goat_id);
                    $immundGoat = new Immunedgoats();
                    $immundGoat->immunization_id = $immDet->immunization_id;
                    $immundGoat->goat_id = intval($row);
                    $immundGoat->booster_due = date('Y-m-d H:i:s', strtotime($today."+".$this->imfreqnumber." days"));
                    $immundGoat->notes = "immunized";
                    $immundGoat->save();
                    $immundGoat = null;
                    Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization Data entered for Goat ID '.intval($row));
                }
                
                //now post to event table for calendar Display
                
                $newEvent = new Event();
                $newEvent->title = "Herd ".$herd_id." Booster Due";
                $newEvent->description = "Booster with ".$this->imngen_code;
                $newEvent->start_date = date('Y-m-d H:i:s', strtotime($today."+".$this->imfreqnumber." days"));
                $newEvent->priority = "high";
                $newEvent->save();
                Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Event Entry for Calendar Done');
                // reset the form
                $this->resetImmunizedForm();
                $this->herd_id = null;
                $this->viewImmInf = false;
            }
            else {
                $this->immErrorMsg = "ID Not Selected, Must Select One";
            }
        }
        else {
            $this->immErrorMsg = "Herd ID Not Selected";
        }
      }
      else {
	    return view('livewire.permError');
	  }
    }

    public function resetImmunizedForm()
    {
        $this->imsop_id = null;
        $this->imngen_code = null;
        $this->imadjuvent_code = null;
        $this->immunogen_volume = null;
        $this->immunogen_site = null;
        $this->immunogen_route = null;
        $this->imsample_desc = null;
        $this->sample_volume = null;
        $this->sampbatch_id = null;
        $this->sample_source = null;
        $this->supplied_by = null;
        $this->sample_ref = null;
        $this->remark = null;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization Form Reset');
    }


    // health information form display
    public function showHealthInfoEntryForm($herd_id)
    {
        $this->viewHerdInf = false;
        $this->viewSingleGoatInfo = false;
        $this->viewEditHerdForm = false;
        $this->viewImmInf = false;
        $this->viewSerumForm = false;
        
        $this->viewImmHCFailDeatils = false;
        $this->viewSerumHCFailDeatils = false;

        $this->viewHealthForm = false;
        $this->resetHealthForm();

        $this->herd_id = $herd_id;
        $this->goatNum = intval(Herd::where('herd_id', $herd_id)->value('total_count'));
        //$this->imsop3_id = Procedure::where('department_id', 3)->get();
        $this->imsop3_id = Sop::where('activity_id', [4,5])->where('department_id', 3)->get();
        
        $goatidArray = Goat::where('herd_id', $herd_id)->get();

        $this->gidArray = $this->getGoatIdHealthArray(Goat::where('herd_id', $herd_id)->get());
        
        //dd($this->gidArray);
        $this->viewHealthForm = true;
        $this->showDashButton = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Health Data Entry Form Displayed');
        $this->dashInfo = false;
    }

    public function saveHealthInfoDetails($herd_id)
    {

        //for validation of data
        $validatedData = $this->validate(
        [
            'healthsop_id'        => 'required|integer',
            'sch_code'            => 'required|alpha',
            'physical_inspection' => 'string|regex:/^[A-Za-z0-9_. ]+$/',
            'health_notes'        => 'string|regex:/^[A-Za-z0-9-,_. ]+$/',
            'diagnosis'           => 'string|regex:/^[A-Za-z0-9-,_._. ]+$/',
            'suggestions'         => 'string|regex:/^[A-Za-z0-9-,_._. ]+$/',
            'healthremark'        => 'string|regex:/^[A-Za-z0-9-,_._. ]+$/',
            //'healthlegend'        => 'string|regex:/^[0-9; ]+$/'
        ],
        [
            'healthsop_id.required' => 'Error: The :attribute cannot be empty.',
            'healthsop_id.healthsop_id' => 'Error: The :attribute must be letters only.',
            'sch_code.required' => 'Error: The :attribute cannot be empty.',
            'sch_code.sch_code' => 'Error: The :attribute must be number only.',
            'physical_inspection.required' => 'Error: The :attribute cannot be empty.',
            'physical_inspection.physical_inspection' => 'Error: The :attribute must be a number.',
            'health_notes.required' => 'Error: The :attribute cannot be empty.',
            'health_notes.health_notes' => 'Error: The :attribute must be letters only.',
            'diagnosis.required' => 'Error: The :attribute cannot be empty.',
            'diagnosis.diagnosis' => 'Error: The :attribute must be letters only.',
            'suggestions.required' => 'Error: The :attribute cannot be empty.',
            'suggestions.suggestions' => 'Error: The :attribute must be letters only.',
            'healthremark.required' => 'Error: The :attribute cannot be empty.',
            'healthremark.healthremark' => 'Error: The :attribute must be letters only.',
            //'healthlegend.required' => 'Error: The :attribute cannot be empty.',
            //'healthlegend.healthlegend' => 'Error: The :attribute must be numbers and colon only.'
        ],
        [
            'healthsop_id'        => 'SOP Id',
            'sch_code'            => 'Schedule',
            'physical_inspection' => 'Inspection',
            'health_notes'        => 'Notes',
            'diagnosis'           => 'Diagnosis',
            'suggestions'         => 'Suggestions',
            'healthremark'        => 'Remarks',
            //'healthlegend'        => 'Goat ID'
        ]);
        
        $healthInf = new Health();
        
        $healthInf->herd_id = $herd_id;
        $healthInf->sop_id = $this->healthsop_id;
        //$healthInf->sop_id = $this->imsop3_id;
        $healthInf->scheduled = $this->sch_code;
        $healthInf->inspect_type = $this->physical_inspection;
        $healthInf->health_notes = $this->health_notes;
        $healthInf->diagnosis = $this->diagnosis;
        $healthInf->suggestions = $this->suggestions;
        $healthInf->vet_name = Auth::user()->name;
        $healthInf->inspected_on = date('Y-m-d');
        $healthInf->remarks = $this->healthremark;
        //dd($healthInf);
        $healthInf->save();
        
        // now add the date of health check for this herd through update
        Herd::where('herd_id', $herd_id)->update(['health_check'=>date('Y-m-d'), 'health_check_id'=>$healthInf->herd_id]);
        
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Health Info Data Updated for Herd ID '.$herd_id);
        $result = $this->createNewEvent($herd_id, $this->healthsop_id);
        
      $this->resetHealthForm();
      $this->viewHealthForm = false;
    }

    public function postGoatHealthInfos($goat_id)
    {

        $this->messagex = null;
        $this->goat_id = $goat_id;
        $goat = [];

            $goat['morning']       = date('Y-m-d H:i:s', strtotime($this->morning));
            $goat['evening']       = date('Y-m-d H:i:s', strtotime($this->evening));
            $goat['date_observed'] = date('Y-m-d');
            
            $this->validate([
              'healthsop2_id' => 'required|integer',
              'morning'       => 'sometimes|string|nullable',
              'evening'       => 'sometimes|string|nullable'
            ],
            [
             'healthsop2_id.required'      => 'Error: The :attribute cannot be empty.',
             'healthsop2_id.healthsop2_id' => 'Error: The :attribute must be number only.',
             'morning.morning'             => 'Error: The :attribute must be date & time only.',
             'evening.evening'             => 'Error: The :attribute must be date & time only.',
           ],
           [
             'healthsop2_id' => 'SOP',
             'morning' => 'Recording Time',
             'evening' => 'Recording Time',
           ]);
           
            $validatedData = $this->validate(
            [
             'health.*.1'  => 'nullable|numeric',
             'health.*.2'  => 'nullable|numeric',
             'health.*.3'  => 'nullable|numeric',
             'health.*.4'  => 'nullable|numeric',
             'health.*.5'  => 'nullable|string|max:15',
             'health.*.6'  => 'nullable|numeric',
             'health.*.7'  => 'nullable|numeric',
             'health.*.8'  => 'nullable|numeric',
             'health.*.9'  => 'nullable|numeric',
             'health.*.10' => 'nullable|numeric',
             'health.*.11' => 'nullable|numeric',
             'health.*.12' => 'nullable|string|max:15',
            ],
            [
             'health.*.1.health.*.1'   => 'Error: The :attribute must be Number only.',
             'health.*.2.health.*.2'   => 'Error: The :attribute must be Number only.',
             'health.*.3.health.*.3'   => 'Error: The :attribute must be Number only.',
             'health.*.4.health.*.4'   => 'Error: The :attribute must be Number only.',
             'health.*.5.health.*.5'   => 'Error: The :attribute must be Alpha-Numeric only.',
             'health.*.6.health.*.6'   => 'Error: The :attribute must be Number only.',
             'health.*.7.health.*.7'   => 'Error: The :attribute must be Number only.',
             'health.*.8.health.*.8'   => 'Error: The :attribute must be Number only.',
             'health.*.9.health.*.9'   => 'Error: The :attribute must be Number only.',
             'health.*.10.health.*.10' => 'Error: The :attribute must be Number only.',
             'health.*.11.health.*.11' => 'Error: The :attribute must be Number only.',
             'health.*.12.health.*.12' => 'Error: The :attribute must be Number only.',
            ],
            [
             'health.*.1'  => 'Hemoglobin',
             'health.*.2'  => 'Weight',
             'health.*.3'  => 'Temperature',
             'health.*.4'  => 'Mucous Membrane',
             'health.*.5'  => 'Respiration Rate',
             'health.*.6'  => 'Rumen Contractions',
             'health.*.7'  => 'RBC',
             'health.*.8'  => 'Platelet',
             'health.*.9'  => 'PCV',
             'health.*.10' => 'LFT',
             'health.*.11' => 'KFT',
             'health.*.12' => 'RT-PCR',
            ]);
        
        //important check point.
        //dd($goat_id, $this->health, $validatedData);
        
            if($goat_id != null || $goat_id == "")
            {
                if(array_key_exists($goat_id, $this->health))
                {
                    if(count($this->health) > 0 )
                    {

                            if(array_key_exists(1, $this->health[$goat_id]))
                            {
                              
                                if($this->health[$goat_id][1] == "")
                                {
                                    $goat['hb'] = null;
                                }
                                else{
                                    $goat['hb'] = $this->health[$goat_id][1];
                                }
                            }
                            else {
                                $goat['hb'] = null;
                            }
            
                            if(array_key_exists(2, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][2] == "")
                                {
                                    $goat['weight'] = null;
                                }
                                else {
                                    $goat['weight'] = $this->health[$goat_id][2];
                                }
                            }
                            else {
                                $goat['weight'] = null;
                            }
                
                            if(array_key_exists(3, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][3] == "")
                                {
                                    $goat['temperature'] = null;
                                }
                                else {
                                    $goat['temperature'] = $this->health[$goat_id][3];
                                }
                            }
                            else {
                                $goat['temperature'] = null;
                            }
                
                            if(array_key_exists(4, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][4] == "")
                                {
                                    $goat['resp_rate'] = null;
                                }
                                else {
                                    $goat['resp_rate'] = $this->health[$goat_id][4];
                                }
                            }
                            else {
                                $goat['resp_rate'] = null;
                            }
                
                            if(array_key_exists(5, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][5] == "")
                                {
                                    $goat['mucous_membrane'] = null;
                                }
                                else {
                                    $goat['mucous_membrane'] = $this->health[$goat_id][5];
                                }
                            }
                            else {
                                $goat['mucous_membrane'] = null;
                            }
                
                            if(array_key_exists(6, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][6] == "")
                                {
                                    $goat['rumen_contractions'] = null;
                                }
                                else {
                                    $goat['rumen_contractions'] = $this->health[$goat_id][6];
                                }
                            }
                            else {
                                $goat['rumen_contractions'] = null;
                            }
                
                            if(array_key_exists(7, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][7] == "")
                                {
                                    $goat['rbc'] = null;
                                }
                                else {
                                    $goat['rbc'] = $this->health[$goat_id][7];
                                }
                            }
                            else {
                                $goat['rbc'] = null;
                            }
                
                            if(array_key_exists(8, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][8] == "")
                                {
                                    $goat['platelet'] = null;
                                }
                                else {
                                    $goat['platelet'] = $this->health[$goat_id][8];
                                }
                            }
                            else {
                                $goat['platelet'] = null;
                            }
                
                            if(array_key_exists(9, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][9] == "")
                                {
                                    $goat['pcv'] = null;
                                }
                                else {
                                    $goat['pcv'] = $this->health[$goat_id][9];
                                }
                            }
                            else {
                                $goat['pcv'] = null;
                            }
                            
                            if(array_key_exists(10, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][10] == "")
                                {
                                    $goat['lft'] = null;
                                }
                                else {
                                    $goat['lft'] = $this->health[$goat_id][10];
                                }
                            }
                            else {
                                $goat['lft'] = null;
                            }
                
                            if(array_key_exists(11, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][11] == "")
                                {
                                    $goat['kft'] = null;
                                }
                                else {
                                    $goat['kft'] = $this->health[$goat_id][11];
                                }
                            }
                            else {
                                $goat['kft'] = null;
                            }
                
                
                            if(array_key_exists(12, $this->health[$goat_id]))
                            {
                                if($this->health[$goat_id][12] == "")
                                {
                                    $goat['rtpcr'] = null;
                                }
                                else {
                                    $goat['rtpcr'] = $this->health[$goat_id][12];
                                }
                            }
                            else {
                                $goat['rtpcr'] = null;
                            }
                            
                            //this goArr will give total non-null entries, to insert into db,
                            // it should be more than 3.
                            $goArr = count(array_filter($goat, function($x) { return !empty($x); }));
                
                            //dd($goat_id, $goArr, $goat);
                            
                            if( $goArr > 3)
                            {

                                if(array_key_exists($goat_id, $this->health))
                                {
                                    $inserFirst = new Goathealth();
                                    $inserFirst->sop_id = $this->healthsop2_id;
                                    $inserFirst->goat_id = $goat_id;
                                    $inserFirst->save();
                                    
                                    $matchThese = ['goathealth_id'=> $inserFirst->goathealth_id];
                                    
                                    //dd($matchThese, $goat_id, $goat, $this->health);
                                    $result = Goathealth::updateOrCreate($matchThese, $goat);
                                    $this->messagex = null;
                                    if($result)
                                    {
                                        $this->gidArray = $this->getGoatIdHealthArray(Goat::where('herd_id', $this->herd_id)->get());
                    
                                        $this->messagex = "Data Posted Successfully";
                                        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Health Infos Recorded for Goat ID '.$goat_id);
                                    }
                                    else{
                                        $this->messagex = "Error: Data Not Posted";
                                        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Health Infos Not Recorded not Goat ID '.$goat_id);
                                    }
                                    // clear all the values before next insert
                                    unset($this->health[$goat_id]);
                                    $goat = array();
                                }
                            
                            }
                            else{
                                $this->messagex = "For Goat ID [".$this->goat_id."]: Must Enter Minimum One Field value";
                            }

                    }
                    else{
                        $this->messagex = "For Goat ID [".$this->goat_id."]: Must Enter Minimum One Field value";
                    }
        
                }
                else {
                  $this->messagex = "Refresh Page or For Goat ID [".$this->goat_id."]: Must Enter Minimum One Field value";
                }
    
            }
            else {
              $this->messagex = "Error: Refresh Form and Re-enter";
            }
        
    }

    public function resetHealthForm()
    {
        $this->healthsop_id = null;
        $this->healthsop2_id = null;
        $this->morning = null;
        $this->afternoon = null;
        $this->evening = null;
        $this->sch_code = null;
        $this->physical_inspection = null;
        $this->health_notes = null;
        $this->diagnosis = null;
        $this->suggestions = null;
        $this->healthremark = null;
        $this->healthlegend = null;
        $this->showDashButton = false;
        $this->dashInfo = true;
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Health Infos Form Reset');
    }

    public function getGoatIdHealthArray($inpArray)
    {
        //dd($inpArray);
        $darray = array();
        foreach($inpArray as $row)
        {
            $qr = Goathealth::where('goat_id', $row->goat_id)->where('date_observed', date('Y-m-d'))->get();
            //dd($qr);
            if(count($qr) > 0)
            {
              foreach($qr as $val)
              {
                $this->health[$row->goat_id][1] = $val->hb;
                $this->health[$row->goat_id][2] = $val->weight;
                $this->health[$row->goat_id][3] = $val->temperature;
                $this->health[$row->goat_id][4] = $val->resp_rate;
                $this->health[$row->goat_id][5] = $val->mucous_membrane;
                $this->health[$row->goat_id][6] = $val->rumen_contractions;

                $this->health[$row->goat_id][7] = $val->rbc;
                $this->health[$row->goat_id][8] = $val->platelet;
                $this->health[$row->goat_id][9] = $val->pcv;
                $this->health[$row->goat_id][10] = $val->lft;
                $this->health[$row->goat_id][11] = $val->kft;
                $this->health[$row->goat_id][12] = $val->rtpcr;
              }
              $darray[$row->goat_id] = true;
            }
            else{
              $darray[$row->goat_id] = false;
            }
        }
        //dd($darray);
        return $darray;
        //$this->error = array_fill(0, count($inpArray)+100, 'Not Collected');
    }
    
    public function immFitnessFailed($herd_id)
    {
        $this->herd_id = $herd_id;

        //set all other invisible panels false
        $this->viewHerdInf = false;
        $this->viewSingleGoatInfo = false;
        $this->viewEditHerdForm = false;
        
        $this->showDashButton = true;
        $this->dashInfo = false;
        
        $this->viewImmInf = false;
        
        $this->viewSerumForm = false;
        $this->viewSerumFailDeatils = false;
        
        $this->viewHealthForm = false;
        
        $totalCount = intval(Herd::where('herd_id', $herd_id)->value('total_count'));
        if($totalCount <= 0)
        {
            $this->failMsg = false;
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization Fitness Status Examined for Herd ID '.$herd_id);
        }

        $this->viewImmHCFailDeatils = true;

    }
    
    public function scFitnessFailed($herd_id)
    {
        $this->herd_id = $herd_id;

        //set all other invisible panels false
        $this->viewHerdInf = false;
        $this->viewSingleGoatInfo = false;
        $this->viewEditHerdForm = false;
        
        $this->showDashButton = true;
        $this->dashInfo = false;
        
        $this->viewImmInf = false;
        $this->viewImmHCFailDeatils = false;

        $this->viewSerumForm = false;
        
        $totalCount = intval(Herd::where('herd_id', $herd_id)->value('total_count'));
        if($totalCount <= 0)
        {
            $this->failMsg = false;
        }
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Serum Fitness Status Examined for Herd ID '.$herd_id);
        $this->viewSerumHCFailDeatils = true;

    }
    
    public function clearForImmunization($herd_id)
    {
        $this->immGreenLight = true;
        $this->immGreenLightMessage = "Not Coded: Green Light Given";
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Immunization Fitness Status Cleared for Herd ID '.$herd_id);
    }

    public function clearForPlaspheresis($herd_id)
    {
        $this->plasmaGreenLight = true;
        $this->plasmaGreenLightMessage = "Not Coded: Green Light Given";
        Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] Plasmapheresis Fitness Status Cleared for Herd ID '.$herd_id);
    }
    
    public function createNewEvent($herd_id, $sop_id)
    {
        $sopRepeat = Sop::where('sop_id', $sop_id)->first();
        
        if(intval($sopRepeat->repeat_time) != null ||  intval($sopRepeat->repeat_time) != "")
        {
            //now post to event table for calendar Display
            $today = date('Y-m-d');
            $newEvent = new Event();
            $newEvent->title = "Herd ".$herd_id." ".substr($sopRepeat->description, 0, 20);
            $newEvent->description = substr($sopRepeat->description, 0, 20)." ".$herd_id;
            $newEvent->start_date = date('Y-m-d H:i:s', strtotime($today." + ".intval($sopRepeat->repeat_time)." days"));
            $newEvent->priority = "normal";
           
            $newEvent->save();
            Log::channel('activity')->info('Logged in user [ '.Auth::user()->name.' ] New Event Recorded for Herd ID '.$herd_id);
            if($newEvent)
            {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}
