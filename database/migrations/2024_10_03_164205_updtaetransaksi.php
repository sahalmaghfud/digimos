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
            // Tambahkan kolom saldo_id dan buat foreign key secara langsung
            $table->unsignedBigInteger('saldo_id')->after('masjid_id'); // Sesuaikan letak sesuai kebutuhan
            $table->foreign('saldo_id')->references('id')->on('saldos')->onDelete('cascade');
            $table->dropColumn('saldo');
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
