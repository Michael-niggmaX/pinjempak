<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // Tambahan untuk migrasi

/*
|--------------------------------------------------------------------------
| ROUTE RAHASIA (UNTUK MIGRASI DI WASMER)
|--------------------------------------------------------------------------
| HAPUS ROUTE INI SETELAH MIGRASI BERHASIL!
*/
Route::get('/migrate-rahasia', function () {
    try {
        Artisan::call('migrate:fresh --seed --force');
        return 'Mantap! Migrasi dan Seeder BERHASIL dijalankan di server Wasmer.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});


/*
|--------------------------------------------------------------------------
| ROUTE UTAMA APLIKASI
|--------------------------------------------------------------------------
*/

// Route publik (bisa diakses tanpa login)
Route::get('/', [InventoryController::class, 'index'])->name('home');

// Route untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/barang/{id}', [InventoryController::class, 'show'])->name('show');
    Route::get('/barang/{id}/edit', [InventoryController::class, 'edit'])->name('edit');
    Route::put('/barang/{id}', [InventoryController::class, 'update'])->name('update');
    Route::get('/pinjam/{id}', [LoanController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam/{id}', [LoanController::class, 'store'])->name('pinjam.store');
    Route::get('/riwayat', [LoanController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/export', [LoanController::class, 'exportExcel'])->name('riwayat.export');
    Route::post('/pending/{id}/konfirmasi-kembali', [LoanController::class, 'konfirmasiKembali'])->name('pending.konfirmasi-kembali');
    Route::post('/pending/{id}/tolak-kembali', [LoanController::class, 'tolakKembali'])->name('pending.tolak-kembali');

    // Route Pengaturan Akun
    Route::get('/profil', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profil/password', [AuthController::class, 'updatePassword'])->name('profile.password');

    // Route khusus Admin
    Route::get('/tambah-barang', [InventoryController::class, 'create'])->name('create');
    Route::post('/tambah-barang', [InventoryController::class, 'store'])->name('store');
    Route::delete('/hapus-barang/{id}', [InventoryController::class, 'destroy'])->name('destroy');
    Route::get('/pending', [LoanController::class, 'pending'])->name('pending');
    Route::get('/pending/{id}', [LoanController::class, 'show'])->name('pending.show');
    Route::post('/pending/{id}/konfirmasi', [LoanController::class, 'konfirmasi'])->name('pending.konfirmasi');
    Route::post('/pending/{id}/tolak', [LoanController::class, 'tolak'])->name('pending.tolak');

    // Route Kelola User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
     
    // Route Laporan Kerusakan (Admin)
    Route::get('/laporan', [LoanController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/{id}', [LoanController::class, 'laporanDetail'])->name('laporan.detail');
    Route::post('/laporan/{id}/konfirmasi', [LoanController::class, 'laporanKonfirmasi'])->name('laporan.konfirmasi');

    // Halaman Kembalikan Barang (Siswa)
    Route::get('/kembalikan', [LoanController::class, 'indexKembalikan'])->name('kembalikan');
    Route::post('/kembalikan/{id}', [LoanController::class, 'prosesKembalikan'])->name('proses-kembalikan');
    Route::get('/kembalikan/form/{id}', [LoanController::class, 'formKembalikan'])->name('form-kembalikan');
    Route::get('/pending/kembali/{id}', [LoanController::class, 'showKembali'])->name('pending.show-kembali');

    // Halaman Lapor Rusak (Dari form Kembalikan)
    Route::get('/lapor-rusak/{id}', [LoanController::class, 'formRusak'])->name('lapor-rusak');
    Route::post('/lapor-rusak/{id}', [LoanController::class, 'prosesRusak'])->name('proses-rusak');
});