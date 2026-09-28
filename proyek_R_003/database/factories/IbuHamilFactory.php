<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IbuHamilFactory extends Factory
{
    protected $model = \App\Models\IbuHamil::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nik_ibu_hamil' => $this->faker->unique()->numerify('###############'),
            'nama_ibu_hamil' => $this->faker->name('female'),
            'nama_suami' => $this->faker->name('male'),
            'umur' => $this->faker->numberBetween(15, 50),
            'alamat_ibu_hamil' => $this->faker->address(),
        ];
    }
}
