<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_previous_job extends Model
{
    use HasFactory;

    protected $table = 'user_previous_jobs';
    protected $fillable = [
        'user_id',
        'job_type',
        'job_id',
        'sub_job_id',
        'continent_id',
        'country_id',
        'years_abbroad',
        'contract_id',
        'last_departure',
        'last_arrival',
        'owwa_id',
        'intent_return',
    ];

    public static function getAllPreviousJob() {
        return self::all();
    }
}
