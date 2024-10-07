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
        Schema::create('zakat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignUuid('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->enum('jenis_zakat', ['beras', 'uang_tunai']);
            $table->decimal('jumlah', 8, 2);
            $table->integer('jumlah_jiwa');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakat');
    }
};
