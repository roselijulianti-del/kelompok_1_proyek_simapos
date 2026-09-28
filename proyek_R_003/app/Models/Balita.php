<?php

namespace App\Models;

use App\Models\Pemeriksaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balita extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // di App\Models\Balita

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'balita_id');
    }

}
