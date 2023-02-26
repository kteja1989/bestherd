<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Animalsupplies extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animalsupplies';

  	protected $primaryKey = 'animalsupply_id';

  	protected $fillable = [
          'date_supplied',
          'species_id',
          'sex',
          'total_supplied',
          'age',
          'age_unit',
          'bill_number',
          'bill_date',
          'posted_by',
          'status',
      		'created_at',
      		'updated_at'
      ];

    // Customize log name
    protected static $logName = 'Animalsupplies';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'date_supplied',
        'species_id',
        'sex',
        'total_supplied',
        'age',
        'age_unit',
        'bill_number',
        'bill_date',
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
