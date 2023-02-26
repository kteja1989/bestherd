<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Health extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'health';
    
	protected $primaryKey = 'health_id';
	
	public function sops()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }

	protected $fillable = [
		'herd_id',
		'sop_id',
		'scheduled',
		'inspect_type',
        'health_notes',
        'diagnosis',
        'suggestions',
        'vet_name',
        'inspected_on',
        'action_taken',
        'atr_on',
        'atr_acted_by',
        'remarks'
    ];

    // Customize log name
    protected static $logName = 'Health';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'herd_id',
		'sop_id',
		'scheduled',
		'inspect_type',
        'health_notes',
        'diagnosis',
        'suggestions',
        'vet_name',
        'inspected_on',
        'action_taken',
        'atr_on',
        'atr_acted_by',
        'remarks'
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
