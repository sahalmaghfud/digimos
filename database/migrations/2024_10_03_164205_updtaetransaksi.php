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
        Schema::table('transaksis', function (Blueprint $table) {
            // Tambahkan kolom Saldo_id dan buat foreign key secara langsung
            $table->unsignedBigInteger('Saldo_id')->after('masjid_id'); // Sesuaikan letak sesuai kebutuhan
            $table->foreign('Saldo_id')->references('id')->on('Saldos')->onDelete('cascade');
            $table->dropColumn('Saldo');
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
