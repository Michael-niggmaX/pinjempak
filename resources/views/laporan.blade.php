@extends('layouts.main')

@section('content')
    <div class="mt-6">
        <h1 class="text-3xl font-medium mb-6">Laporan Kerusakan</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-gray-100 rounded-xl p-4 flex items-center justify-between">
                <div class="w-1/3">
                    <p class="text-xl font-medium">{{ $loan->inventory->nama_barang }}</p>
                    <p class="text-sm text-red-500">Rusak: {{ $loan->jumlah }} item</p>
                </div>
                <div class="w-1/3 text-center">
                    <p class="text-lg">{{ $loan->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $loan->created_at->format('d M Y') }}</p>
                </div>
                <div class="w-1/3 text-right">
                    <a href="{{ route('laporan.detail', $loan->id) }}" class="bg-custom-orange text-black text-lg px-8 py-2 rounded-full hover:opacity-90">
                        Cek
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 text-xl mt-10">
                Tidak ada laporan kerusakan.
            </div>
            @endforelse
        </div>
    </div>
@endsection