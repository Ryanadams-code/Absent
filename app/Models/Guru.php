<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'mata_pelajaran',
        'user_id',
        'record_flag'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($guru) {
            $guru->record_flag = 'active';
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
     * Get the user that owns the guru.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
