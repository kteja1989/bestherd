<?php

namespace App\Http\Livewire\Goats;

use Livewire\Component;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Route;

//use App\Models\Project;
//use App\Models\Issue;
use App\Models\Assent;
use App\Models\User;

//Models for herds
use App\Models\Herd;
use App\Models\Goat;
use App\Models\Immunization;
use App\Models\Immunedgoats;
use App\Models\Serum;
use App\Models\Goatsera;
use App\Models\Health;
use App\Models\Goathealth;
use App\Models\Exitedgoat;

//use App\Traits\ProjectQueries;
//use App\Traits\ProjectCost;

use Validator;

use PhpOffice\PhpWord\SimpleType\VerticalJc;
use PhpOffice\PhpWord\ComplexType\FootnoteProperties;
use PhpOffice\PhpWord\SimpleType\NumberFormat;
use PhpOffice\PhpWord\Element\Field;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\SimpleType\TblWidth;

use LivewireUI\Modal\ModalComponent;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class HerdReports extends Component
{
//    use ProjectQueries;
//    use ProjectCost;
    
    public $project_id, $fromDate, $toDate;
    public $updateMsgs = false, $errMsgs, $repMessage;
    public $activeHerds, $herd_id, $herdIdVal;
    
    public $exitedGoats;
    
    public $qr=[];
    
    //panel variables
    public $showHerdInfoPrint = false;
    public $showImmunInfoPrint = false;
    public $showSeraInfoPrint = false;
    public $showExitedgoatInfoPrint = false;
    
    protected $listeners = ['replyListener' => 'actionListened'];

    public $reply, $replyAction;

    public function actionListened($reply)
    {
        $this->replyAction = $reply['reply'];
        //dd($reply['reply'], $this->replyAction);
    }
    
    public function render()
    {
        if( Auth::user()->hasAnyRole('herdmanager') )
        {
            /*
            if($this->replyAction == "yes")
            {
              $this->showHerdInfoPrint = true;
            }
            else {
              $this->showHerdInfoPrint = false;
            }
            */
            $this->activeHerds = Herd::where('status', ['Active'])->get();
            
            return view('livewire.goats.herd-reports')
                      ->with(['actives'=>$this->activeHerds]);
            
        }
  	        
    }
    
    public function hydrateBaseInfo()
    {
        
    }
    
    public function updatedHerdIdVal()
    {
      $this->herd_id = $this->herdIdVal;
      
      $this->showHerdInfoPrint = false;
      $this->showImmunInfoPrint = false;
      $this->showSeraInfoPrint = false;
    }
    
    //form field validation
    public function validateFormFields()
    {
        $this->repMessage = "";
        
        if($this->herd_id != 'all')
        {
            if($this->herd_id == null)
            {
              $this->repMessage = "Herd not selected";
              $this->updateMsgs = true;
              return;
            }
    
            if( $this->fromDate == null)
            {
              $this->repMessage = "Select From Date";
              $this->updateMsgs = true;
              return;
            }
    
            if( $this->toDate == null)
            {
              $this->repMessage = "Select To Date";
              $this->updateMsgs = true;
              return;
            }
    
            if( strtotime($this->fromDate) > strtotime($this->toDate) )
            {
              $this->repMessage = "From Date is later than To Date";
              $this->updateMsgs = true;
              return;
            }
        }
        return true;
    }
    
    //Herd report generation
    public function herdReports()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
        $this->showHerdInfoPrint = false;

        if($this->validateFormFields())
        {
            if($this->herd_id == 'all')
            {
                $this->qr['herds'] = Herd::where('status', 'active')->get();
            }
            else {
                $this->qr['herds'] = Herd::where('herd_id', $this->herd_id)
                                        ->whereDate('created_at','>=', $this->fromDate)
                                        ->whereDate('created_at','<=', $this->toDate)
                                        ->get();
            }
            
            $this->qr['herd_id'] = $this->herd_id;
            $this->qr['fromDate'] = $this->fromDate;
            $this->qr['toDate'] = $this->toDate;
            
            $this->showImmunInfoPrint = false;
            $this->showSeraInfoPrint = false;
            $this->showHerdInfoPrint = true;
            
            /*
            $this->emit("openModal", 'printherd-report',
                        [
                          "fromDate"=>$this->fromDate,
                          "toDate"=>$this->toDate,
                          "qr"=>$this->qr
                        ]);
            */
        }
    }
    
    
    //Immunization Report
    public function immunizationReports()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;

      	if($this->validateFormFields())
        {
            if($this->herd_id == 'all')
            {
                $this->qr['immunzns'] = Immunization::all();
            }
            else {
                $this->qr['immunzns'] = Immunization::where('herd_id', $this->herd_id)
                                        ->whereDate('immunization_date','>=', $this->fromDate)
                                        ->whereDate('immunization_date','<=', $this->toDate)
                                        ->get();
            }
            $this->qr['herd_id'] = $this->herd_id;
            $this->qr['fromDate'] = $this->fromDate;
            $this->qr['toDate'] = $this->toDate;
            
            $this->showHerdInfoPrint = false;
            $this->showSeraInfoPrint = false;
            $this->showImmunInfoPrint = true;
        }
    }    
    
    //serum Collection
    public function seraCollectReports()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
      	
      	if($this->validateFormFields())
        {
            if($this->herd_id == 'all')
            {
                $this->qr['sera'] = Serum::all();
            }
            else {
                $this->qr['sera'] = Serum::where('herd_id', $this->herd_id)
                                        ->whereDate('created_at','>=', $this->fromDate)
                                        ->whereDate('created_at','<=', $this->toDate)
                                        ->get();
            }
            $this->qr['herd_id'] = $this->herd_id;
            $this->qr['fromDate'] = $this->fromDate;
            $this->qr['toDate'] = $this->toDate;

            $this->showHerdInfoPrint = false;
            $this->showImmunInfoPrint = false;
            $this->showSeraInfoPrint = true;

        }
        
    }    
    
    public function processExitReport()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
        if($this->validateFormFields())
        {
            if($this->herd_id == 'all')
            {
                //$this->qr['goatsexited'] = Exitedgoat::all();
                $this->qr['goatsexited'] = Exitedgoat::whereDate('created_at','>=', $this->fromDate)
                                        ->whereDate('created_at','<=', $this->toDate)
                                        ->get();
            }
            else {
                
                
                $this->qr['goatsexited'] = Exitedgoat::whereDate('created_at','>=', $this->fromDate)
                                        ->whereDate('created_at','<=', $this->toDate)
                                        ->get();
                
            }
            
            $this->qr['herd_id'] = $this->herd_id;
            $this->qr['fromDate'] = $this->fromDate;
            $this->qr['toDate'] = $this->toDate;

            $this->showHerdInfoPrint = false;
            $this->showImmunInfoPrint = false;
            $this->showSeraInfoPrint = false;
            //currently all goats not by herd
            //dd($this->qr);
            $this->showExitedgoatInfoPrint = true;
        }
        
        
    }
    
    //All download buttons
    public function downloadHerdReport()
    {
        $xres = $this->generateHerdRep($this->qr);
        return response()->download(storage_path('herdsCurrent.docx'));
    }
    
    public function downloadImmunzReport()
    {
        $xres = $this->generateImmRep($this->qr);
        return response()->download(storage_path('immunzCurrent.docx'));
    }
    
    public function downloadSerumReport()
    {
        $xres = $this->generateSeraRep($this->qr);
        return response()->download(storage_path('seraCurrent.docx'));
    }
    
    

    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateHerdRep($qr)
    {
        $path = storage_path('templates/herdTemplate.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareHerdReportHeader($templateProcessor, $qr);
        // 1. Basic table

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        $result = $qr['herds'];
        
        $rows = count($result);
        $cols = 5;
        
        $section->addText('Basic table', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(750)->addText("Herd");
        $table->addCell(1750)->addText("Description");
        $table->addCell(1750)->addText("Strength");
        $table->addCell(1750)->addText("Count");
        $table->addCell(1750)->addText("Gender");
        
        if (count($result) != 0) {
          foreach($result as $row) {
              $table->addRow();
              $col="";
              for ($c = 1; $c <= $cols; $c++) {
                  switch ($c) {
                    case 1:
                      $col = $row['herd_id'];
                      break;
                    case 2:
                      $col = $row['description'];
                      break;
                    case 3:
                      $col = $row['total_size'];
                      break;
                    case 4:
                      $col = $row['total_count'];
                      break;
                    case 5:
                      $col = $row['gender'];
                      break;

                    default:
                      // code...
                      break;
                  }
                  $table->addCell(750)->addText($col);
              }
          }
            $templateProcessor->setComplexBlock('table', $table);
  			$templateProcessor->saveAs(storage_path('herdsCurrent.docx'));
        }
        return;
    }
    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepareHerdReportHeader($templateProcessor, $qr)
    {
        $date1 = $qr['fromDate'];
        $date2 = $qr['toDate'];
        $herd = Herd::where('herd_id', $this->herd_id)->first();

        $title = new TextRun();
        $frD = new TextRun();
        $toD = new TextRun();
        $secLine = new TextRun();

        $title = "Abcde Fghij Klmno Pqrs";
        $herdTitle = "List of Herd(s) Active";
        $piName = "First Name Last";

        $templateProcessor->setValue('title', $title);
        $templateProcessor->setValue('frDate', $date1);
        $templateProcessor->setValue('toDate', $date2);
        $templateProcessor->setValue('piName', $piName);
        $templateProcessor->setValue('herdTitle', $herdTitle);
        return;
    }
    
    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateImmRep($qr)
    {
        $path = storage_path('templates/immunzTemplate.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareImmunzReportHeader($templateProcessor, $qr);
        
        // 1. Basic table
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        $result = $qr['immunzns'];
        
        $rows = count($result);
        $cols = 5;
        
        $section->addText('Basic table', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(750)->addText("Immunogen");
        $table->addCell(1750)->addText("Adjuvant");
        $table->addCell(1750)->addText("Sample");
        $table->addCell(1750)->addText("Sample Batch");
        $table->addCell(1750)->addText("Supplied By");
        
        if (count($result) != 0) {
          foreach($result as $row) {
              $table->addRow();
              $col="";
              for ($c = 1; $c <= $cols; $c++) {
                  switch ($c) {
                    case 1:
                      $col = $row['immunogen_code'];
                      break;
                    case 2:
                      $col = $row['adjuvent_code'];
                      break;
                    case 3:
                      $col = $row['sample_desc'];
                      break;
                    case 4:
                      $col = $row['batch_id'];
                      break;
                    case 5:
                      $col = $row['supplied_by'];
                      break;

                    default:
                      // code...
                      break;
                  }
                  $table->addCell(750)->addText($col);
              }
          }
            $templateProcessor->setComplexBlock('table', $table);
  			$templateProcessor->saveAs(storage_path('immunzCurrent.docx'));
        }
    }
    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepareImmunzReportHeader($templateProcessor, $qr)
    {
        $date1 = $qr['fromDate'];
        $date2 = $qr['toDate'];
        $immnz = Immunization::where('herd_id', $this->herd_id)->first();

        $title = new TextRun();
        $frD = new TextRun();
        $toD = new TextRun();
        $secLine = new TextRun();

        $title = "Abcde Fghij Klmno Pqrs";
        $herdTitle = "List of Immunization(s)";
        $piName = "First Name Last";
        
        $templateProcessor->setValue('title', $title);
        $templateProcessor->setValue('frDate', $date1);
        $templateProcessor->setValue('toDate', $date2);
        $templateProcessor->setValue('piName', $piName);
        $templateProcessor->setValue('herdTitle', $herdTitle);
        return;
    }    
    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateSeraRep($qr)
    {
        $path = storage_path('templates/serumTemplate.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareSeraReportHeader($templateProcessor, $qr);
        
        // 1. Basic table
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        $result = $qr['sera'];
        
        $rows = count($result);
        $cols = 5;
        
        $section->addText('Basic table', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(750)->addText("Herd");
        $table->addCell(1750)->addText("Total");
        $table->addCell(1750)->addText("Volume");
        $table->addCell(1750)->addText("Date");
        $table->addCell(1750)->addText("Batch Code");
        
        if (count($result) != 0) {
          foreach($result as $row) {
              $table->addRow();
              $col="";
              for ($c = 1; $c <= $cols; $c++) {
                  switch ($c) {
                    case 1:
                      $col = $row['herd_id'];
                      break;
                    case 2:
                      $col = $row['number_goats'];
                      break;
                    case 3:
                      $col = $row['volume'];
                      break;
                    case 4:
                      $col = $row['date_collected'];
                      break;
                    case 5:
                      $col = $row['batch_code'];
                      break;

                    default:
                      // code...
                      break;
                  }
                  $table->addCell(750)->addText($col);
              }
          }
            $templateProcessor->setComplexBlock('table', $table);
  			$templateProcessor->saveAs(storage_path('seraCurrent.docx'));
        }
    }
    
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepareSeraReportHeader($templateProcessor, $qr)
    {
        $date1 = $qr['fromDate'];
        $date2 = $qr['toDate'];
        $serum = Serum::where('herd_id', $this->herd_id)->first();

        $title = new TextRun();
        $frD = new TextRun();
        $toD = new TextRun();
        $secLine = new TextRun();

        $title = "Abcde Fghij Klmno Pqrs";
        $herdTitle = "List of Herd(s) Active";
        $piName = "First Name Last";
        
        $templateProcessor->setValue('title', $title);
        $templateProcessor->setValue('frDate', $date1);
        $templateProcessor->setValue('toDate', $date2);
        $templateProcessor->setValue('piName', $piName);
        $templateProcessor->setValue('herdTitle', $herdTitle);
        return;
    }    
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function formCReport()
    {
        $this->showHerdInfoPrint = false;
        $this->showImmunInfoPrint = false;
        $this->showSeraInfoPrint = false;
        $this->repMessage = "Form C Report is being readied";
        $this->updateMsgs = true;
    }
    
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function exitReport()
    {
        $this->showHerdInfoPrint = false;
        $this->showImmunInfoPrint = false;
        $this->showSeraInfoPrint = false;
        $this->repMessage = "Exit Report is being readied";
        $this->updateMsgs = true;
    }
}
