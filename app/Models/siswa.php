<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    // protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'nis';

    protected $fillable = [
        'nis',
        'id_user',
        'id_kelas',
        'nik_ayah',
        'nik_ibu',
        'nik_wali',
        'jenis_kelamin',
        'nisn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nis', 'nis');
    }

    public function ortu()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik','nik');
    }

    public $timestamps = false;
}
