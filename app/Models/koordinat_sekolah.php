<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class koordinat_sekolah extends Model
{
    use HasFactory;

    protected $table = 'koordinat_sekolah';
    public $primaryKey = 'id_koordinat_sekolah';
    protected $fillable = [
        'titik_koordinat',
        'radius',
    ];

    public function koordinat()
    {
        return $this->hasMany(Absensi::class, 'id_koordinat_sekolah');
    }

    public $timestamps = false;
}
