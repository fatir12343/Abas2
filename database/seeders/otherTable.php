<?php

namespace Database\Seeders;

use App\Models\waktu_absen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class otherTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     DB::table('koordinat__sekolah')->insert
    //     (
    //         [
    //             'id_koordinat_sekolah' => '1',
    //             'lokasi_sekolah' => '-6.89033536888645, 107.55833009635417',
    //             'radius' => 200.00
    //         ]
    //     );

    //     $waktu =
    //     [
    //         'id_waktu_absen' => 1,
    //         'jam_absen' => '06:00:00',
    //         'batas_absen_masuk' => '07:00:00',
    //         'jam_pulang' => '15:00:00',
    //         'batas_absen_pulang' => '17:00:00',
    //         'toleransi_waktu' => '600'
    //     ];

    //     // $absen =
    //     // [
    //     //     [
    //     //         'id_absensi' => 1,
    //     //         'nis' => 110,
    //     //         'id_koordinat_sekolah' => 1,
    //     //         'id_waktu_absen' => 1,
    //     //         'status' => 'hadir',
    //     //         'bukti' => 'path',
    //     //         'keterangan' => null,
    //     //         'date' => now(),
    //     //         'jam_masuk' => '06:30:00',
    //     //         'jam_pulang' => '14:00:00',
    //     //         'titik_koordinat_masuk' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)'),
    //     //         'titik_koordinat_pulang' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)')
    //     //     ],

    //     //     [
    //     //         'id_absensi' => 2,
    //     //         'nis' => 111,
    //     //         'id_koordinat_sekolah' => 1,
    //     //         'id_waktu_absen' => 1,
    //     //         'status' => 'hadir',
    //     //         'bukti' => 'path',
    //     //         'keterangan' => null,
    //     //         'date' => now(),
    //     //         'jam_masuk' => '06:30:00',
    //     //         'jam_pulang' => null,
    //     //         'titik_koordinat_masuk' =>  DB::raw('ST_GeomFromText("POINT(-6.9131982 107.6090273)", 4326)'),
    //     //         'titik_koordinat_pulang' =>  null
    //     //     ]
    //     // ];

    //     waktu_absen::insert($waktu);
    //     // absensi::insert($absen);
    // }
}
}
