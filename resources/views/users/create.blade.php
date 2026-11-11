@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center py-6">
        <div class="bg-gray-100 rounded-3xl p-10 w-full max-w-2xl shadow-sm">
            <h2 class="text-3xl text-center mb-8 font-normal">Tambah User Baru</h2>
            
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-lg mb-2">Nama Lengkap:</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-lg mb-2">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-lg mb-2">Password:</label>
                    <input type="password" name="password" required min="6"
                        class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                </div>

                <div class="mb-8">
                    <label class="block text-lg mb-2">Role:</label>
                    <select name="role" required class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    </select>
                </div>

                <div class="flex justify-center gap-6">
                    <a href="{{ route('users.index') }}" class="bg-white text-black text-lg px-8 py-3 rounded-full shadow hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="bg-custom-orange text-black text-lg px-8 py-3 rounded-full shadow hover:opacity-90">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection