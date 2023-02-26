<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Adjuvant extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    protected $primaryKey = 'adjuvant_id';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
		'adjuvant_name',
		'nick_name',
		'volume',
		'volume_unit',
		'manufacturer',
    ];


    // Customize log name
    protected static $logName = 'Adjuvant';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'adjuvant_name',
		'nick_name',
		'volume',
		'volume_unit',
		'manufacturer',
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
