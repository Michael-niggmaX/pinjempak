@extends('layouts.main')

@section('content')
    <div class="mt-6">
        <h1 class="text-3xl font-medium mb-6">Daftar Peminjaman Aktif</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-gray-100 rounded-xl p-4 flex items-center justify-between">
                <div class="w-1/2">
                    <p class="text-xl font-medium">{{ $loan->inventory->nama_barang }}</p>
                    <p class="text-sm text-gray-500">Jumlah: {{ $loan->jumlah }} | Dipinjam pada: {{ $loan->created_at->format('d M Y') }}</p>
                </div>
                <div class="w-1/2">
                    <p class="text-sm text-gray-700 mt-1">
                    Batas Kembali: <span class="font-medium">{{ $loan->tanggal_kembali_disetujui ? \Carbon\Carbon::parse($loan->tanggal_kembali_disetujui)->format('d M Y') : '-' }}</span>
                    </p>
                    @if($loan->catatan_admin)
                        <p class="text-sm text-red-500 italic">Catatan Admin: {{ $loan->catatan_admin }}</p>
                    @endif
                </div>
                <div class="w-1/2 text-right flex gap-2 justify-end">
                    <a href="{{ route('lapor-rusak', $loan->id) }}" class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 text-sm">
                        Lapor Rusak
                    </a>
                    <a href="{{ route('form-kembalikan', $loan->id) }}" class="bg-custom-orange text-black px-6 py-2 rounded-full hover:opacity-90 text-sm flex items-center justify-center">
                        Kembalikan (Baik)
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 text-xl mt-10">
                Anda tidak memiliki barang yang sedang dipinjam.
            </div>
            @endforelse
        </div>
    </div>
@endsection