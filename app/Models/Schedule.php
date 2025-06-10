<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'day',
        'start_time',
        'end_time',
        'guru_id',
        'subject_id', // New foreign key
        'subject',    // Keep for backward compatibility
        'room_id',    // New foreign key
        'room',       // Keep for backward compatibility
        'description',
        'status'
    ];

    /**
     * Get the guru that owns the schedule.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /**
     * Get the subject associated with the schedule.
     */
    public function subjectRelation()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    /**
     * Get the room associated with the schedule.
     */
    public function roomRelation()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the students assigned to this schedule.
     */
    public function murids()
    {
        return $this->belongsToMany(Murid::class, 'schedule_murid');
    }

    /**
     * Get the attendances for this schedule.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
