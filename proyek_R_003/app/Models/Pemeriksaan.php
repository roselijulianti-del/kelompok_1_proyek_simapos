<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeriksaan extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $guarded = [
        'id',
    ];

    // Relasi
    // Relasi ke Balita
    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }

    // Relasi ke Ibu Hamil
    public function ibu_hamil()
    {
        return $this->belongsTo(IbuHamil::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

