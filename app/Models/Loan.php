<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'inventory_id',
        'jumlah',
        'nama_peminjam',
        'kelas',
        'jurusan',
        'alasan',
        'status',
        'tanggal_kembali',   
        'kondisi_kembali',    
        'detail_kerusakan',   
        'foto_bukti', 
        'tanggal_kembali_request',
        'tanggal_kembali_disetujui',
        'catatan_admin',      
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}