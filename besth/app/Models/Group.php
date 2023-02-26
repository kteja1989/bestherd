<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Group extends Model
{
    use HasFactory;
	use HasRoles;
	use LogsActivity;
	
	protected $primaryKey = 'group_id';
		
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'pi_id',
		'member_id',		
    ];
		
	public function pi()
    {
      return $this->hasOne(User::class, 'id', 'pi_id');
    }
		
		public function member()
    {
      return $this->hasOne(User::class, 'id', 'member_id');
    }
    
    // Customize log name
    protected static $logName = 'Group';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'pi_id',
    	'member_id',
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
