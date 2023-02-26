<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use DateTime;

use App\Models\Serum;
use App\Models\Goatsera;
use App\Models\Herd;

use App\Traits\Base;

trait SerumDataUpdateTrait
{
    use Base;
    // we need project id only
    public function serumDataUpdate($serum_id, $goat_id, $volume)
    {
        //dd($serum_id, $goat_id, $volume);
        //$totalVolume = 0;
        
        //$goatIdArray = Goatsera::where('serum_id', $serum_id)->pluck('goat_id')->toArray();
        
        $goatSeraUpd = new Goatsera();
        
        $goatSeraUpd->serum_id = $serum_id;
        $goatSeraUpd->goat_id = $goat_id;
        $goatSeraUpd->volume = $volume;
        
        $goatSeraUpd->save();
        $goatSeraUpd = null;
        
        $serVol = Serum::where('serum_id', $serum_id)->value('volume');
        $goatNum = Serum::where('serum_id', $serum_id)->value('number_goats');
        
        $herd_id = Serum::where('serum_id', $serum_id)->value('herd_id');
        $herdStrength = Herd::where('herd_id', $herd_id)->value('total_count');
        $seraCollected = Goatsera::where('serum_id', $serum_id)->count();
        
        if( $seraCollected == $herdStrength )
        {
            $status = 'complete';
        }
        else{
          $status = 'incomplete';
        }
        
        $result = Serum::where('serum_id', $serum_id)
                      ->update([
                      'number_goats' => $goatNum + 1,
                      'volume' => $serVol + $volume,
                      'status' => $status
                    ]);
        
        //push goat id into the imgoatarray variable
        $this->imGoatArray[$goat_id] = $volume;
        //dd($seraCollected, $herdStrength,$status );
        //return true;
    }

    public function herdStrengthByHerdId($herd_id)
    {
        $herdStrength = Herd::where('herd_id', $herd_id)->value('total_count');
    }

}
