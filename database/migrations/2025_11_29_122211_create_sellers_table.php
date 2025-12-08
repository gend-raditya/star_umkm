<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('sellers', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('user_id');
$table->string('nama_seller');
$table->string('foto_toko')->nullable();
$table->string('nomor_hp');
$table->string('nomor_rekening');
$table->timestamps();


$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
}


public function down(): void
{
Schema::dropIfExists('sellers');
}
};
