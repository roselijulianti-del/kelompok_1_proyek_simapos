<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('tipe', ['balita', 'ibu_hamil']);
            $table->unsignedBigInteger('balita_id')->nullable();
            $table->unsignedBigInteger('ibu_hamil_id')->nullable();
            $table->dateTime('tanggal');

            // Untuk balita
            $table->integer('berat_badan_balita')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->enum('status_gizi', ['Gizi Baik', 'Gizi Buruk', 'Stunting'])->nullable();

            // Untuk ibu hamil
            $table->integer('berat_badan_ibu')->nullable();
            $table->integer('tekanan_sistolik')->nullable();
            $table->integer('tekanan_diastolik')->nullable();
            $table->integer('usia_kehamilan')->nullable();
            $table->enum('status_ibu', ['Kondisi Baik', 'Anemia'])->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('balita_id')->references('id')->on('balitas')->onDelete('cascade');
            $table->foreign('ibu_hamil_id')->references('id')->on('ibu_hamils')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
