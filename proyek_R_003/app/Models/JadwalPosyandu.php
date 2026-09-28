<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->keterangan . '-' . Str::random(5));
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->keterangan . '-' . Str::random(5));
        });
    }
}