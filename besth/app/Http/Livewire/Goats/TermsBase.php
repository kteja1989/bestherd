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
use App\Models\Procedure;
use App\Models\Feed;

//Models for herds
use App\Models\Herd;
//use App\Models\Goat;
//use App\Models\Immunization;
//use App\Models\Immunedgoats;
//use App\Models\Serum;
//use App\Models\Goatsera;
//use App\Models\Health;
//use App\Models\Goathealth;

use App\Traits\Base;
//use App\Traits\IssueRequest;
//use App\Traits\StrainConsumption;
//use App\Traits\ProjectStrainsById;
//use App\Traits\FormD;
//use App\Traits\costByProjectId;
//use App\Traits\ProjectQueries;
//use App\Traits\IssueRequestQueries;
use Livewire\WithPagination;

use App\Traits\Fileupload;
use Livewire\WithFileUploads;
//use App\Imports\GoatImport;
//use Maatwebsite\Excel\Facades\Excel;
use Validator;
use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;

class TermsBase extends Component
{
    public function render()
    {
        return view('livewire.goats.terms-base');
    }
}

