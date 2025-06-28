<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    public function run()
    {
        
        DB::table('lapangans')->insert([
            [
                'name' => 'Gor Satria Purwokerto',
                'alamat' => 'Purwokerto, Jawa Tengah',
                'gambar' => 'images/Gor.jpg',
                'deskripsi' => 'Lapangan multifungsi dengan fasilitas lengkap di pusat kota Purwokerto.',
                'kontak' => '0812-3456-7890',
                'harga' => 250000,
            ],
            [
                'name' => 'Lapangan Futsal Bina Sport',
                'alamat' => 'Bandung, Jawa Barat',
                'gambar' => 'images/bina_sport.jpg',
                'deskripsi' => 'Lapangan futsal indoor dengan rumput sintetis premium.',
                'kontak' => '0821-9876-5432',
                'harga' => 150000,
            ],
            [
                'name' => 'GOR Pajajaran',
                'alamat' => 'Bogor, Jawa Barat',
                'gambar' => 'images/gor_pajajaran.jpg',
                'deskripsi' => 'GOR serbaguna untuk basket, badminton, dan voli.',
                'kontak' => '0813-1234-5678',
                'harga' => 100000,
            ],
            [
                'name' => 'Lapangan Badminton Cendrawasih',
                'alamat' => 'Jakarta Selatan',
                'gambar' => 'images/badminton_cendrawasih.jpg',
                'deskripsi' => 'Lapangan khusus badminton dengan pencahayaan profesional.',
                'kontak' => '0856-7890-1234',
                'harga' => 90000,
            ],
            [
                'name' => 'Lapangan Tenis Tugu Muda',
                'alamat' => 'Semarang, Jawa Tengah',
                'gambar' => 'images/tenis_tugu_muda.jpg',
                'deskripsi' => 'Lapangan tenis terbuka dekat ikon kota Semarang.',
                'kontak' => '0899-4567-3210',
                'harga' => 120000,
            ],
            [
                'name' => 'Lapangan Basket Delta',
                'alamat' => 'Sidoarjo, Jawa Timur',
                'gambar' => 'images/basket_delta.jpg',
                'deskripsi' => 'Lapangan basket outdoor dengan tribun penonton.',
                'kontak' => '0877-6543-2109',
                'harga' => 140000,
            ],
        ]);
    }
}
