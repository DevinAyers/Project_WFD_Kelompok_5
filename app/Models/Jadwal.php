<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = ['lapangan_id', 'tanggal', 'jam_mulai', 'jam_selesai'];
    protected $dates = ['tanggal'];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
        
    }
}
