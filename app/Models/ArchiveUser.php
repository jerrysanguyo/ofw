<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'contact_number',
    ];

    public function userArchiveInfo()
    {
        return $this->hasOne(ArchiveInfo::class, 'user_archive_id', 'id');
    }

    public function userArchiveAddress()
    {
        return $this->hasOne(ArchiveAddress::class, 'user_archive_id', 'id');
    } 

    public function userArchivePrevious()
    {
        return $this->hasOne(ArchivePrevious::class, 'user_archive_id', 'id');
    }

    public function userArchiveHousehold()
    {
        return $this->hasMany(ArchiveHousehold::class, 'user_archive_id', 'id');
    }

    public function userArchiveNeeds()
    {
        return $this->hasMany(ArchiveNeed::class, 'user_archive_id', 'id');
    }
}
