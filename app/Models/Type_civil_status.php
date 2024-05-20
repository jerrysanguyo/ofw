<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_civil_status extends Model
{
    use HasFactory;

    protected $table = 'Type_civil_statuses';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public static function getAllCivil() {
        return self::all();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
