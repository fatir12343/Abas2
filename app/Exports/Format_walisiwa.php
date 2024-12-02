<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class Format_walisiwa implements FromArray
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [
            ['nik', 'email', 'nama', 'jenis_kelamin','alamat'],
        ];
    }
}
