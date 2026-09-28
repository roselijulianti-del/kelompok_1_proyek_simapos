<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Balita;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_add_balita_data()
    {
        $response = $this->post('/peserta/store', [
            'kategori' => 'balita',
            'nik' => '123456789',
            'nama_balita' => 'Budi',
            'usia_tahun' => 3,
            'usia_bulan' => 2,
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Mawar No.1',
            'nama_orang_tua' => 'Pak Agus',
        ]);

        // pastikan redirect (berhasil)
        $response->assertStatus(302);

        // pastikan data benar-benar masuk database
        $this->assertDatabaseHas('balitas', [
            'nama_balita' => 'Budi',
        ]);
    }
}
