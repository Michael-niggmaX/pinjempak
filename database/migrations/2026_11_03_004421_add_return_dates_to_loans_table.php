<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->date('tanggal_kembali_request')->nullable()->after('alasan');
            
            $table->date('tanggal_kembali_disetujui')->nullable()->after('tanggal_kembali_request');
            
            $table->text('catatan_admin')->nullable()->after('tanggal_kembali_disetujui');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kembali_request', 'tanggal_kembali_disetujui', 'catatan_admin']);
        });
    }
};