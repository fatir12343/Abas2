<?php

namespace App\Imports;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Cek apakah user dengan email tersebut sudah ada
            $user = User::where('email', $row['email'])->first();

            if ($user) {
                // Update existing User
                $user->update([
                    'name' => $row['nama'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT), // Optional: only update password if needed
                ]);
            } else {
                // Create new User
                $user = User::create([
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'siswa'
                ]);
               }

            // Cek apakah kelas sudah ada, sesuaikan logika jika ingin mendefinisikan kelas berdasarkan input di file impor
            $kelas = kelas::where('id_kelas', $row['id_kelas'])->first();

            if (!$kelas) {
                // Jika kelas tidak ditemukan, Anda bisa handle error atau skip proses import ini
                continue;
            }

            // Cek apakah siswa dengan NIS sudah ada
            $siswa = Siswa::where('nis', $row['nis'])->first();

            if ($siswa) {
                // Update data siswa yang sudah ada
                $siswa->update([
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas, // Mengambil id_kelas dari data yang telah diambil
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nisn' => $row['nisn'],
                ]);
            } else {
                // Buat data siswa baru
                Siswa::create([
                    'nis' => $row['nis'],
                    'id_user' => $user->id,
                    'id_kelas' => $kelas->id_kelas,
                    'nik_ayah' => ['nik_ayah'],
                    'nik_ibu' => ['nik_ibu'],
                    'nik_wali' => ['nik_wali'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nisn' => $row['nisn'],
                ]);
            }
        }
    }
}
