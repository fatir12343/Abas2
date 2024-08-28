<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    // protected $primaryKey = 'nis';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $primaryKey = 'nis';

    protected $fillable = [
        'nis',
        'id_user',
        'id_kelas',
        'nik',
        'jenis_kelamin',
        'nisn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nis');
    }

    public function ortu()
    {
        return $this->hasOne(Wali_Siswa::class, 'nik', 'nik');
    }

    public $timestamps = false;
}
