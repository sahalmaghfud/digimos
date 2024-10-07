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
        Schema::create('penguruses', function (Blueprint $table) {  // Nama tabel diubah menjadi 'pengurus'
            $table->id();
            $table->foreignUuid('masjid_id')->constrained('masjids')->onDelete('cascade'); // Relasi ke tabel masjids dengan index
            $table->string('nama_pengurus');
            $table->string('jabatan');
            $table->string('kontak', 20)->nullable();
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
