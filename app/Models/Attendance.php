<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'murid_id',
        'date',
        'status', // present, absent, late, sick, permission
        'notes',
        'marked_by' // user_id of the teacher or admin who marked the attendance
    ];

    /**
     * Get the schedule that owns the attendance.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the murid that owns the attendance.
     */
    public function murid()
    {
        return $this->belongsTo(Murid::class);
    }

    /**
     * Get the user who marked the attendance.
     */
    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}