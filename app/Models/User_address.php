<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';
    protected $fillable = [
        'user_id',
        'house_number',
        'barangay_id',
        'street',
        'city_id',
        'residence_years',
        'residence_id',
    ];

    public function barangay() {
        return $this->belongsTo(Type_barangay::class, 'barangay_id');
    }

    public function city() {
        return $this->belongsTo(Type_city::class, 'city_id');
    }

    public function residence() {
        return $this->belongsTo(Type_residence::class, 'residence_id');
    }
}
