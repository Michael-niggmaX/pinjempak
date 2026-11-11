@extends('layouts.main')

@section('content')
    <div class="flex justify-center mt-4">
        <div class="bg-gray-100 rounded-xl w-full max-w-4xl p-8 shadow-sm relative">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-300 w-full h-72 md:h-96 mb-6 rounded-lg overflow-hidden flex items-center justify-center">
                @if($item->gambar_barang)
                    <img src="{{ asset('images/' . $item->gambar_barang) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500 text-xl">No Image</span>
                @endif
            </div>

            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-3xl font-medium">{{ $item->nama_barang }}</h1>
                <span class="text-xl font-medium">{{ $item->status }}</span>
            </div>

            <div class="mb-20">
                <p class="text-xl mb-2"><span class="font-normal">Kategori:</span> {{ $item->kategori }}</p>
                                <p class="text-xl mb-2"><span class="font-normal">Stok Tersedia:</span> {{ $item->stok }}</p>
                <p class="text-xl mb-4"><span class="font-normal">Stok Rusak:</span> {{ $item->stok_rusak ?? 0 }}</p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>
            </div>

            <div class="absolute bottom-8 right-8">
                @if(Auth::user()->role === 'petugas')
                    <a href="{{ route('edit', $item->id) }}" class="bg-custom-orange text-black text-xl px-12 py-3 rounded-full shadow hover:opacity-90 transition">
                        Edit Barang
                    </a>
                @else
                    <a href="{{ route('pinjam.create', $item->id) }}" class="bg-custom-orange text-black text-xl px-12 py-3 rounded-full shadow hover:opacity-90 transition block text-center">
    Pinjam
</a>
                @endif
            </div>
        </div>
    </div>
@endsection