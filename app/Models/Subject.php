<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'status'
    ];

    /**
     * Get the schedules that use this subject.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the gurus that teach this subject.
     */
    public function gurus()
    {
        return $this->belongsToMany(Guru::class, 'guru_subject');
    }
}