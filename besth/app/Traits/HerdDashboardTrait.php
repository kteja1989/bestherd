<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Goat;
use App\Models\Herd;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Serum;
use App\Models\Goatsera;
use App\Models\Health;
use App\Models\Goathealth;
use App\Models\Exitedgoat;

use DateTime;

use App\Traits\Base;


trait HerdDashboardTrait
{
    use Base;

    public function herdInfoCount()
    {
      $hif = array();
      $total_size = 0;
      $total_count = 0;
      $toal_vacancy = 0;

      $hinfo = Herd::where('status', 'Active')->get();

      $test = array();
      $da2 = array();
      $da3 = array();
      array_push($test, count($hinfo));
      foreach($hinfo as $row)
      {
        $da2[] = $row->herd_id;
        $datotal_size = $row->total_size;
        $datotal_count = $row->total_count;
        $datoal_vacancy = $row->total_size - $row->total_count;
        $da3 = [$datotal_size, $datotal_count, $datoal_vacancy];
        array_push($test, $da3);
        unset($da3);
      }
      $rr = json_encode($da2, JSON_NUMERIC_CHECK);
      //dd($rr, $test);
      $hif['count'] = count($hinfo);
      $hif['total_size'] = Herd::where('status', 'Active')->sum('total_size');
      $hif['total_count'] = Herd::where('status', 'Active')->sum('total_count');
      $hif['toal_vacancy'] = $hif['total_size'] - $hif['total_count'];

       array_push($test, $rr);
      //dd($test);
      //return $test;
      $test['hif'] = $hif;
      return $test;
    }

    public function liveGoatCount()
    {
        return Goat::where('status', 'active')->count();
    }

    public function sickGoatCount()
    {
        return Herd::where('category', 'sick')->sum('total_count');
    }

    public function deadGoatCount()
    {
        return Exitedgoat::where('status', 'dead')->count();
    }

    public function retiredGoatCount()
    {
        return Exitedgoat::where('status', 'retired')->count();
    }

