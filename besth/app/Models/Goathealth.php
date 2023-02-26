<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Goathealth extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goathealth';
    
	protected $primaryKey = 'goathealth_id';

	protected $fillable = [
	    'sop_id',
        'goat_id',
        'hb',
        'weight',
        'resp_rate',
        'temperature',
        'mucous_membrane',
        'rumen_contractions',
        'rbc',
        'platelet',
        'pcv',
        'lft',
        'kft',
        'rtpcr',
        'observations',
        'date_observed',
        'action_taken',
		'closure',
		'closure_date',
		'closure_action'
    ];

    public function sops()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }
    
    // Customize log name
    protected static $logName = 'Goathealth';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'sop_id',
        'goat_id',
        'hb',
        'weight',
        'resp_rate',
        'temperature',
        'mucous_membrane',
        'rumen_contractions',
        'rbc',
        'platelet',
        'pcv',
        'lft',
        'kft',
        'rtpcr',
        'observations',
        'date_observed',
        'action_taken',
		'closure',
		'closure_date',
		'closure_action'
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
