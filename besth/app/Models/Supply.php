<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Supply extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supplies';

    protected $primaryKey = 'supply_id';

    protected $fillable = [
        'species_id',
        'male',
        'female',
        'total_supplied',
        'ids',
        'notes',
        'receiver_id',
        'valid_date',
        'authorized_by'
      ];

    public function species()
    {
        return $this->hasOne(Species::class, 'species_id', 'species_id');
    }
    
    public function receiver()
    {
        return $this->hasOne(Receiver::class, 'receiver_id', 'receiver_id');
    }
      
    // Customize log name
    protected static $logName = 'Supply';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'species_id',
        'male',
        'female',
        'total_supplied',
        'ids',
        'notes',
        'receiver_id',
        'valid_date',
        'authorized_by'
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