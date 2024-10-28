<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali_siswa extends Model
{
    use HasFactory;

    protected $table = 'wali_siswa';
    protected $primaryKey = 'nik';

    public $incrementing = false;

    protected $keyType = 'string'; 
    protected $fillable = [
        'nik',
        'id_user',
        'jenis_kelamin',
        'alamat',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'nik');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function ayah()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik', 'nik_ayah');
    }
    public function ibu()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik', 'nik_ibu');
    }
    public function wali()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik', 'nik_wali');
    }

    public $timestamps = false;
}
