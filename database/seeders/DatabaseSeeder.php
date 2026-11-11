<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas PinjemPak',
            'email' => 'petugas@pinjempak.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Guru PinjemPak',
            'email' => 'guru@pinjempak.test',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Siswa PinjemPak',
            'email' => 'siswa@pinjempak.test',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        Inventory::create([
            'nama_barang' => 'Laptop ASUS ROG',
            'kategori' => 'Elektronik',
            'stok' => 15,
            'stok_rusak' => 0,
            'status' => 'Tersedia',
            'deskripsi' => 'Laptop untuk praktikum RPL dan desain grafis.',
            'gambar_barang' => null, 
        ]);

        Inventory::create([
            'nama_barang' => 'Proyektor Epson X51',
            'kategori' => 'Elektronik',
            'stok' => 2,
            'stok_rusak' => 0,
            'status' => 'Tersedia',
            'deskripsi' => 'Proyektor untuk presentasi kelas dan acara sekolah.',
            'gambar_barang' => null,
        ]);

        Inventory::create([
            'nama_barang' => 'Kabel HDMI 2 Meter',
            'kategori' => 'Aksesoris',
            'stok' => 10,
            'stok_rusak' => 0,
            'status' => 'Tersedia',
            'deskripsi' => 'Kabel HDMI untuk menghubungkan laptop ke proyektor.',
            'gambar_barang' => null,
        ]);

        Inventory::create([
            'nama_barang' => 'Palu Besi 500gr',
            'kategori' => 'Alat',
            'stok' => 5,
            'stok_rusak' => 1,
            'status' => 'Tersedia',
            'deskripsi' => 'Palu besi untuk praktikum teknik mesin.',
            'gambar_barang' => null,
        ]);

        Inventory::create([
            'nama_barang' => 'Tang Kombinasi',
            'kategori' => 'Alat',
            'stok' => 8,
            'stok_rusak' => 0,
            'status' => 'Tersedia',
            'deskripsi' => 'Tang kombinasi untuk keperluan praktikum kelistrikan.',
            'gambar_barang' => null,
        ]);
    }
}