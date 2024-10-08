<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Type_sub_job extends Model
{
    use HasFactory;

    protected $table = 'type_sub_jobs';
    protected $fillable = [
        'name',
        'remarks',
        'job_id',
        'created_by',
        'updated_by',
    ];

    public static function getAllSubJob() {
        return self::all();
    }

    public static function getSubJobsByJobId($jobId) {
        return self::where('job_id', $jobId)->get();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function job() {
        return $this->belongsTo(Type_job::class, 'job_id');
    }

    public static function findByNameOrFail($name)
    {
        return self::where('name', $name)->firstOrFail();
    }
}