<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function distinctJobTypesCount()
    {
        return self::select('job_type', DB::raw('count(*) as count'))
                   ->groupBy('job_type')
                   ->get();
    }

    public function job() {
        return $this->belongsTo(Type_job::class, 'job_id');
    }

    public function subJob() {
        return $this->belongsTo(Type_sub_job::class, 'sub_job_id');
    }

    public function continent() {
        return $this->belongsTo(Type_continent::class, 'continent_id');
    }

    public function country() {
        return $this->belongsTo(Type_country::class, 'country_id');
    }

    public function contract() {
        return $this->belongsTo(Type_contract::class, 'contract_id');
    }

    public function owwa() {
        return $this->belongsTo(Type_owwa::class, 'owwa_id');
    }
}
