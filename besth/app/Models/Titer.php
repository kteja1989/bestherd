<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Titer extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */

	protected $primaryKey = 'titer_id';
	
	protected $fillable = [
        'herd_id',	
        'serum_id',	
        'sop_id',	
        'number_goats',	
        'titer_by',	
        'titer_date',	
        'titer_ref',	
        'auth_by',	
        'notes',	
        'status',	
        'posted_by'	
    ];
    
    public function sops()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }
    
    public function goattiter()
    {
      return $this->hasMany(Goattiter::class, 'goat_id', 'goat_id');
    }
    
    // Customize log name
    protected static $logName = 'Titer';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'herd_id',	
        'serum_id',	
        'sop_id',	
        'number_goats',	
        'titer_by',	
        'titer_date',	
        'titer_ref',	
        'auth_by',	
        'notes',	
        'status',	
        'posted_by'	
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
