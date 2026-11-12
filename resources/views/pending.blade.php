@extends('layouts.main')

@section('content')
    <div class="mt-2 md:mt-6">
        <!-- Header Halaman -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-2">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-800">
                {{ Auth::user()->role === 'petugas' ? 'Daftar Pending & Dipinjam' : 'Riwayat Peminjaman Saya' }}
            </h1>
        </div>

        <!-- List Item -->
        <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:shadow-md transition-shadow">
                
                <!-- Info Peminjam & Barang -->
                <div class="w-full md:w-1/3">
                    @if(Auth::user()->role === 'petugas')
                        <p class="text-lg font-semibold text-gray-800">{{ $loan->nama_peminjam }}</p>
                        <p class="text-sm text-gray-500">{{ $loan->inventory->nama_barang }} ({{ $loan->jumlah }} item)</p>
                    @else
                        <p class="text-lg font-semibold text-gray-800">{{ $loan->inventory->nama_barang }}</p>
                        <p class="text-sm text-gray-500">Jumlah: {{ $loan->jumlah }} item</p>
                    @endif

                    <!-- Status Badge -->
                    <div class="mt-2 text-sm">
                        <span class="text-gray-500">Status:</span> 
                        @if($loan->status === 'pending')
                            <span class="text-yellow-600 font-bold bg-yellow-50 px-2 py-0.5 rounded">Menunggu Persetujuan</span>
                        @elseif($loan->status === 'disetujui')
                            <span class="text-green-600 font-bold bg-green-50 px-2 py-0.5 rounded">Sedang Dipinjam</span>
                        @elseif($loan->status === 'pending_kembali')
                            <span class="text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded">Cek Pengembalian</span>
                        @elseif($loan->status === 'ditolak')
                            <span class="text-red-600 font-bold bg-red-50 px-2 py-0.5 rounded">Ditolak</span>
                        @else
                            <span class="text-gray-600 font-bold bg-gray-100 px-2 py-0.5 rounded capitalize">{{ $loan->status }}</span>
                        @endif
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="w-full md:w-1/3 md:text-center flex md:block justify-between md:justify-center items-center border-t border-gray-50 md:border-none pt-3 md:pt-0">
                    <p class="text-sm text-gray-500 md:hidden">Diajukan:</p>
                    <p class="text-sm md:text-base text-gray-800 md:text-gray-500">{{ $loan->created_at->format('d M Y') }}</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="w-full md:w-1/3 text-left md:text-right border-t border-gray-50 md:border-none pt-3 md:pt-0">
                    @if(Auth::user()->role === 'petugas')
                        @if($loan->status === 'pending')
                            <a href="{{ route('pending.show', $loan->id) }}" class="bg-custom-orange text-white text-sm font-medium px-6 py-2.5 rounded-full hover:bg-orange-500 transition-colors inline-block w-full md:w-auto text-center shadow-sm">
                                Cek Pengajuan
                            </a>
                        @elseif($loan->status === 'pending_kembali')
                            <a href="{{ route('pending.show-kembali', $loan->id) }}" class="bg-blue-500 text-white text-sm font-medium px-6 py-2.5 rounded-full hover:bg-blue-600 transition-colors inline-block w-full md:w-auto text-center shadow-sm">
                                Cek Pengembalian
                            </a>
                        @else
                            <!-- Jika sudah disetujui (sedang dipinjam) -->
                            <span class="bg-green-100 text-green-700 font-bold px-4 py-2 rounded-full text-sm inline-block w-full md:w-auto text-center">
                                Sedang Dipinjam
                            </span>
                        @endif
                    @else
                        <!-- Tombol untuk Siswa/Guru -->
                        <a href="{{ route('pending.show', $loan->id) }}" class="bg-gray-100 text-gray-700 text-sm font-medium px-6 py-2.5 rounded-full hover:bg-gray-200 transition-colors inline-block w-full md:w-auto text-center">
                            Lihat Detail
                        </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl p-8 text-center text-gray-500 shadow-sm border border-gray-100">
                {{ Auth::user()->role === 'petugas' ? 'Tidak ada pengajuan peminjaman atau pengembalian saat ini.' : 'Anda belum pernah mengajukan peminjaman.' }}
            </div>
            @endforelse
        </div>
    </div>
@endsection