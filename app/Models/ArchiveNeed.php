<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveNeed extends Model
{
    use HasFactory;

    protected $table = 'archive_needs';
    protected $fillable = [
        'user_archive_id',
        'need_id',
    ];

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
