<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Immunogen extends Model
{
    use HasFactory;
	use HasRoles;
    use LogsActivity;
    
	protected $primaryKey = 'immunogen_id';
		
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'department_id',
		'name',
		'code',
		'description',
		'posted_by',
		'status'
    ];

    // Customize log name
    protected static $logName = 'Immunogen';

    // Only defined attribute will store in log while any change
    protected static $logAttributes = [
        'department_id',
		'name',
		'code',
		'description',
		'posted_by'.
		'status'
    ];
}
