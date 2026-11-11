@extends('layouts.main')

@section('content')
    <div class="mt-6">
        <h1 class="text-3xl font-medium mb-6">Riwayat Peminjaman</h1>

        <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:shadow-md transition-shadow">
                
                <div class="w-full md:w-1/3">
                    <p class="text-xl font-medium">{{ $loan->inventory->nama_barang }}</p>
                    <p class="text-sm text-gray-600">Jumlah: {{ $loan->jumlah }} item</p>
                    @if(Auth::user()->role === 'petugas')
                        <p class="text-sm text-gray-500 mt-1">Oleh: {{ $loan->nama_peminjam }}</p>
                    @endif
                </div>

                <div class="w-full md:w-1/3 md:text-center">
                    <p class="text-sm text-gray-500">Tanggal Selesai:</p>
                    <p class="text-lg">{{ $loan->updated_at->format('d M Y') }}</p>
                </div>

                <div class="w-full md:w-1/3 text-left md:text-right">
                    @if($loan->status === 'dikembalikan')
                        <span class="bg-green-100 text-green-700 font-bold px-4 py-1.5 rounded-full text-sm">
                            Dikembalikan
                        </span>
                    @elseif($loan->status === 'ditolak')
                        <span class="bg-red-100 text-red-700 font-bold px-4 py-1.5 rounded-full text-sm">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 text-xl mt-10">
                Belum ada riwayat peminjaman.
            </div>
            @endforelse
        </div>
    </div>
@endsection