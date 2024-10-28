<?php

namespace App\Imports;

use App\Models\User;
use App\Models\wali_siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WalisiswaImport implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows )
    {
        // dd ($rows);
        foreach($rows as $row) {
            // Check if the User already exists
            $user = User::where('email', $row['email'])->first();
            if ($user) {
                // Update existing User
                $user->update([
                    'name' => $row['nama'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT), // Optional: only update password if needed
                ]);
            } else {
                // Create new Userw
             $user = User::create([
                 'name' => $row['nama'],
                 'email' => $row['email'],
                 'password' => password_hash("12345678", PASSWORD_DEFAULT),
                 'role' => 'walis'
             ]);
            }

            $walis = wali_siswa::where('nik', $row['nik'])->first();
            if($walis) {
                $walis->update([
                    'name' => $row['nama'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                ]);
            } else {
                $walis = wali_siswa::create([
                    'id_user' => $user->id,
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'nik' => $row['nik'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'alamat' => $row['alamat'],
                ]);
            }
        }
    }
}
