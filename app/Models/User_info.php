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

    public function religion() {
        return $this->belongsTo(Type_religion::class, 'religion_id');
    }

    public function gender() {
        return $this->belongsTo(Type_gender::class, 'gender_id');
    }

    public function civil() {
        return $this->belongsTo(Type_civil_status::class, 'civil_id');
    }

    public function education() {
        return $this->belongsTo(Type_educational_attainment::class, 'education_id');
    }
}
