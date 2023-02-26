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
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

use App\Traits\Base;
use App\Models\Goat;
use App\Models\Herd;
use App\Models\Goathealth;

class GoathealthImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    use Base;

    public function collection(Collection $rows)
    {
        //$impArray = $rows->toArray();
        $success = array();
        $failed = array();

        $impArray = array_filter($rows->toArray(), 'array_filter');
        //dd($impArray);
        $finArray = array_filter($impArray);
        //dd($finArray);
        $totalGoatEntries = Goat::where('status', 'active')->pluck('goat_id')->toArray();

        foreach($finArray as $row)
        {
            if(in_array($row['goat_id'], $totalGoatEntries))
            {
                $goat_id = $row['goat_id'];
                $date_observed = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['date_observed']))->format('Y-m-d');
                $closure_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row['closure_date']))->format('Y-m-d');

                //$newGH = new Goathealth();
                $matchThese = ['goat_id'=> $goat_id, 'date_observed'=> $date_observed];
                
                $newGH['sop_id']              = $row['sop_id'];
                $newGH['hb']                  = $row['hb'];
                $newGH['weight']              = $row['weight'];
                $newGH['resp_rate']           = $row['resp_rate'];
                $newGH['temperature']         = $row['temperature'];
                $newGH['mucous_membrane']     = $row['mucous_membrane'];
                $newGH['rumen_contractions']  = $row['rumen_contractions'];
                $newGH['rbc']                 = $row['rbc'];
                $newGH['platelet']            = $row['platelet'];
                $newGH['pcv']                 = $row['pcv'];
                $newGH['lft']                 = $row['lft'];
                $newGH['kft']                 = $row['kft'];
                $newGH['rtpcr']               = $row['rtpcr'];
                $newGH['observations']        = $row['observations'];

                $newGH['action_taken']        = $row['action_taken'];
                $newGH['closure']             = $row['closure'];
                $newGH['closure_date']        = $closure_date;
                $newGH['closure_action']      = $row['closure_action'];
                //dd($newGH);
                $result = Goathealth::updateOrCreate($matchThese, $newGH);

                if($result)
                {
                    $success = $row['goat_id'];
                }
                else {
                   $failed = $row['goat_id'];
                }
            }
            else {
                $failed = $row['goat_id'];
            }
        }
        $result['success'] = $success;
        $result['failed'] = $failed;
        return $result;
    }
}
