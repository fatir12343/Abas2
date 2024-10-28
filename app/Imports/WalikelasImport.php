<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Wali_kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WalikelasImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {   
        foreach($rows as $row) {
            // dd($row);php
             // Check if the User already exists
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
                 'role' => 'wali'
             ]);
         }

         $wali = Wali_kelas::where('nip', $row['nip'])->first();
         if ($wali) {
            $wali->update([
                'id_user' => $user->id, // Mengaitkan user dengan wali
                'jenis_kelamin' => $row['jenis_kelamin'], // Pastikan kolom ini ada di CSV
                'nip' => $row['nip'], // Pastikan kolom ini ada di CSV
            ]);
         } else {
            $wali = Wali_kelas::create([
                'nip' => $row['nip'], // Pastikan kolom ini ada di CSV
                'id_user' => $user->id, // Mengaitkan user dengan wali
                'jenis_kelamin' => $row['jenis_kelamin'], // Pastikan kolom ini ada di CSV
                'nuptk' => $row['nuptk'],
            ]);
         }
        }
    }
}
