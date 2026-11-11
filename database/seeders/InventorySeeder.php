<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        Inventory::create([
            'nama_barang' => 'Laptop ASUS ROG',
            'kategori' => 'Elektronik',
            'stok' => 15,
            'status' => 'Tersedia',
            'deskripsi' => 'Laptop untuk praktikum RPL',
        ]);

        Inventory::create([
            'nama_barang' => 'Proyektor Epson X51',
            'kategori' => 'Elektronik',
            'stok' => 1,
            'status' => 'Tersedia',
            'deskripsi' => 'Proyektor untuk presentasi kelas',
        ]);

        Inventory::create([
            'nama_barang' => 'Kabel HDMI',
            'kategori' => 'Aksesoris',
            'stok' => 8,
            'status' => 'Tersedia',
            'deskripsi' => 'Kabel HDMI 2 meter',
        ]);
    }
}