<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'status',
        'keterangan',
        'photo_in',
        'photo_out',
        'date',
        'jam_masuk',
        'jam_pulang',
        'titik_koordinat',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function koordinat()
    {
        return $this->belongsTo(Koordinat_Sekolah::class, 'id_koordinat_sekolah');
    }

}
