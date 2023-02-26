<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Immunedgoats extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'immunedgoats';
    
	protected $primaryKey = 'immgoat_id';

	protected $fillable = [
	    'immunization_id',
	    'goat_id',
	    'booster_due',
	    'notes'
    ];	
    
    public function immunztion()
    {
      return $this->hasOne(Immunization::class, 'immunization_id', 'immunization_id');
    }
    
    // Customize log name
    protected static $logName = 'Immunedgoats';
    
    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
	    'immunization_id',
	    'goat_id',
	    'booster_due',
	    'notes'    
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
