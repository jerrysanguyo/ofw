<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number',
        'password',
        'role',
    ];

    public static function getAllUser()
    {
        return self::all();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getApplicantById($id)
    {
        return self::where('id', $id)
                   ->whereHas('userInfo')
                   ->whereHas('userAddress')
                   ->get();
    }

    public function userInfo()
    {
        return $this->hasOne(User_info::class, 'user_id', 'id');
    }

    public function userAddress()
    {
        return $this->hasOne(User_address::class, 'user_id', 'id');
    } 

    public function userPrevious()
    {
        return $this->hasOne(User_previous_job::class, 'user_id', 'id');
    }

    public function userHousehold()
    {
        return $this->hasMany(User_household_composition::class, 'user_id', 'id');
    }

    public function userNeeds()
    {
        return $this->hasMany(User_need::class, 'user_id', 'id');
    }
}