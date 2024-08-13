<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Type_Need extends Model
{
    use HasFactory;

    protected $table = 'type_needs';
    protected $fillable = [
        'name',
        'remarks',
        'updated_by',
        'created_by',
    ];

    public static function getAllNeed() 
    {
        return self::All();
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
