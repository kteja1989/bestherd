<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Exitedgoat extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
        
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exitedgoats';
    
	protected $primaryKey = 'exitedgoat_id';

	protected $fillable = [
	    'goat_id',
	    'herd_id',
        'dob',
        'gender',
        'age',
        'age_unit',
        'exit_age',
		'source',
		'genetic_background',
		'source_reference',
		'source_ref_file',
		'quarantine_start',
		'quarantine_end',
		'inducted_date',
		'status',
		'remark',
		'created_at',
		'updated_at'
    ];	
    
    // Customize log name
    protected static $logName = 'Exitedgoat';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'exitedgoat_id',
	    'goat_id',
        'herd_id',
        'dob',
        'gender',
        'age',
        'age_unit',
        'source',
        'genetic_background',
        'source_reference',
        'source_ref_file',
        'quarantine_start',
        'quarantine_end',
        'inducted_date',
        'status'
    ];
    
    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

    public function getActivitylogOptions(): getActivitylogOptions{
      return LogOptions::defaults();
    }

}
