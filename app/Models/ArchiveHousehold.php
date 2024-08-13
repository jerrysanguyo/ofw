<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveHousehold extends Model
{
    use HasFactory;
    
    protected $table='archive_households';
    protected $fillable=[
        'user_archive_id',
        'full_name',
        'relation_id',
        'birthdate',
        'age',
        'work',
        'monthly_income',
        'voters',
    ];

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function relationship() {
        return $this->belongsTo(Type_relation::class, 'relation_id');
    }
}
