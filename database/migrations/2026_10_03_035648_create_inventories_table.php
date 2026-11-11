<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
    $table->id();
    $table->string('nama_barang');
    $table->string('kategori')->nullable(); 
    $table->integer('stok')->default(0);
    $table->string('status')->default('Tersedia');
    $table->text('deskripsi')->nullable();
    $table->string('gambar_barang')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};