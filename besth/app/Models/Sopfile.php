<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Sopfile extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;

    protected $primaryKey = 'sopfile_id';

    protected $fillable = [
        'dept_id',
        'user_id',
        'user_name',
        'date_uploaded',
        'path',
        'filename',	
        'notes'
    ];

	public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_by');
    }

    // Customize log name
    protected static $logName = 'Sopfile';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'dept_id',
        'user_id',
        'user_name',
        'date_uploaded',
        'path',
        'filename',	
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
