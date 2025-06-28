<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeLapangan extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function lapangans()
    {
        return $this->hasMany(Lapangan::class, 'tipe_id');
    }
}
