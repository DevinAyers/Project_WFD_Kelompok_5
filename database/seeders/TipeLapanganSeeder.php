<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeLapanganSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipe_lapangans')->truncate();

        DB::table('tipe_lapangans')->insert([
            ['name' => 'Lapangan Tennis'],
            ['name' => 'Lapangan Futsal'],
            ['name' => 'Lapangan Basket'],
        ]);
    }
}
