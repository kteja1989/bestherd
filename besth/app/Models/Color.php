<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Color extends Model
{
    use HasFactory;
	use HasRoles;
    use LogsActivity;
    
	protected $primaryKey = 'color_id';

	protected $fillable = [
		'color_name',
		'hex_code',
    ];

    // Customize log name
    protected static $logName = 'Color';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'color_name',
		'hex_code',
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
