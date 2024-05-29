<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_need extends Model
{
    use HasFactory;

    protected $table = 'user_needs';
    protected $fillable = [
        'user_id',
        'needs',
    ];

    public static function getAllNeeds() {
        return self::all();
    }
}
