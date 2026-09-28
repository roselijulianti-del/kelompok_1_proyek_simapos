<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IbuHamil;

class IbuHamilSeeder extends Seeder
{
    public function run()
    {
        IbuHamil::factory()->count(10)->create();
    }
}
