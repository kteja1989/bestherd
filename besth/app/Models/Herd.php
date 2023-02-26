<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Herd extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'herd';
    
	protected $primaryKey = 'herd_id';

	protected $fillable = [
	    'category',
	    'color',
		'description',
		'location',
		'total_size',
		'total_count',
		'gender',
		'feed_description',
		'incharge_name',
		'status',
		'notes',
        'health_check',
        'health_check_id',
		'created_at',
		'updated_at'
    ];
    
    // Customize log name
    protected static $logName = 'Herd';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'category',
        'color',
        'description',
        'location',
        'total_size',
        'total_count',
        'gender',
        'incharge_name',
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
