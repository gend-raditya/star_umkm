<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan_items', function (Blueprint $table) {
            // Tambah kolom lokasi terakhir dan koordinat
            $table->string('lokasi_terakhir')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesanan_items', function (Blueprint $table) {
            $table->dropColumn(['lokasi_terakhir', 'latitude', 'longitude']);
        });
    }
};
