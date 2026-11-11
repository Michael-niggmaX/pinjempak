@extends('layouts.main')

@section('content')
    <div class="mt-6">
        <h1 class="text-3xl font-medium mb-6">
            {{ Auth::user()->role === 'petugas' ? 'Pengajuan Peminjaman' : 'Riwayat Peminjaman Saya' }}
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ $errors->first() }}
            </div>
        @endif

                <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:shadow-md transition-shadow">
                
                <div class="w-full md:w-1/3">
                    @if(Auth::user()->role === 'petugas')
                        <p class="text-xl font-medium">{{ $loan->nama_peminjam }}</p>
                        <p class="text-sm text-gray-600">{{ $loan->inventory->nama_barang }} ({{ $loan->jumlah }} item)</p>
                    @else
                        <p class="text-xl font-medium">{{ $loan->inventory->nama_barang }}</p>
                        <p class="text-sm text-gray-600">Jumlah: {{ $loan->jumlah }} item</p>
                    @endif

                    @if(Auth::user()->role !== 'petugas')
                        <p class="text-sm mt-1">
                            Status: 
                            @if($loan->status === 'pending')
                                <span class="text-yellow-600 font-bold">Menunggu Konfirmasi</span>
                            @elseif($loan->status === 'disetujui')
                                <span class="text-green-600 font-bold">Disetujui</span>
                            @elseif($loan->status === 'ditolak')
                                <span class="text-red-600 font-bold">Ditolak</span>
                            @else
                                <span class="text-blue-600 font-bold capitalize">{{ $loan->status }}</span>
                            @endif
                        </p>
                    @endif
                </div>

                <div class="w-full md:w-1/3 md:text-center">
                    <p class="text-sm text-gray-500">Diajukan pada:</p>
                    <p class="text-lg">{{ $loan->created_at->format('d M Y') }}</p>
                </div>

                <div class="w-full md:w-1/3 text-left md:text-right">
                    @if(Auth::user()->role === 'petugas')
                        @if($loan->status === 'pending')
                            <a href="{{ route('pending.show', $loan->id) }}" class="bg-custom-orange text-black text-lg px-8 py-2 rounded-full hover:opacity-90 inline-block">
                                Cek
                            </a>
                        @else
                            <span class="bg-green-100 text-green-700 font-bold px-4 py-2 rounded-full text-sm inline-block">
                                Sedang Dipinjam
                            </span>
                        @endif
                    @else
                        <a href="{{ route('pending.show', $loan->id) }}" class="bg-gray-300 text-black text-lg px-8 py-2 rounded-full hover:bg-gray-400 inline-block">
                            Detail
                        </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500 text-xl mt-10">
                {{ Auth::user()->role === 'petugas' ? 'Tidak ada pengajuan peminjaman yang masuk.' : 'Anda belum pernah mengajukan peminjaman.' }}
            </div>
            @endforelse
        </div>
    </div>
@endsection