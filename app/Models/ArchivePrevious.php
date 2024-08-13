<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivePrevious extends Model
{
    use HasFactory;

    protected $table = 'archive_previouses';
    protected $fillable = [
        'user_archive_id',
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

    public function job() {
        return $this->belongsTo(Type_job::class, 'job_id');
    }

    public function subJob() {
        return $this->belongsTo(Type_sub_job::class, 'sub_job_id');
    }

    public function continent() {
        return $this->belongsTo(Type_continent::class, 'continent_id');
    }

    public function country()
    {
        return $this->belongsTo(Type_country::class, 'country_id');
    }

    public function contract() {
        return $this->belongsTo(Type_contract::class, 'contract_id');
    }

    public function owwa() {
        return $this->belongsTo(Type_owwa::class, 'owwa_id');
    }
}
