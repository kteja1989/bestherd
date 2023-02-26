<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herdefaults extends Model
{
    use HasFactory;
    
    protected $table = 'herdefaults';
    
    protected $primaryKey = 'herdefault_id';
    
    protected $fillable = [
		/*
		'species_name',
		'notes'
		*/
		'field',
		'value',
		'unit',
		'old_value'
		
    ];
}
