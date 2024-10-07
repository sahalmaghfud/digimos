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
        Schema::create('inventarises', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->string('nama_barang');
            $table->unsignedInteger('jumlah');
            $table->string('kondisi', 50);
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
