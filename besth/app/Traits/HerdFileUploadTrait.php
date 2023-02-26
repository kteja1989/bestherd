<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Goat;
use App\Models\Mugshot;
use App\Models\Herd;
use App\Models\Health;
use App\Models\Goathealth;
use App\Models\Exitedgoat;
use App\Models\Facilityfile;
use App\Models\Goatfile;
use App\Models\Sop;

use App\Models\Sopfile;

use DateTime;

use App\Traits\Base;


trait HerdFileUploadTrait
{
    
    use Base;
    
    public function uploadHerdFiles($id, $filetype, $goatFiles)
    {
        
        //collectable information
        // 1. Extensions allowed
        // 2. size allowed per picture
        // 3. director
        // 4. desitnation path
        // 
        // return value
        // 1. filename saved.
        
        foreach ($goatFiles as $key => $value)
        {
            // allowed extensions images and for files
            
            $oFilename = $value->getClientOriginalName();
            $origExt = $value->getClientOriginalExtension();
        
            switch ($filetype) {
                
              case "selfie":
                    $allowedExts = ['jpeg', 'jpg'];
                    $check = in_array($origExt, $allowedExts);
                    $folder = "goats/selfie/".$id."/";
                break;
                
                case "health":
                    $allowedExts = ['jpeg', 'jpg'];
                    $check = in_array($origExt, $allowedExts);
                    $folder = "goats/health/".$id."/";
                break;
                
                case "docs":
                    $allowedExts = ['pdf', 'xls', 'xlsx'];
                    $check = in_array($origExt, $allowedExts);
                    $folder = "goats/docs/".$id."/";
                break;
                
                case "sops":
                    $allowedExts = ['pdf', 'xls', 'xlsx'];
                    $check = in_array($origExt, $allowedExts);
                    $folder = "public/sops/".$id."/";
                break;
                
              default:
                $check = false;
            }
        
            $destPath = $folder;
            
            //for testing, in reality, pass on the user's folder name fromm DB.
    
            if($check)
            {

                $code10 = $this->generateCode(10);
                $fileName = $code10."_".$id.".".$origExt;
                $fxt[$key] = $value->storeAs($destPath, $fileName);
                
                if($filetype == "selfie" || $filetype == "health")
                {
                    //now store the filename in db Mugshot
                    $nImage = new Mugshot();
                    $nImage->goat_id = $id;
                    $nImage->user_id = Auth::user()->id;
                    $nImage->user_name = Auth::user()->name;
                    $nImage->date_uploaded = date('Y-m-d');
                    $nImage->path = $destPath;
                    $nImage->image = $fileName;
                    $nImage->notes = "none";
                    $nImage->save();
                    
                    $result['imgmsg'] = "Message: Image Upload Successful";
                    $result['imgstatus'] = true;
                }
                
                if($filetype == "docs")
                {
                    //now store the filename in db Mugshot
                    if($id == 3)
                    {
                        $nFile = new Facilityfile();
                        $nFile->dept_id = $id;
                    }
                    else {
                        $nFile = new Goatfile();
                        $nFile->goat_id = $id;
                    }
                    
                    $nFile->user_id = Auth::user()->id;
                    $nFile->user_name = Auth::user()->name;
                    $nFile->date_uploaded = date('Y-m-d');
                    $nFile->path = $destPath;
                    $nFile->filename = $fileName;
                    $nFile->notes = "none";
                    $nFile->save();
                    
                    $result['docmsg'] = "Message: Document Upload Successful";
                    $result['docstatus'] = true;
                }
                
                if($filetype == "sops")
                {
                    // no separate db entry for SOPs as of now
                    /*
                    $nFile = new Sopfile();
                    
                    $nFile->dept_id = 3;
                    $nFile->user_id = Auth::user()->id;
                    $nFile->user_name = Auth::user()->name;
                    $nFile->date_uploaded = date('Y-m-d');
                    $nFile->path = $destPath;
                    $nFile->filename = $fileName;
                    $nFile->notes = "none";
                    $nFile->save();

                    $input['dept_id'] = 3;
                    $input['user_id'] = Auth::user()->id;
                    $input['user_name'] = Auth::user()->name;
                    $input['date_uploaded'] = date('Y-m-d');
                    $input['path'] = $destPath;
                    $input['filename'] = $fileName;
                    $input['notes'] = "none";
                    
                    $result = Sopfile::updateOrCreate($input);
                    */
                    
                    $res = Sop::where('sop_id', $id)->update([
                            'path' => $destPath,
                            'filename' => $fileName
                            ]);

                    $result['docstatus'] = true;
                }
            
            }
            else {
                $result['message'] = "Message: File types must be as indicated";
                $result['status'] = false;
            }
        
        }
        return $result;
    }
}