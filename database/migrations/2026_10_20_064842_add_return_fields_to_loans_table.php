<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->timestamp('tanggal_kembali')->nullable()->after('status');
            $table->string('kondisi_kembali')->nullable()->after('tanggal_kembali'); 
            $table->text('detail_kerusakan')->nullable()->after('kondisi_kembali');
            $table->string('foto_bukti')->nullable()->after('detail_kerusakan');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kembali', 'kondisi_kembali', 'detail_kerusakan', 'foto_bukti']);
        });
    }
};