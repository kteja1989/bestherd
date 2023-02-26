<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Activity extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    protected $table = 'activitys';
    
    protected $primaryKey = 'activity_id';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
		'activity',
		'description',
		'created_by'
    ];

    public function user()
    {
      return $this->hasOne(User::class, 'id', 'created_by');
    }
    
    // Customize log name
    protected static $logName = 'Activitys';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'activity',
		'description',
		'created_by'
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
