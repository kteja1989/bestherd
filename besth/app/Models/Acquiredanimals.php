<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Acquiredanimals extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'acquiredanimals';

    protected $primaryKey = 'acquiredanimal_id';

    protected $fillable = [
        'department',
        'total_acquired',
        'date_acquired',
        'species_id',
        'sex',
        'age',
        'age_unit',
        'supplier_code',
        'created_at',
        'updated_at'
    ];

    // Customize log name
    protected static $logName = 'Acquiredanimals';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'department',
        'total_acquired',
        'date_acquired',
        'species_id',
        'sex',
        'age',
        'age_unit',
        'supplier_code',
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
