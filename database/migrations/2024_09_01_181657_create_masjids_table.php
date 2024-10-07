<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masjids', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_masjid');
            $table->string('lokasi');
            $table->string('provinsi');
            $table->string('kecamatan');
            $table->text('visi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('misi')->nullable();
            $table->string('gambar_profil')->nullable();
            $table->string('gambar_sampul')->nullable();
            $table->decimal('luas', 8, 2)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->string('facebook', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
