<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_country extends Model
{
    use HasFactory;

    protected $table = 'Type_countries';
    protected $fillable = [
        'name',
        'continent_id',
        'created_by',
        'updated_by',
    ];

    public static function getAllCountry() {
        return self::all();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function continent() {
        return $this->belongsTo(Type_continent::class, 'continent_id');
    }
}
