<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Event extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'start_hour',
        'start_min',
        'end_hour',
        'end_min',
        'resource_id',
        'priority',
        'created_by'
    ];

    // Customize log name
    protected static $logName = 'Event';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'title',
        'description',
        'start_date',
        'start_hour',
        'start_min',
        'end_hour',
        'end_min',
        'resource_id',
        'priority',
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
