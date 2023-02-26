<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Goatsera extends Model
{
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goatsera';
    
	protected $primaryKey = 'goatsera_id';

	protected $fillable = [
		'serum_id',
		'goat_id',
		'volume'
    ];	  
    
    public function serum()
    {
      return $this->hasOne(Serum::class, 'serum_id', 'serum_id');
    }

    // Customize log name
    protected static $logName = 'Goatsera';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
		'serum_id',
		'goat_id',
		'volume'
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
