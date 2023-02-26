<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Dailyherdrecord extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */

	protected $primaryKey = 'dhr_id';

	protected $fillable = [
	    'sop_id',
        'entry_date',
        'herd_id',
        'temperature',
        'humidity',
        'dry_cleaned',
        'water_cleaned',
        'special',
        'remarks',
        'carried_by',
        'supervised_by',
		'created_at',
		'updated_at'
    ];
    
    public function sops()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }
    
    // Customize log name
    protected static $logName = 'Dailyherdrecord';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'sop_id',
        'entry_date',
        'herd_id',
        'temperature',
        'humidity',
        'dry_cleaned',
        'water_cleaned',
        'special',
        'remarks',
        'carried_by',
        'supervised_by',
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