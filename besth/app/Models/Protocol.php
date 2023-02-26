<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Protocol extends Model
{
    use HasFactory;
	use HasRoles;
    use LogsActivity;
    
	protected $primaryKey = 'protocol_id';
		
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id',
		'title',
		'description',
		'version_id',
		'filename',
		'approved_by',
		'approved_date',
		'approved_reference',
		'approved_authority',
		'validity_date',
		'pi_id',
		'status',

    ];
		
	public function user()
    {
      return $this->hasOne(User::class, 'id', 'pi_id');
    }
	
	// Customize log name
    protected static $logName = 'Protocol';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'department_id',
        'title',
        'description',
        'version_id',
        'filename',
        'approved_by',
        'approved_date',
        'approved_reference',
        'approved_authority',
        'validity_date',
        'pi_id',
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
