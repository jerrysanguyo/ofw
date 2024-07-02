<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_need extends Model
{
    use HasFactory;

    protected $table = 'user_needs';
    protected $fillable = [
        'user_id',
        'need_id',
    ];

    public static function getAllNeeds() {
        return self::all();
    }    
    
    public static function distinctNeedsCount()
    {
        return self::select('need_id', DB::raw('count(*) as needsCount'))
                   ->groupBy('need_id')
                   ->get();
    }

    public function typeNeeds() {
        return $this->belongsTo(Type_need::class, 'need_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
