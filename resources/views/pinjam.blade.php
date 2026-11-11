@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center py-6">
        <div class="bg-white rounded-3xl p-10 w-full max-w-3xl shadow-xl border border-gray-100">
            <h2 class="text-4xl text-center mb-8 font-normal text-gray-800">Pinjam Barang</h2>
            
            <form action="{{ route('pinjam.store', $item->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-xl mb-2">Nama Barang:</label>
                    <input type="text" value="{{ $item->nama_barang }}" readonly
                        class="w-1/2 rounded-xl border border-gray-200 p-4 text-lg bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Jumlah:</label>
                    <input type="number" name="jumlah" value="1" min="1" max="{{ $item->stok }}" required
                        class="w-1/2 rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                    <p class="text-sm text-gray-500 mt-1">Stok tersedia: {{ $item->stok }}</p>
                    @error('jumlah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Nama Peminjam:</label>
                    <input type="text" name="nama_peminjam" value="{{ auth()->user()->name }}" readonly
                        class="w-full rounded-xl border border-gray-200 p-4 text-lg bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                @if(auth()->user()->role === 'siswa')
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xl mb-2">Kelas:</label>
                        <input type="text" name="kelas" placeholder="Contoh: XII" required
                            class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xl mb-2">Jurusan:</label>
                        <input type="text" name="jurusan" placeholder="Contoh: RPL" required
                            class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                    </div>
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-xl mb-2">Tanggal Rencana Kembali:</label>
                    <input type="date" name="tanggal_kembali_request" required min="{{ date('Y-m-d') }}"
                        class="w-1/2 rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm bg-white">
                    @error('tanggal_kembali_request')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-xl mb-2">Tujuan:</label>
                    <textarea name="alasan" rows="3" required class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm"></textarea>
                </div>

                <div class="flex justify-center gap-6">
                    <a href="{{ route('home') }}" class="bg-gray-100 text-gray-700 text-xl px-10 py-3 rounded-full shadow-sm hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-custom-orange text-white text-xl px-10 py-3 rounded-full shadow-md hover:bg-orange-500 transition-colors">
                        Pinjam
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection