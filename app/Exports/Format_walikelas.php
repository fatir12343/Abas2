<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class Format_walikelas implements FromArray
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return ([
            ['nama', 'email', 'nuptk', 'nip', 'jenis_kelamin', 'tingkat', 'id_jurusan', 'nomor_kelas'],
        ]);
    }
}
