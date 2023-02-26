<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Receiver extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    
	protected $primaryKey = 'receiver_id';
	
	protected $fillable = [
	    'name',	
	    'address',	
	    'registration_detail',	
	    'valid_date',
        'regis_file',
        'posted_by',	
		'created_at',
		'updated_at'
    ];

    // Customize log name
    protected static $logName = 'herd';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'name',	
	    'address',	
	    'registration_detail',	
	    'valid_date',
        'regis_file',
        'posted_by',	
		'created_at',
		'updated_at'
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
