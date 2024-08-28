<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Wali_Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            Wali_SiswaSeeder::class,
            WaliSeeder::class,
            JurusanSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            // otherTable::class
        ]);

    }
}
