<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'tipe_id', 'harga', 'deskripsi', 'kontak', 'alamat', 'gambar',
    ];

    // Relasi ke jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function tipe()
{
    return $this->belongsTo(TipeLapangan::class, 'tipe_id');
}


}
