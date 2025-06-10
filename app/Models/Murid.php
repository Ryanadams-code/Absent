<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murids';

    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'kelas',
        'user_id',
        'record_flag'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($murid) {
            $murid->record_flag = 'active';
        });
    }

    /**
     * Scope a query to only include active records.
     */
    public function scopeActive($query)
    {
        return $query->where('record_flag', 'active');
    }

    /**
     * Get the user that owns the murid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
{
    return $this->belongsToMany(Schedule::class, 'schedule_murid');
}


}
