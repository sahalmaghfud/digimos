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
        Schema::table('masjids', function (Blueprint $table) {
            // $table->renameColumn('provinsi', 'kodeProvinsi');
            $table->renameColumn('kecamatan', 'kodeKecamatan');
            $table->renameColumn('lokasi', 'linkLokasi');
        });

        Schema::table('masjids', function (Blueprint $table) {
            $table->unsignedInteger('kodeProvinsi')->change();
            $table->unsignedInteger('kodeKabupaten');
            $table->unsignedInteger('kodeKecamatan')->change();
            $table->text('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masjids', function (Blueprint $table) {});
    }
};
