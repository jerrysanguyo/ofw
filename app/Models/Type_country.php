<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Type_country extends Model
{
    use HasFactory;

    protected $table = 'Type_countries';
    protected $fillable = [
        'name',
        'remarks',
        'continent_id',
        'created_by',
        'updated_by',
    ];

    public static function getAllCountry() {
        return self::all();
    }

    public static function getCountriesByContinentId($continentId) {
        return self::where('continent_id', $continentId)->get();
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

    public static function findByNameOrFail($name)
    {
        return self::where('name', $name)->firstOrFail();
    }
}
