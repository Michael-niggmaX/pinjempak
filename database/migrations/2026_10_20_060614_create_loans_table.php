<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa yang minjem
            $table->foreignId('inventory_id')->constrained('inventories')->onDelete('cascade'); // Barang apa
            $table->integer('jumlah');
            $table->string('nama_peminjam');
            $table->string('kelas');
            $table->string('jurusan');
            $table->text('alasan');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};