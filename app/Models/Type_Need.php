<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Need extends Model
{
    use HasFactory;

    protected $table = 'type_needs';
    protected $fillable = [
        'name',
        'remarks',
        'updated_by',
        'created_by'
    ];
}
