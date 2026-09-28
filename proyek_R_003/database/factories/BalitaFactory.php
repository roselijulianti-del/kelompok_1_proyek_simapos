<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Balita;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalitaFactory extends Factory
{

    protected $model = Balita::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nik' => $this->faker->unique()->numerify('###############'),
            'nama_balita' => $this->faker->firstName(),
            'usia_tahun' => $this->faker->numberBetween(0, 5),
            'usia_bulan' => $this->faker->numberBetween(0, 11),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => $this->faker->address(),
            'nama_orang_tua' => $this->faker->name(),
        ];
    }
}
