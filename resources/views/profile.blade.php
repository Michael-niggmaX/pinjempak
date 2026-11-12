@extends('layouts.main')

@section('content')
    <div class="flex justify-center mt-4 md:mt-8">
        <div class="bg-white rounded-3xl w-full max-w-2xl p-6 md:p-10 shadow-sm border border-gray-100">
            
            <div class="mb-8 border-b pb-4">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-800">Pengaturan Akun</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola keamanan akun Anda di sini.</p>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6 shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Info Akun (Readonly) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                    <input type="text" value="{{ Auth::user()->name }}" readonly
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-700 outline-none cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                    <input type="text" value="{{ Auth::user()->email }}" readonly
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-gray-700 outline-none cursor-not-allowed">
                </div>
            </div>

            <!-- Form Ganti Password -->
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ganti Password</h3>
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Password Lama -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                    <input type="password" name="current_password" required
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all"
                        placeholder="Masukkan password saat ini">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" required
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all"
                        placeholder="Minimal 6 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all"
                        placeholder="Ulangi password baru">
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-custom-orange text-white font-medium px-8 py-3 rounded-xl hover:bg-orange-500 transition-colors shadow-sm">
                        Simpan Password Baru
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection