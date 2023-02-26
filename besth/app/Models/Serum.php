<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Serum extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'serum';
    
	protected $primaryKey = 'serum_id';
	
	protected $fillable = [
        'herd_id',
    	'sop_id',
        'goat_id',
        'volume',  
        'date_collected',  
        'batch_code',
        'auth_by',  
        'notes',  
        'status',
        'posted_by'
    ];
    
    public function sops()
    {
      return $this->hasOne(Sop::class, 'sop_id', 'sop_id');
    }
    
    // Customize log name
    protected static $logName = 'Serum';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'herd_id',
        'sop_id',
        'goat_id',
        'volume',  
        'date_collected',  
        'batch_code',
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
    
    public function goatsera()
    {
      return $this->hasMany(Goatsera::class, 'serum_id', 'serum_id');
    }

    public function getActivitylogOptions(): getActivitylogOptions{
        return LogOptions::defaults();
    }
	
}
