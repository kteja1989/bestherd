<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Route;

use App\Models\Project;
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

class ManageReports extends Component
{
//    use ProjectQueries;
//    use ProjectCost;
    
    public $project_id, $fromDate=[], $toDate=[];
    public $updateMsgs = false, $errMsgs, $repMessage;
    
    public function render()
    {
        if( Auth::user()->hasAnyRole('pisg','pilg','piblg','pient','investigator') )
        {
            //$actives = Project::with('user')->where('pi_id', Auth::id() )
            //						->whereIn('status', ['active'])->get();
            $actives = $this->allowedProjectIds();
        }

        if( Auth::user()->hasRole('researcher') )
        {
            $actives = $this->allowedProjectIds();
        }
  	        return view('livewire.manage-reports')
                      ->with(['actives'=>$actives]);
    }

    public function notebook()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
      	$qr=array();
        if($this->validateFormFields())
        {
            $qr['project_id'] = $this->project_id;
            $qr['fromDate'] = $this->fromDate;
            $qr['toDate'] = $this->toDate;
            $qr['project'] = Project::with('user')->where('project_id', $this->project_id)->first();
            $qr['result'] = DB::table($this->project_id.'notebook')
                                ->where('expt_date', '>=', $this->fromDate)
                                ->where('expt_date', '<=', $this->toDate)
                                ->get();
            if(count($qr['result']) !=0 )
            {
                $xres = $this->generateNbookRep($qr);
                return response()->download(storage_path('noteBook.docx'));
                $this->repMessage = "Report Generated Being Downloaded";
                $this->updateMsgs = true;
            }
            else{
                $this->repMessage = "No Data for Report Generation";
                $this->updateMsgs = true;
            }
        }
    }

    public function consumption()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
        $qr = array();
        if( $this->validateFormFields() )
        {
            $qr['project_id'] = $this->project_id;
            $qr['fromDate'] = $this->fromDate;
            $qr['toDate'] = $this->toDate;
            $table = $this->project_id."formd";
            $qr['result'] = DB::table($table)
                            ->join('species', 'species.species_id', $table.'.species')
                            ->join('strains', 'strains.strain_id', $table.'.strain')
                            ->where('entry_date', '>=', $this->fromDate)
                      	    ->where('entry_date', '<=', $this->toDate)
                            ->orderBy('strain_name')
                      		->get();
            if( count($qr['result']) != 0)
            {
                $xres = $this->generateUsageRep($qr);
                return response()->download(storage_path('usageReport.docx'));
            }
            else {
                $this->repMessage = "No Data for Report Generation";
                $this->updateMsgs = true;
            }
        }
    }

    public function costs()
    {
        $this->repMessage = "";
        $this->updateMsgs = true;
        if( $this->validateFormFields() )
        {
            $qr['project_id'] = $this->project_id;
            $qr['fromDate'] = $this->fromDate;
            $qr['toDate'] = $this->toDate;
            $result = $this->ProjectCostByDates($qr);
           
            if($result)
            {
                $costByCage = $result[0];
                $costByProject = $result[1];
                $xres = $this->prepareCostReport($qr, $costByCage, $costByProject);
                return response()->download(storage_path('costReport.docx'));
            }
            else {
                $this->repMessage = "Active Cages Not Found";
                $this->updateMsgs = true;
            }
        }
    }

    //form field validation
    public function validateFormFields()
    {
        if($this->project_id == null)
        {
          $this->repMessage = "Project not selected";
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
        return true;
    }

   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateNbookRep($qr)
    {
        $path = storage_path('templates/Notebook.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareReportHeader($templateProcessor, $qr);
        // 1. Basic table
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        $result = $qr['result'];
        $rows = count($result);
        $cols = 5;
        $section->addText('Basic table', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(750)->addText("CageId");
        $table->addCell(1750)->addText("ExptDt");
        $table->addCell(1750)->addText("ExptDesc");
        $table->addCell(1750)->addText("EntryDate");
        $table->addCell(1750)->addText("Name");
        if (count($result) != 0) {
          foreach($result as $row) {
              $table->addRow();
              $col="";
              for ($c = 1; $c <= $cols; $c++) {
                  switch ($c) {
                    case 1:
                      $col = $row->cage_id;
                      break;
                    case 2:
                      $col = date('d-m-Y', strtotime($row->expt_date));
                      break;
                    case 3:
                      $col = $row->expt_description;
                      break;
                    case 4:
                      $col = $row->entry_date;
                      break;
                    case 5:
                      $col = $row->staff_name;
                      break;

                    default:
                      // code...
                      break;
                  }
                  $table->addCell(750)->addText($col);
              }
          }
            $templateProcessor->setComplexBlock('table', $table);
  			$templateProcessor->saveAs(storage_path('noteBook.docx'));
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateUsageRep($qr)
    {
        $path = storage_path('templates/Usage.docx');
        //dd($qr);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareReportHeader($templateProcessor, $qr);
        //from project id get HttpQueryString
        // 1. Basic table
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        //$result = $qr['result'];
        $rows = count($qr['result']);
        $cols = 4;
        $section->addText('Usage Details', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(1750)->addText("Dt.Usage");
        $table->addCell(1750)->addText("Name");
        $table->addCell(1750)->addText("Number");
        $table->addCell(1950)->addText("Details");
        if (count($qr['result']) != 0) {
          foreach($qr['result'] as $row) {
              $table->addRow();
              $col="";
              for ($c = 1; $c <= $cols; $c++) {
                  switch ($c) {
                    case 1:
                      $col = date('d-m-Y', strtotime($row->entry_date));
                      break;
                    case 2:
                      $col = $row->staff_name;
                      break;
                    case 3:
                      $col = $row->req_anim_number;
                      break;
                    case 4:
                      $col = $row->species_name."/".$row->strain_name."/".$row->sex."/".$row->age."-".$row->ageunit;
                      break;
                    case 5:
                      //$col = $row->staff_name;
                      break;

                    default:
                      // code...
                      break;
                  }
                  $table->addCell(750)->addText($col);
              }
          }
          //dd($table);
          $templateProcessor->setComplexBlock('table', $table);
          $templateProcessor->saveAs(storage_path('usageReport.docx'));
          $this->repMessage = "Downloading Usage Report Now";
          $this->updateMsgs = true;
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepareReportHeader($templateProcessor, $qr)
    {
        $date1 = $qr['fromDate'];
        $date2 = $qr['toDate'];
        $project = Project::with('user')->where('project_id', $this->project_id)->first();
        //dd($project);

        $title = new TextRun();
        $frD = new TextRun();
        $toD = new TextRun();
        $secLine = new TextRun();

        $title = "Abcde Fghij Klmno Pqrs";
        $projecTitle = $project->title;
        $piName = $project->user->name;

        $templateProcessor->setValue('title', $title);
        $templateProcessor->setValue('frDate', $date1);
        $templateProcessor->setValue('toDate', $date2);
        $templateProcessor->setValue('piName', $piName);
        $templateProcessor->setValue('projecTitle', $projecTitle);
        return;
    }
    
    //cost report details
    public function prepareCostReport($qr, $costByCage, $costByProject)
    {
        $path = storage_path('templates/costRep.docx');
        //dd($qr);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //prepare the header
        $this->prepareReportHeader($templateProcessor, $qr);
        
        // 1. Basic table
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);
        //$result = $qr['result'];
        $rows = count($costByCage);
        $cols = 7;
        
        $section->addText('Usage Details', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(1650)->addText("Cage Id");
        $table->addCell(1650)->addText("Project Id");
        $table->addCell(1775)->addText("From");
        $table->addCell(1775)->addText("To*");
        $table->addCell(1750)->addText("Days");
        $table->addCell(1750)->addText("Rate");
        $table->addCell(2150)->addText("Cost");
        
        if (count($costByCage) != 0) {
            foreach($costByCage as $row) {
                  $table->addRow();
                  $col="";
                  for ($c = 1; $c <= $cols; $c++) {
                      switch ($c) {
                        case 1:
                          $col = $row[0];
                          break;
                        case 2:
                          $col = $row[1];
                          break;
                        case 3:
                          $col = $row[2];
                          break;
                        case 4:
                          $col = $row[3];
                          break;
                        case 5:
                          $col = $row[4];
                          break;
                        case 6:
                          $col = $row[5];
                          break;
                        case 7:
                          $col = $row[6];
                          break;
    
                        default:
                          // code...
                          break;
                      }
                      $table->addCell(750)->addText($col);
                  }
            }
            //dd($table);
            $templateProcessor->setComplexBlock('table', $table);
            foreach($costByProject as $val){
                $templateProcessor->setValue('cageCount', $val[1]);
                $templateProcessor->setValue('totalCost', $val[2]);
            }
            $templateProcessor->saveAs(storage_path('costReport.docx'));
            $this->repMessage = "Downloading Usage Report Now";
            $this->updateMsgs = true;
        }
    }
    
    public function prepareCostRepHeader(){
        
    }
}

