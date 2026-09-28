<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balita;

class BalitaSeeder extends Seeder
{
    public function run()
    {
        Balita::factory()->count(10)->create();
    }
}
