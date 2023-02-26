<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Contact extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    //protected $primaryKey = 'contact_id';

	protected $fillable = [
		'name',
		'email',
		'message',
		'status'
	];

    // Customize log name
    protected static $logName = 'Contact';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'name',
		'email',
		'message',
		'status'
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
