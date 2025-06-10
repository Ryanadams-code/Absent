<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'capacity',
        'building',
        'floor',
        'description',
        'status'
    ];

    /**
     * Get the schedules that use this room.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}