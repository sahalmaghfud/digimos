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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('masjid_id')->constrained('masjids')->onDelete('cascade')->index();
            $table->string('judul_berita');
            $table->string('slug')->unique();
            $table->text('isi_berita');
            $table->string('gambar')->nullable();
            $table->date('tanggal_publikasi');
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
