<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Type_barangay extends Model
{
    use HasFactory;

    protected $table='type_barangays';
    protected $fillable=[
        'name',
        'created_by',
        'updated_by',
        'remarks',
    ];

    public static function getAllBarangay() {
        return self::all();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function findByNameOrFail($name)
    {
        return self::where('name', $name)->firstOrFail();
    }
}
