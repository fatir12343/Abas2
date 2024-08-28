<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_kelas extends Model
{
    use HasFactory;


    protected $table = 'wali_kelas';
    // protected $primaryKey = 'nuptk'; // Sesuaikan dengan primary key yang digunakan
    // public $incrementing = false; // Karena primary key bukan incrementing integer
    // protected $keyType = 'string'; // Tipe data primary key

    protected $fillable = [
        'nuptk',
        'id_user',
        'jenis_kelamin',
        'nip',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->hasOne(kelas::class, 'nuptk', 'nuptk');
    }
    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class,kelas::class, 'nuptk', 'id_jurusan', 'nuptk', 'id_jurusan');
    }

    public $timestamps = false;
}
