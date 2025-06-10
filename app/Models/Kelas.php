<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    
    protected $fillable = [
        'name',
        'code',
        'capacity',
        'grade_level',
        'major',
        'description',
        'status'
    ];

    /**
     * Get the students that belong to this class.
     */
    public function murids()
    {
        return $this->hasMany(Murid::class, 'kelas_id');
    }
}