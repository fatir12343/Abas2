<?php

namespace App\Console\Commands;

use App\Models\absensi as ModelsAbsensi;
use App\Models\siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class absensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:absensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();

        // Jika Weekend Absen tidak akan dimasukan
        // if ($today->isWeekend()) {
        //     $this->info("Today is a weekend. No absensi data inserted.");
        //     return;
        // }

        $date = $today->format('Y-m-d');

        // Fetch all students and create default absensi entries if not already present
        $students = Siswa::all();

        foreach ($students as $student) {
            ModelsAbsensi::firstOrCreate(
                [
                    'nis' => $student->nis,
                    'date' => $date,
                ],
                [
                    'status' => 'Alfa', // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'titik_koordinat_masuk' => null,
                    'titik_koordinat_pulang' => null,
                    'photo_in' => null,
                    'photo_out' => null,
                    'keterangan' => null,
                    'menit_keterlambatan' => null,
                ]
            );
        }

        $this->info("Daily absensi data inserted successfully for $date.");
    }
}
