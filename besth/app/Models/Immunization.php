<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Immunization extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'immunizations';
    
	protected $primaryKey = 'immunization_id';

	protected $fillable = [
	    'project_id',
	    'herd_id',
	    'posted_by',
  		'sop_id',
        'immunization_date',
        'immunogen_code',
        'adjuvent_code',
        'frequency',
        'frequency_unit',
        'immunogen_volume',  
        'immunogen_site',  
        'immunogen_route', 
        'sample_desc',  
        'sample_volume',  
        'batch_id',  
        'sample_source',  
        'supplied_by',  
        'sample_ref',  
        'auth_by',  
        'total_immunized',
        'status',
        'remark',
		'created_at',
		'updated_at'
    ];	
    
    public function immunegoats()
    {
      return $this->hasMany(Immunedgoats::class, 'immunization_id', 'immunization_id');
    }
    
    public function sop()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }

    // Customize log name
    protected static $logName = 'Immunization';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
	    'project_id',
	    'herd_id',
	    'posted_by',
  		'sop_id',
        'immunization_date',
        'immunogen_code',
        'adjuvent_code',
        'frequency',
        'frequency_unit',
        'immunogen_volume',  
        'immunogen_site',  
        'immunogen_route', 
        'sample_desc',  
        'sample_volume',  
        'batch_id',  
        'sample_source',  
        'supplied_by',  
        'sample_ref',  
        'auth_by',  
        'total_immunized',
        'status',
        'remark',
		'created_at',
		'updated_at'
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
