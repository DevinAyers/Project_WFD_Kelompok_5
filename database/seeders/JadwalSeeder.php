<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        \DB::table('jadwals')->truncate();

        $lapangans = Lapangan::all();

        foreach ($lapangans as $lapangan) {
            $startDate = Carbon::now()->addDays(1); // mulai besok

            for ($i = 0; $i < 5; $i++) {
                $tanggal = $startDate->copy()->addDays($i);

                $slotJam = [
                    ['08:00', '10:00'],
                    ['10:00', '12:00'],
                    ['13:00', '15:00'],
                    ['15:00', '17:00'],
                ];

                foreach ($slotJam as [$jamMulai, $jamSelesai]) {
                    Jadwal::create([
                        'lapangan_id' => $lapangan->id,
                        'tanggal' => $tanggal->format('Y-m-d'),
                        'jam_mulai' => $jamMulai,
                        'jam_selesai' => $jamSelesai,
                    ]);
                }
            }
        }
    }
}
