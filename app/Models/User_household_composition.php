<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_household_composition extends Model
{
    use HasFactory;
    
    protected $table='user_household_compositions';
    protected $fillable=[
        'full_name',
        'relation_id',
        'birthdate',
        'age',
        'work',
        'monthly_income',
        'voters',
    ];

    public static function getAllHousehold()
    {
        self::all();
    }

    public static function distinctBeneficiaryCount()
    {
        return self::select('age', DB::raw('count(*) as beneficiaryCount'))
                   ->groupBy('age')
                   ->get();
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function relationship() {
        return $this->belongsTo(Type_relation::class, 'relation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
