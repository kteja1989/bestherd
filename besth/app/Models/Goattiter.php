<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Goattiter extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */

	protected $primaryKey = 'goattiter_id';
	
	protected $fillable = [
        'titer_id',	
        'serum_id',	
        'goat_id',	
        'titer_value'
    ];
    
    public function titer()
    {
      return $this->hasOne(Titer::class, 'titer_id', 'titer_id');
    }

    // Customize log name
    protected static $logName = 'Goattiter';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'titer_id',	
        'serum_id',	
        'goat_id',	
        'titer_value'
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
