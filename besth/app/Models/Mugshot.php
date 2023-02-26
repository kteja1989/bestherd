<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Mugshot extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;

    protected $primaryKey = 'mugshot_id';

    protected $fillable = [
        'goat_id',
        'user_id',
        'user_name',
        'date_uploaded',
        'path',
        'image',	
        'notes'
    ];

		public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_by');
    }

    // Customize log name
    protected static $logName = 'Mugshot';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'goat_id',
        'user_id',
        'user_name',
        'date_uploaded',
        'path',
        'image',	
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
