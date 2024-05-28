<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_job extends Model
{
    use HasFactory;

    protected $table = 'type_jobs';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public static function getAllJob() {
        return self::all();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}