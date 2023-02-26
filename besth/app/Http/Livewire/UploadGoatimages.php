<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Herd;
use App\Models\Goat;
use App\Models\Mugshot;

// Traits used
use App\Traits\Base;

use App\Traits\HerdDashboardTrait;
use App\Traits\HerdFileUploadTrait;

use Image;

class UploadGoatimages extends Component
{
    use Base;
    use HerdDashboardTrait;
    use HerdFileUploadTrait;
        
    public $name = "Meissa-BEST";
    
    public $title = "Goat Image";

    public $herds, $dashInfo = true, $herdInfo, $viewGoatList, $curGoatList;
    public $scanError, $image, $img, $imageTag, $imgTag, $value=null;
    public $goatImage, $modalImage, $path, $image_id, $herd_id, $goat_id;

    public $images=[], $goat_ids=[], $results, $imagenotes, $camera;
    
    //panels
    public $viewHerdInf = false;
    public $viewSingleGoatInfo = false;
    
    protected $listeners = [
        'processImage'=>'processImage', 
        'snapShotSuccess'=> 'alertSuccess',
        'frontCamera' => 'switchToFront',
        'backCamera'  => 'switchToBack'
    ];
    
    public function render()
    {
        $this->herds = Herd::all();
        return view('livewire.upload-goatimages');
    }
    
    //....... All modal pop-up here .......//
    public function modalGoatImage($image_id)
    {
      $this->emit("openModal", 'goat-image',
                  ['image_id'=>$image_id]);
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
    
    public function fetchHerdInfo($herd_id)
    {
        $this->herd_id = $herd_id;
        $this->allHerds = Herd::where('category', '<>', 'quarantine')->get();
        $this->herdInfo = Herd::where('herd_id', $herd_id)->get();
        
        $this->curGoatList = Goat::where('herd_id', $herd_id)->get(); //orig
        //dd($this->herdInfo, $this->curGoatList);
        
        $this->viewGoatList = true;
        $this->viewHerdInf = true;
    }
    
    //individual goat information
    public function viewGoatDetails($goat_id)
    {
        $this->scanError = null;
        $this->scanGoatId = null;

        $this->goat_id = $goat_id;
        
        $this->goatDetails = Goat::where('herd_id', $this->herd_id)->where('goat_id', $goat_id)->first();
        $this->goatImgs = Mugshot::where('goat_id', $goat_id)->get();

        //dd($this->goatDetails);
        if($this->goatDetails != null)
        {
            $this->goatDetails->age = $this->monthsBetweenTwoDates($this->goatDetails->dob, date('Y-m-d'));
            //dispatch browser event to make the camera on.
            $this->dispatchBrowserEvent('camera-on', ['newImage' => $this->value]);
            $this->viewSingleGoatInfo = true;
        }
        else {
            $this->scanError = "Goat Id Not Found";
        }
    }
    
    public function updatedImagenotes()
    {
        $this->switchOnBack();
        $validatedData = $this->validate(
        [   
            'imagenotes'    => 'nullable|regex:/^[A-Za-z0-9-:;_. ]+$/',
        ],
        [
            'imagenotes.imagenotes' => ' :attribute must be Letter & Numbers.',
        ],
        [
            'imagenotes' => 'Image Notes'
        ]);
        $this->switchOnBack();
    }
    
    public function switchToFront()
    {
        $this->camera = "front";
        $this->dispatchBrowserEvent('cam-sel', ['cameraMsg' => $this->camera]);
    }
    
    public function switchToBack()
    {
        $this->camera = "back";
        $this->dispatchBrowserEvent('cam-sel', ['cameraMsg' => $this->camera]);
    }
    
    public function processImage($imgTag)
    {
        if($this->imagenotes == null) 
        {
            $this->imagenotes = "profile";
        }
        
        //get the image from input field and remove the tags
        $imageBlob = str_replace('data:image/jpeg;base64,', '', $imgTag);
        // erase the space
        $imageBlob = str_replace(' ', '+', $imageBlob);
        // decode from base64
        $imageF = base64_decode($imageBlob);
        
        //storage paths and file name

        $base = "app/public/";
        $folder = "goats/selfie/".$this->goat_id."/";
        $code10 = $this->generateCode(10);
        $fileName = $code10."_".$this->goat_id.".jpeg";
        
        $dirPath = storage_path($base.$folder); 
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
        }

        //saving raw file captured without writing
        Storage::disk('public')->put($folder.$fileName, $imageF);

        //intervention processing for labeling
        $imgFile = Image::make($imageF);
        
        $imprinText = $this->goat_id." D: ".date('d-m-Y');
        
        $imgFile->text('----- Goat ID '.$imprinText, 120, 40, function($font) { 
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(20);  
            $font->color('#ffffff');  
            $font->align('center');  
            $font->valign('bottom');  
            //$font->angle(180);  
        })->save(storage_path($base.$folder.$fileName)); 
        

        //now store the filename in db Mugshot
        $nImage = new Mugshot();
        $nImage->goat_id = $this->goat_id;
        $nImage->user_id = Auth::user()->id;
        $nImage->user_name = Auth::user()->name;
        $nImage->date_uploaded = date('Y-m-d');
        $nImage->path = $folder;
        $nImage->image = $fileName;
        $nImage->notes = $this->imagenotes;
        //dd($nImage);
        $nImage->save();

       // dd('Image uploaded successfully: '.$fileName);
       $message = "Image Saved Successfully";
       $this->alertSuccess($message);
       $this->dispatchBrowserEvent('camera-on', ['newImage' => $this->value]);
       
    }
    
    
    //sweet Alerts
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertSuccess($message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => $message]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertError($message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'error',  'message' => $message]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertInfo($message)
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'info',  'message' => $message]);
    }
    
}
