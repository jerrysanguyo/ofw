<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_gender extends Model
{
    use HasFactory;

    protected $table = 'type_genders';
    protected $fillable = [
        'name',
        'remarks',
        'created_by',
        'updated_by',
    ];

    public static function getAllGender() {
        return self::all();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
