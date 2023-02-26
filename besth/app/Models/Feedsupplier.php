<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Feedsupplier extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedsuppliers';

  	protected $primaryKey = 'feedsupplier_id';

  	protected $fillable = [
        'species_id',
        'name',
        'address',
        'contact1',
        'contact2',
        'email',
        'notes',
        'posted_by',
        'status',
        'created_at',
        'updated_at'
      ];

    // Customize log name
    protected static $logName = 'Feedsuppliers';
    
    public function species()
    {
      return $this->hasOne(Species::class, 'species_id', 'species_id');
    }
    

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
               'species_id',
        'name',
        'address',
        'contact1',
        'contact2',
        'email',
        'notes',
        'posted_by',
        'status',
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
