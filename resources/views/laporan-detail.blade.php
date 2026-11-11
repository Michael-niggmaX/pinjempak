@extends('layouts.main')

@section('content')
    <div class="flex justify-center mt-6">
        <div class="bg-gray-100 rounded-2xl w-full max-w-4xl p-8 shadow-sm relative pb-24">
            
            <h2 class="text-3xl font-medium mb-6">Laporan Kerusakan</h2>

            <div class="mb-6">
                <p class="text-lg mb-2">Bukti</p>
                <div class="bg-gray-300 w-full h-64 md:h-80 rounded-lg overflow-hidden flex items-center justify-center">
                    @if($loan->foto_bukti)
                        <img src="{{ asset('images/' . $loan->foto_bukti) }}" class="w-full h-full object-contain">
                    @else
                        <span class="text-gray-500">Tidak ada foto bukti</span>
                    @endif
                </div>
            </div>

            <div class="space-y-2 mb-8">
                <p class="text-lg">Nama item: <span class="font-medium">{{ $loan->inventory->nama_barang }}</span></p>
                <p class="text-lg">Jumlah Rusak: <span class="font-medium text-red-500">{{ $loan->jumlah }}</span></p>
                <p class="text-lg">Detail: <span class="font-medium">{{ $loan->detail_kerusakan }}</span></p>
            </div>

            <div class="absolute bottom-8 right-8">
                <form action="{{ route('laporan.konfirmasi', $loan->id) }}" method="POST" onsubmit="return confirm('Konfirmasi kerusakan ini? Stok barang akan dikurangi.');">
                    @csrf
                    <button type="submit" class="bg-custom-orange text-black text-xl px-10 py-3 rounded-full hover:opacity-90 transition">
                        Konfirmasi
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection