<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Maintenance extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    protected $table = 'maintenance';

    protected $primaryKey = 'maintenance_id';

    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = [
        'supervisor_id',
        'infra_id',
        'type',
        'done_date',
        'description',
        'filename',
    ];

    public function infra()
    {
        return $this->hasOne(Infrastructure::class, 'infra_id', 'infra_id');
    }

    public function supervisor()
    {
        return $this->hasOne(User::class, 'id', 'supervisor');
    }
    
    // Customize log name
    protected static $logName = 'Maintenance';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'supervisor_id',
        'infra_id',
        'type',
        'done_date',
        'description',
        'filename',
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
