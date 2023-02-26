<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Feed extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'health';
    
	protected $primaryKey = 'feed_id';

	protected $fillable = [
		'species_id',
		'description',
		'speciality',
		'supplier_id',
        'supply_date',
        'quantity',
        'quantity_unit',
        'batch',
        'mfd_date',
        'received_by'
    ];
    
    public function supplier()
    {
      return $this->hasOne(Feedsupplier::class, 'feedsupplier_id', 'supplier_id');
    }

    // Customize log name
    protected static $logName = 'Feed';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'species_id',
		'description',
		'speciality',
		'supplier_id',
        'supply_date',
        'quantity',
        'quantity_unit',
        'batch',
        'mfd_date',
        'received_by'
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