    public function agedGoatCount()
    {
        $sd10y = date('Y-m-d', strtotime("-120 months"));
        $ot10y = Goat::where('dob', '<=', $sd10y)
                        //->where('dob', '>=', $sd10y)
                        ->count();

        $sd09y = date('Y-m-d', strtotime("-108 months"));
        $ot09y = Goat::where('dob', '<=', $sd10y)
                        ->where('dob', '>=', $sd10y)
                        ->count();

        $sd08y = date('Y-m-d', strtotime("-96 months"));
        $ot08y = Goat::where('dob', '<=', $sd08y)
                        ->where('dob', '>=', $sd09y)
                        ->count();

        $sd07y = date('Y-m-d', strtotime("-84 months"));
        $ot07y = Goat::where('dob', '<=', $sd07y)
                        ->where('dob', '>=', $sd08y)
                        ->count();

        $sd06y = date('Y-m-d', strtotime("-72 months"));
        $ot06y = Goat::where('dob', '<=', $sd06y)
                        ->where('dob', '>=', $sd07y)
                        ->count();

        $sd05y = date('Y-m-d', strtotime("-60 months"));
        $ot05y = Goat::where('dob', '<=', $sd05y)
                        ->where('dob', '>=', $sd06y)
                        ->count();

        $sd04y = date('Y-m-d', strtotime("-48 months"));
        $ot04y = Goat::where('dob', '<=', $sd04y)
                        ->where('dob', '>=', $sd05y)
                        ->count();

        $sd03y = date('Y-m-d', strtotime("-36 months"));
        $ot03y = Goat::where('dob', '<=', $sd03y)
                        ->where('dob', '>=', $sd04y)
                        ->count();

        $sd02y = date('Y-m-d', strtotime("-24 months"));
        $ot02y = Goat::where('dob', '<=', $sd02y)
                        ->where('dob', '>=', $sd03y)
                        ->count();
        
        $sd01y = date('Y-m-d', strtotime("-12 months"));
        $ot01y = Goat::where('dob', '<=', $sd01y)
                        ->where('dob', '>=', $sd02y)
                        ->count();
                        
        $sd00y = date('Y-m-d', strtotime("-00 months"));
        $ot00y = Goat::where('dob', '<=', $sd00y)
                        ->where('dob', '>=', $sd01y)
                        ->count();

        $dar = array();
        $ab = array();
        $abarray = array();
        
        if($ot00y > 0 )
        {
            $abarray['age_band'] = "0-1";
            $abarray['count'] = $ot00y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot01y > 0 )
        {
            $abarray['age_band'] = "1-2";
            $abarray['count'] = $ot01y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot02y > 0 )
        {
            $abarray['age_band'] = "2-3";
            $abarray['count'] = $ot02y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot03y > 0 )
        {
            $abarray['age_band'] = "3-4";
            $abarray['count'] = $ot03y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot04y > 0 )
        {
            $abarray['age_band'] = "4-5";
            $abarray['count'] = $ot04y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot05y > 0 )
        {
            $abarray['age_band'] = "5-6";
            $abarray['count'] = $ot05y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot06y > 0 )
        {
            $abarray['age_band'] = "6-7";
            $abarray['count'] = $ot06y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot07y > 0 )
        {
            $abarray['age_band'] = "7-8";
            $abarray['count'] = $ot07y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot08y > 0 )
        {
            $abarray['age_band'] = "8-9";
            $abarray['count'] = $ot08y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot09y > 0 )
        {
            $abarray['age_band'] = "9-10";
            $abarray['count'] = $ot09y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        if($ot10y > 0 )
        {
            $abarray['age_band'] = ">10";
            $abarray['count'] = $ot10y;
            array_push($dar, $abarray);
            $abarray = array();
        }
        
        $agc['ot00y'] = $ot00y;
        $agc['ot01y'] = $ot01y;
        $agc['ot02y'] = $ot02y;
        $agc['ot03y'] = $ot03y;
        $agc['ot04y'] = $ot04y;
        $agc['ot05y'] = $ot05y;
        $agc['ot06y'] = $ot06y;
        $agc['ot07y'] = $ot07y;
        $agc['ot08y'] = $ot08y;
        $agc['ot09y'] = $ot09y;
        $agc['ot10y'] = $ot10y;

        $abx['agc'] = $agc;
        $abx['grp'] = $dar;

        return $abx;
    }

    public function agedGoatProfile()
    {
        $sd10y = date('Y-m-d', strtotime("-120 months"));
        $ot10y = Goat::where('dob', '<=', $sd10y)
                        ->where('dob', '>=', $sd10y)
                        ->where('status', 'active')
                        ->get();

        $sd09y = date('Y-m-d', strtotime("-108 months"));
        $ot09y = Goat::where('dob', '<=', $sd10y)
                        ->where('dob', '>=', $sd10y)
                        ->where('status', 'active')
                        ->get();

        $sd08y = date('Y-m-d', strtotime("-96 months"));
        $ot08y = Goat::where('dob', '<=', $sd08y)
                        ->where('dob', '>=', $sd09y)
                        ->where('status', 'active')
                        ->get();

        $sd07y = date('Y-m-d', strtotime("-84 months"));
        $ot07y = Goat::where('dob', '<=', $sd07y)
                        ->where('dob', '>=', $sd08y)
                        ->where('status', 'active')
                        ->get();

        $sd06y = date('Y-m-d', strtotime("-72 months"));
        $ot06y = Goat::where('dob', '<=', $sd06y)
                        ->where('dob', '>=', $sd07y)
                        ->where('status', 'active')
                        ->get();

        $sd05y = date('Y-m-d', strtotime("-60 months"));
        $ot05y = Goat::where('dob', '<=', $sd05y)
                        ->where('dob', '>=', $sd06y)
                        ->where('status', 'active')
                        ->get();

        $sd04y = date('Y-m-d', strtotime("-48 months"));
        $ot04y = Goat::where('dob', '<=', $sd04y)
                        ->where('dob', '>=', $sd05y)
                        ->where('status', 'active')
                        ->get();

        $sd03y = date('Y-m-d', strtotime("-36 months"));
        $ot03y = Goat::where('dob', '<=', $sd03y)
                        ->where('dob', '>=', $sd04y)
                        ->where('status', 'active')
                        ->get();

        $sd02y = date('Y-m-d', strtotime("-24 months"));
        $ot02y = Goat::where('dob', '<=', $sd02y)
                        ->where('dob', '>=', $sd03y)
                        ->where('status', 'active')
                        ->get();
                        
        
        $sd01y = date('Y-m-d', strtotime("-12 months"));
        $ot01y = Goat::where('dob', '<=', $sd01y)
                        ->where('dob', '>=', $sd02y)
                        ->where('status', 'active')
                        ->get();
                        
        $agp['ot01y'] = $ot01y;
        
        
        $agp['ot02y'] = $ot02y;
        $agp['ot03y'] = $ot03y;
        $agp['ot04y'] = $ot04y;
        $agp['ot05y'] = $ot05y;
        $agp['ot06y'] = $ot06y;
        $agp['ot07y'] = $ot07y;
        $agp['ot08y'] = $ot08y;
        $agp['ot09y'] = $ot09y;
        $agp['ot10y'] = $ot10y;

        return $agp;
    }

    public function activeImmunizations()
    {
        return Immunization::where('status', 'complete')->count();
    }

    public function incompleteImmunizations()
    {
        return Immunization::where('status', 'incomplete')->count();
    }
    
    public function getHbParam()
    {
        $dum = array();
        $da = array();
        $dax = array();
        $hb = Goathealth::get()->pluck('hb','goat_id');
        foreach($hb as $key => $row)
        {
            if($row == "0.0" || $row == null){
                unset($hb[$key]);
            }
            else {
                $dax[] = $key;
                $da[] = (float)$row;
            }
        }
        array_push($dum, $dax);
        array_push($dum, $da);
        //dd($dum);
        
        return $dum;
    }
    
    public function getGoathealthParams()
    {
        $xaxis = array();

        $dum = array();

        $xys = array();

        $hb = array();
        $wt = array();
        $tp = array();
        $rr = array();
        $mm = array();
        $rc = array();
        $rbc = array();
        $plt = array();
        $pcv = array();
        $lft = array();
        $kft = array();
        $rtpcr = array();
        $pair = array();

        $mhb = 0.0;
        $mwt = 0.0;
        $mtp = 0.0;
        $mrr = 0.0;
        $mmm = 0.0;
        $mrc = 0.0;
        $mrbc = 0.0;
        $mplt = 0.0;
        $mpcv = 0.0;
        $mlft = 0.0;
        $mkft = 0.0;
        $mrtpcr = 0.0;
        
        $hbscat[] = null;
        $wtscat[] = null;
        $tpscat[] = null;
        $rrscat[] = null;
        $mmscat[] = null;
        $rcscat[] = null;
        $rbcscat[] = null;
        $pltscat[] = null;
        $pcvscat[] = null;
        $lftscat[] = null;
        $kftscat[] = null;
        $rtpcrscat[] = null;
        
        $maxDate = Goathealth::all()->max('date_observed');

        $gha = Goathealth::where('date_observed', $maxDate)->get();
        //dd($gha, count($gha));
        if(count($gha) > 0 )
        {
            foreach($gha as $key => $row)
            {
              if((float)$row->hb != 0.0 || (float)$row->hb != null)
              {
                $xaxis[] = $key;
                $xyhb['x'] = "1";
                $xyhb['y'] = (float)$row->hb;
                $mhb = $mhb + (float)$row->hb;
                $hbscat[] = $xyhb;
              }
              else{
                $hbscat[] = null;
              }

              if((float)$row->weight != 0.0 || (float)$row->weight != null)
              {
                $xywt['x'] = "2";
                $xywt['y'] = (float)$row->weight;
                $mwt = $mwt + (float)$row->weight;
                $wtscat[] = $xywt;
              }
              else{
                $wtscat[] = null;
              }

              if((float)$row->temperature != 0.0 || (float)$row->temperature != null)
              {
                $xytp['x'] = "3";
                $xytp['y'] = (float)$row->temperature;
                $mtp = $mtp + (float)$row->temperature;
                $tpscat[] = $xytp;
              }
              else{
                $tpscat[] = null;
              }

              if((float)$row->resp_rate != 0.0 || (float)$row->resp_rate != null)
              {
                $xyrr['x'] = "4";
                $xyrr['y'] = (float)$row->resp_rate;
                $mrr = $mrr + (float)$row->resp_rate;
                $rrscat[] = $xyrr;
              }
              else{
                $rrscat[] = null;
              }

              if((float)$row->mucous_membrane != 0.0 || (float)$row->mucous_membrane != null)
              {
                $xymm['x'] = "5";
                $xymm['y'] = (float)$row->mucous_membrane;
                $mmm = $mmm + (float)$row->mucous_membrane;
                $mmscat[] = $xymm;
              }
              else{
                $mmscat[] = null;
              }

              if((float)$row->rumen_contractions != 0.0 || (float)$row->rumen_contractions != null)
              {
                $xyrc['x'] = "6";
                $xyrc['y'] = (float)$row->rumen_contractions;
                $mrc = $mrc + (float)$row->rumen_contractions;
                $rcscat[] = $xyrc;
              }
              else{
                $rcscat[] = null;
              }


              if((float)$row->rbc != 0.0 || (float)$row->rbc != null)
              {
                $xyrbc['x'] = "7";
                $xyrbc['y'] = (float)$row->rbc;
                $mrbc = $mrbc + (float)$row->rbc;
                $rbcscat[] = $xyrbc;
              }
              else{
                $rbcscat[] = null;
              }

              if((float)$row->platelet != 0.0 || (float)$row->platelet != null)
              {
                $xyplt['x'] = "8";
                $xyplt['y'] = (float)$row->platelet/100000;
                $mplt = $mplt + (float)$row->platelet/100000;
                $pltscat[] = $xyplt;
              }
              else{
                $pltscat[] = null;
              }

              if((float)$row->pcv != 0.0 || (float)$row->pcv != null)
              {
                $xypcv['x'] = "9";
                $xypcv['y'] = (float)$row->pcv;
                $mpcv = $mpcv + (float)$row->pcv;
                $pcvscat[] = $xypcv;
              }
              else{
                $pcvscat[] = null;
              }

              if((float)$row->lft != 0.0 || (float)$row->lft != null)
              {
                $xylft['x'] = "10";
                $xylft['y'] = (float)$row->lft;
                $mlft = $mlft + (float)$row->lft;
                $lftscat[] = $xylft;
              }
              else{
                $lftscat[] = null;
              }

              if((float)$row->kft != 0.0 || (float)$row->kft != null)
              {
                $xykft['x'] = "11";
                $xykft['y'] = (float)$row->kft;
                $mkft = $mkft + (float)$row->kft;
                $kftscat[] = $xykft;
              }
              else{
                $kftscat[] = null;
              }

              if((float)$row->rtpcr != 0.0 || (float)$row->rtpcr != null)
              {
                $xyrtpcr['x'] = "12";
                $xyrtpcr['y'] = (float)$row->rtpcr;
                $mrtpcr = $mrtpcr + (float)$row->rtpcr;
                $rtpcrscat[] = $xyrtpcr;
              }
              else{
                $rtpcrscat[] = null;
              }
            }
        }

        $dum['date_observed'] = $maxDate;
        $dum['xaxis'] = $xaxis;
        if(!empty($hbscat))
        {
          $dum['mhb']  = $mhb/count($hbscat);
        }
        else{
          $dum['mhb']  = $mhb;
        }

        if(!empty($wtscat))
        {
          $dum['mwt']  = $mwt/count($wtscat);
        }
        else{
          $dum['mwt']  = null;
        }

        if(!empty($tpscat))
        {
          $dum['mtp']  = $mtp/count($tpscat);
        }
        else{
          $dum['mtp']  = $mtp;
        }

        if(!empty($rrscat))
        {
          $dum['mrr']  = $mrr/count($tpscat);
        }
        else{
          $dum['mrr']  = $mrr;
        }

        if(!empty($mmscat))
        {
          $dum['mmm']  = $mmm/count($mmscat);
        }
        else{
          $dum['mmm']  = $mmm;
        }

        if(!empty($rcscat))
        {
          $dum['mrc']  = $mrc/count($rcscat);
        }
        else{
          $dum['mrc']  = $mrc;
        }

        if(!empty($rbcscat))
        {
          $dum['mrbc']  = $mrbc/count($rbcscat);
        }
        else{
          $dum['mrbc']  = $mrbc;
        }

        if(!empty($pltscat))
        {
          $dum['mplt']  = $mplt/count($pltscat);
        }
        else{
          $dum['mplt']  = $mplt;
        }

        if(!empty($pcvscat))
        {
          $dum['mpcv']  = $mpcv/count($pcvscat);
        }
        else{
          $dum['mpcv']  = $mpcv;
        }

        if(!empty($lftscat))
        {
          $dum['mlft']  = $mlft/count($lftscat);
        }
        else{
          $dum['mlft']  = $mlft;
        }

        if(!empty($kftscat))
        {
          $dum['mkft']  = $mkft/count($kftscat);
        }
        else{
          $dum['mkft']  = $mkft;
        }

        /*
        $dum['mwt']  = $mwt/count($wtscat);
        $dum['mtp']  = $mtp/count($tpscat);
        $dum['mrr']  = $mrr/count($rrscat);
        $dum['mmm']  = $mmm/count($mmscat);
        $dum['mrc']  = $mrc/count($rcscat);
        $dum['mrbc'] = $mrbc/count($rbcscat);
        $dum['mplt'] = $mplt/count($pltscat);
        $dum['mpcv'] = $mpcv/count($pcvscat);
        $dum['mlft'] = $mlft/count($lftscat);
        $dum['mkft'] = $mkft/count($kftscat);
        */
        $dum['mrtpcr']  = $rtpcr;

        $dum['hbscat']  = $hbscat;
        $dum['wtscat']  = $wtscat;
        $dum['tpscat']  = $tpscat;
        $dum['rrscat']  = $rrscat;
        $dum['mmscat']  = $mmscat;
        $dum['rcscat']  = $rcscat;
        $dum['rbcscat'] = $rbcscat;
        $dum['pltscat'] = $pltscat;
        $dum['pcvscat'] = $pcvscat;
        $dum['lftscat'] = $lftscat;
        $dum['kftscat'] = $kftscat;
        $dum['rtpcrscat'] = $rtpcrscat;
        //dd($dum['scat']);
        //dd($dum);
        return $dum;
    }
    
    public function getSingleGoathealthParamsById($goat_id)
    {
        $xaxis = array();
        $dum = array();
        $xys = array();
        $hb = array();
        $wt = array();
        $tp = array();
        $rr = array();
        $mm = array();
        $rc = array();
        $rbc = array();
        $plt = array();
        $pcv = array();
        $lft = array();
        $kft = array();
        $rtpcr = array();
        $pair = array();
        
        $hbscat = array();
        $wtscat = array();
        $tpscat = array();
        $rrscat = array();
        $mmscat = array();
        $rcscat = array();
        $rbcscat = array();
        $pltscat = array();
        $pcvscat = array();
        $lftscat = array();
        $kftscat = array();
        $rtpcrscat = array();

        $mhb = 0.0;
        $mwt = 0.0;
        $mtp = 0.0;
        $mrr = 0.0;
        $mmm = 0.0;
        $mrc = 0.0;
        $mrbc = 0.0;
        $mplt = 0.0;
        $mpcv = 0.0;
        $mlft = 0.0;
        $mkft = 0.0;
        $mrtpcr = 0.0;

        $maxDate = Goathealth::all()->max('date_observed');

        $gha = Goathealth::where('goat_id', $goat_id)->get();

        if(count($gha) > 0 )
        {
            foreach($gha as $key => $row)
            {

              if((float)$row->hb != 0.0 || (float)$row->hb != null)
              {
                $xaxis[] = $key;
                $xyhb['x'] = "1";
                $xyhb['y'] = (float)$row->hb;
                $mhb = $mhb + (float)$row->hb;
                $hbscat[] = $xyhb;
              }

              if((float)$row->weight != 0.0 || (float)$row->weight != null)
              {
                $xywt['x'] = "2";
                $xywt['y'] = (float)$row->weight;
                $mwt = $mwt + (float)$row->weight;
                $wtscat[] = $xywt;
              }
              

              if((float)$row->temperature != 0.0 || (float)$row->temperature != null)
              {
                $xytp['x'] = "3";
                $xytp['y'] = (float)$row->temperature;
                $mtp = $mtp + (float)$row->temperature;
                $tpscat[] = $xytp;
              }

              if((float)$row->resp_rate != 0.0 || (float)$row->resp_rate != null)
              {
                $xyrr['x'] = "4";
                $xyrr['y'] = (float)$row->resp_rate;
                $mrr = $mrr + (float)$row->resp_rate;
                $rrscat[] = $xyrr;
              }

              if((float)$row->mucous_membrane != 0.0 || (float)$row->mucous_membrane != null)
              {
                $xymm['x'] = "5";
                $xymm['y'] = (float)$row->mucous_membrane;
                $mmm = $mmm + (float)$row->mucous_membrane;
                $mmscat[] = $xymm;
              }

              if((float)$row->rumen_contractions != 0.0 || (float)$row->rumen_contractions != null)
              {
                $xyrc['x'] = "6";
                $xyrc['y'] = (float)$row->rumen_contractions;
                $mrc = $mrc + (float)$row->rumen_contractions;
                $rcscat[] = $xyrc;
              }

              if((float)$row->rbc != 0.0 || (float)$row->rbc != null)
              {
                $xyrbc['x'] = "7";
                $xyrbc['y'] = (float)$row->rbc;
                $mrbc = $mrbc + (float)$row->rbc;
                $rbcscat[] = $xyrbc;
              }

              if((float)$row->platelet != 0.0 || (float)$row->platelet != null)
              {
                $xyplt['x'] = "8";
                $xyplt['y'] = (float)$row->platelet/100000;
                $mplt = $mplt + (float)$row->platelet/100000;
                $pltscat[] = $xyplt;
              }

              if((float)$row->pcv != 0.0 || (float)$row->pcv != null)
              {
                $xypcv['x'] = "9";
                $xypcv['y'] = (float)$row->pcv;
                $mpcv = $mpcv + (float)$row->pcv;
                $pcvscat[] = $xypcv;
              }

              if((float)$row->lft != 0.0 || (float)$row->lft != null)
              {
                $xylft['x'] = "10";
                $xylft['y'] = (float)$row->lft;
                $mlft = $mlft + (float)$row->lft;
                $lftscat[] = $xylft;
              }

              if((float)$row->kft != 0.0 || (float)$row->kft != null)
              {
                $xykft['x'] = "11";
                $xykft['y'] = (float)$row->kft;
                $mkft = $mkft + (float)$row->kft;
                $kftscat[] = $xykft;
              }

              if((float)$row->rtpcr != 0.0 || (float)$row->rtpcr != null)
              {
                $xyrtpcr['x'] = "12";
                $xyrtpcr['y'] = (float)$row->rtpcr;
                $mrtpcr = $mrtpcr + (float)$row->rtpcr;
                $rtpcrscat[] = $xyrtpcr;
              }
            }
        }

        $dum['goat_id'] = $goat_id;
        $dum['date_observed'] = $maxDate;
        $dum['xaxis'] = $xaxis;
        
        if(!empty($hbscat))
        {
            $dum['mhb']  = $mhb/count($hbscat);
        }
        else{
            $dum['mhb'] = $mhb;
        }
        
        if(!empty($wtscat))
        {
            $dum['mwt']  = $mwt/count($wtscat);
        }
        else{
            $dum['mwt'] = $mwt;
        }
        
        
        if(!empty($tpscat))
        {
            $dum['mtp']  = $mtp/count($tpscat);
        }
        else{
            $dum['mtp'] = $mtp;
        }
        
        if(!empty($rrscat))
        {
            $dum['mrr']  = $mrr/count($rrscat);
        }
        else{
            $dum['mrr'] = $mrr;
        }
        
        if(!empty($mmscat))
        {
            $dum['mmm']  = $mmm/count($mmscat);
        }
        else{
            $dum['mmm'] = $mmm;
        }
        
        if(!empty($rcscat))
        {
            $dum['mrc']  = $mrc/count($rcscat);
        }
        else{
            $dum['mrc'] = $mrc;
        }
        
        if(!empty($rbcscat))
        {
            $dum['mrbc'] = $mrbc/count($rbcscat);
        }
        else{
            $dum['mrbc'] = $mrbc;
        }
        
        if(!empty($pltscat))
        {
            $dum['mplt'] = $mplt/count($pltscat);
        }
        else{
            $dum['mplt'] = $mplt;
        }
        
        if(!empty($pcvscat))
        {
            $dum['mpcv'] = $mpcv/count($pcvscat);
        }
        else{
            $dum['mpcv'] = $mpcv;
        }
        
        if(!empty($lftscat))
        {
            $dum['mlft'] = $mlft/count($lftscat);
        }
        else{
            $dum['mlft'] = $mlft;
        }
        
        if(!empty($kftscat))
        {
            $dum['mkft'] = $mlft/count($kftscat);
        }
        else{
            $dum['mkft'] = $mkft;
        }
        
        if(!empty($rtpcrscat))
        {
            $dum['mrtpcr'] = $mlft/count($rtpcrscat);
        }
        else{
            $dum['mrtpcr'] = 0.0;
        }
        
        $dum['hbscat']  = $hbscat;
        $dum['wtscat']  = $wtscat;
        $dum['tpscat']  = $tpscat;
        $dum['rrscat']  = $rrscat;
        $dum['mmscat']  = $mmscat;
        $dum['rcscat']  = $rcscat;
        $dum['rbcscat'] = $rbcscat;
        $dum['pltscat'] = $pltscat;
        $dum['pcvscat'] = $pcvscat;
        $dum['lftscat'] = $lftscat;
        $dum['kftscat'] = $kftscat;
        $dum['rtpcrscat'] = $rtpcrscat;
        //dd($dum['scat']);
        return $dum;
    }
    
    public function getWeightParam()
    {
        $dum = array();
        $da = array();
        $dax = array();
        $hb = Goathealth::get()->pluck('weight','goat_id');
        foreach($hb as $key => $row)
        {
            if($row == "0.0" || $row == null){
                unset($hb[$key]);
            }
            else {
                $dax[] = $key;
                $da[] = (float)$row;
            }
        }
        array_push($dum, $dax);
        array_push($dum, $da);
        //dd($dum);
        
        return $dum;
    }
    
    public function getRBCParam()
    {
        $dum = array();
        $da = array();
        $dax = array();
        $hb = Goathealth::get()->pluck('rbc','goat_id');
        foreach($hb as $key => $row)
        {
            if($row == "0.0" || $row == null){
                unset($hb[$key]);
            }
            else {
                $dax[] = $key;
                $da[] = (float)$row;
            }
        }
        array_push($dum, $dax);
        array_push($dum, $da);
        //dd($dum);
        
        return $dum;
    }

}
