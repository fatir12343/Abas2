<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waktu_absen extends Model
{
    use HasFactory;

    protected $table = 'waktu_absen';
    public $primaryKey = 'id_waktu_absen';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'mulai_absen',
        'batas_absen',
        'mulai_pulang',
        'batas_pulang'
    ];

    public function waktu_absen()
    {
        return $this->hasMany(Absensi::class, 'id_waktu_absen');
    }

    public $timestamps = false;
}
