<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
//live import from excel
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

use App\Traits\Base;
use App\Models\Goat;
use App\Models\Tempgoat;
use App\Models\Herd;


class GoatImport implements ToCollection, WithHeadingRow
{
    use Base;
    use Importable;
    
    public $minAge = 160, $maxAge = 570;
    public $count, $badRows = [], $badRowCount, $errors=[], $ermsg = [], $test = [];
    public $upsuces = [];
    
    public function collection(Collection $rows)
    {
        $impArray = array_filter($rows->toArray(), 'array_filter');
        $finArray = array_filter($impArray);
        
        $this->count = 0;
        $badRowCount = 0;
        $rowNum = 1;
        
        foreach($finArray as $row)
        {   
            
            $rowNum = $rowNum + 1;
            
            //why not match and fix the herd id based on 
            //herd category: quarantine male or female & gender.
            $hgInf = Herd::where('category', 'quarantine')->where('gender', $row['gender'])->first();
            
            if($hgInf != null)
            {
                //gender matched herd id
                $herd_id = $hgInf->herd_id; 
    
                //check here whether capacity reached or not
                $totalSize = $hgInf->total_size;
                
                //increade herd count by each additon
                $totalCount = $hgInf->total_count;
    
                $diff = $totalSize - $totalCount;

                if( $diff-$this->count > 0)
                {
                    $rx = [];
                    $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['dob']))->format('Y-m-d');
                    $rx['dob'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['dob']))->format('Y-m-d');
                    
                    $gender = $row['gender'];
                    $rx['gender'] = $row['gender'];
                    
                    $age = $this->monthsBetweenTwoDates($dob, date('Y-m-d'));
                    $age_unit = "months";
                    
                    $source = $row['source'];
                    $rx['source'] = $row['source'];
                    
                    $gb = $row['genetic_background'];
                    $rx['gb'] = $row['genetic_background'];
                    
                    $sr = $row['source_reference'];
                    $rx['sr'] = $row['source_reference'];
                    
                    $srf = $row['source_ref_file'];
                    $rx['srf'] = $row['source_ref_file'];
                    
                    $qs = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['quarantine_start']))->format('Y-m-d');
                    $rx['qs'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['quarantine_start']))->format('Y-m-d');
                    
                    //$qe = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['quarantine_end']))->format('Y-m-d');
                    //$indate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['inducted_date']))->format('Y-m-d');
                    
                    // add 21 days to the quarantine date
                    $qe = date('Y-m-d', strtotime($qs." +21 days"));

                    if($this->dobValidation($rx))
                    {
                        if($this->sourceValidation($rx))
                        {
                            if($this->geneticBackgroundValidation($rx))
                            {
                                if($this->sourceRefValidation($rx) )
                                {
                                    if($this->sourceRefFileValidation($rx))
                                    {
                                        if($this->quarantineStartValidation($rx))
                                        {
                                            $newTGoat = new Tempgoat();
                                            $newTGoat->herd_id             = $herd_id;
                                            $newTGoat->dob                 = $dob;
                                            $newTGoat->gender              = $gender;
                                            $newTGoat->age                 = $age;
                                            $newTGoat->age_unit            = "months";
                                            $newTGoat->source              = $source;
                                            $newTGoat->genetic_background  = $gb;
                                            $newTGoat->source_reference    = $sr;
                                            $newTGoat->source_ref_file     = $srf;
                                            $newTGoat->quarantine_start    = $qs;
                                            $newTGoat->quarantine_end      = $qe;
                                            $newTGoat->inducted_date       = date('Y-m-d');
                                            $newTGoat->status              = "active";
                                            //dd($newTGoat);
                                            $saved = $newTGoat->save();
                                            //$saved = true; //for testing without saving to db
                                            if($saved) {
                                                $this->count = $this->count+1;
                                                $this->upsuces[] = "Data Saving Successful for Row ".$rowNum;
                                            }
                                            else {
                                                $this->ermsg[] = "Data Saving Failed Row ".$rowNum;
                                                $this->badRowCount = $badRowCount + 1;
                                            }
                                        }
                                        else {
                                            $this->ermsg[] = "Quarantine Start Empty/Wrong for Row ".$rowNum.": ' ".$rx['qs']." ' ";
                                            $this->badRowCount = $badRowCount + 1;
                                        }
                                    }
                                    else {
                                        $this->ermsg[] = "Source Ref File Empty/Wrong for Row ".$rowNum.": ' ".$rx['srf']." ' ";
                                        $this->badRowCount = $badRowCount + 1;
                                    }
                                }
                                else {
                                    $this->ermsg[] = "Source Ref Empty/Wrong for Row ".$rowNum.": ' ".$rx['sr']." ' ";
                                    $this->badRowCount = $badRowCount + 1;
                                }
                            }
                            else {
                                $this->ermsg[] = "Genetic Background Empty/Wrong for Row ".$rowNum.": ' ".$rx['gb']." ' ";
                                $this->badRowCount = $badRowCount + 1;
                            }
                        }
                        else {
                            $this->ermsg[] = "Source Empty/Wrong for Row ".$rowNum.": ' ".$rx['source']." ' ";
                            $this->badRowCount = $badRowCount + 1;
                        }
                    }
                    else {
                        $this->ermsg[] = "DoB Empty/Wrong for Row ".$rowNum.": ' ".$rx['dob']." ' ";
                        $this->badRowCount = $badRowCount + 1;
                    }
                }
                else {
                    $this->ermsg[] = "Herd Capacity Exceeded by Row ".$rowNum;
                }
            }
            else {
                $this->ermsg[] = "Gender Empty/Wrong in Row ".$rowNum.": ' ".$row['gender']." ' ";
                $this->badRowCount = $badRowCount + 1;
            }
        }
        return;
    }
    
    public function dobValidation($rx)
    {
        //validate aga of the goat before entry
        $date1 = $rx['dob'];
        $days = $this->daysBetween($date1,  date('Y-m-d'));
                
        if($days > $this->minAge && $days < $this->maxAge)
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function sourceValidation($rx)
    {
        if($rx['source'] != null)
        {
            if (preg_match("/^[\w\-]+$/", $rx['source'])) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            return false;
        }
    }
   
    public function geneticBackgroundValidation($rx)
    {
        if($rx['gb'] != null)
        {
            if (preg_match("/^[\w\-]+$/", $rx['gb'])) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public function sourceRefValidation($rx)
    {
        if($rx['sr'] != null)
        {
            if (preg_match("/^[\w\-]+$/", $rx['sr'])) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public function sourceRefFileValidation($rx)
    {
        if($rx['srf'] != null)
        {
            if (preg_match("/^[\w\-]+$/", $rx['srf'])) 
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
    
    public function quarantineStartValidation($rx)
    {
        $dateDob = $rx['dob'];
        $qStart = $rx['qs'];
        if(strtotime($dateDob) < strtotime($qStart))
        {
            return true;
        }
        else {
            return false;
        }
    }

}
