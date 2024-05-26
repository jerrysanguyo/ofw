<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    use HasFactory;

    protected $table = 'user_infos';
    protected $fillable = [
        'user_id',
        'birthdate',
        'age',
        'gender_id',
        'birthplace',
        'religion_id',
        'civil_id',
        'present_job',
        'education_id',
        'voters',
    ];
}
