<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\User;

class PesertaSeeder extends Seeder
{
  public function run()
  {
    $users = User::all();

    foreach ($users as $user) {
      Balita::factory(20)->create([
        'user_id' => $user->id
      ]);

      IbuHamil::factory(20)->create([
        'user_id' => $user->id
      ]);
    }
  }
}
