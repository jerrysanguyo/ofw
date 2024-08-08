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
        'user_id',
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
        return self::select(
            DB::raw('CASE 
                WHEN age BETWEEN 0 AND 10 THEN "0-10" 
                WHEN age BETWEEN 11 AND 20 THEN "11-20" 
                ELSE "21-above" 
            END as age_group'),
            DB::raw('count(*) as beneficiaryCount'))
            ->groupBy('age_group')
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
