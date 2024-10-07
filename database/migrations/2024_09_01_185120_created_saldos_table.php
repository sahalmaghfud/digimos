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
        Schema::create('Saldos', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->decimal('kas_masjid', 15, 2)->default(0);
            $table->decimal('infaq', 15, 2)->default(0);
            $table->decimal('yatim', 15, 2)->default(0);
            $table->decimal('tpa', 15, 2)->default(0);
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
