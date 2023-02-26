<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Goat extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
        
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goats';
    
	protected $primaryKey = 'goat_id';

	protected $fillable = [
        'dob',
        'gender',
        'age',
        'age_unit',
		'source',
		'genetic_background',
		'source_ref',
		'source_ref_file',
		'quarantine_start',
		'quarantine_end',
		'inducted_date',
		'status'
    ];	
    
    public function goatTiter()
    {
      return $this->hasOne(Goattiter::class, 'goat_id', 'goat_id')->latest();
    }
    
    public function goatWeight()
    {
      return $this->hasOne(Goathealth::class, 'goat_id', 'goat_id')->latest();
    }
    
    // Customize log name
    protected static $logName = 'Goat';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
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
