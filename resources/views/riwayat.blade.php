@extends('layouts.main')

@section('content')
    <div class="mt-2 md:mt-6">
        
        <!-- Header & Tombol Export -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-semibold text-gray-800">Riwayat Peminjaman</h1>
                <p class="text-sm text-gray-500 mt-1">Filter berdasarkan rentang tanggal atau tahun.</p>
            </div>
            
            @if(Auth::user()->role === 'petugas')
            <a href="{{ route('riwayat.export', request()->query()) }}" class="bg-green-600 text-white px-5 py-2.5 rounded-xl font-medium hover:bg-green-700 transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download Excel
            </a>
            @endif
        </div>

        <!-- FILTER FORM -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
            <form action="{{ route('riwayat') }}" method="GET" class="flex flex-col lg:flex-row gap-4 items-end">
                
                <!-- Filter Tanggal -->
                <div class="flex flex-col w-full lg:w-auto">
                    <label class="text-xs font-semibold text-gray-600 mb-1">Dari Tanggal:</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" 
                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-custom-orange focus:border-custom-orange block w-full p-2.5">
                </div>
                <div class="flex flex-col w-full lg:w-auto">
                    <label class="text-xs font-semibold text-gray-600 mb-1">Sampai Tanggal:</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" 
                        class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-custom-orange focus:border-custom-orange block w-full p-2.5">
                </div>

                <span class="text-gray-400 font-medium pb-2.5 hidden lg:block">ATAU</span>

                <!-- Filter Tahun -->
                <div class="flex flex-col w-full lg:w-auto">
                    <label class="text-xs font-semibold text-gray-600 mb-1">Pilih Tahun:</label>
                    <select name="tahun" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-custom-orange focus:border-custom-orange block w-full p-2.5">
                        <option value="">-- Semua Tahun --</option>
                        @foreach($tahunTersedia as $thn)
                            <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-2 w-full lg:w-auto">
                    <button type="submit" class="w-full lg:w-auto bg-custom-orange text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-orange-500 transition-colors">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('riwayat') }}" class="w-full lg:w-auto bg-gray-100 text-gray-600 px-4 py-2.5 rounded-lg text-sm hover:bg-gray-200 transition-colors text-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- LIST DATA -->
        <div class="flex flex-col gap-4">
            @forelse($loans as $loan)
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:shadow-md transition-shadow">
                
                <div class="w-full md:w-1/3">
                    <p class="text-lg font-semibold text-gray-800">{{ $loan->inventory->nama_barang }}</p>
                    <p class="text-sm text-gray-500">Jumlah: {{ $loan->jumlah }} item</p>
                    @if(Auth::user()->role === 'petugas')
                        <p class="text-sm text-gray-500 mt-1">Oleh: {{ $loan->nama_peminjam }}</p>
                    @endif
                </div>

                <div class="w-full md:w-1/3 md:text-center flex md:block justify-between items-center border-t border-gray-50 md:border-none pt-3 md:pt-0">
                    <p class="text-sm text-gray-500 md:hidden">Tanggal Selesai:</p>
                    <p class="text-sm md:text-base text-gray-800 md:text-gray-500">{{ $loan->updated_at->format('d M Y') }}</p>
                </div>

                <div class="w-full md:w-1/3 text-left md:text-right border-t border-gray-50 md:border-none pt-3 md:pt-0">
                    @if($loan->status === 'dikembalikan')
                        <span class="bg-green-100 text-green-700 font-bold px-4 py-1.5 rounded-full text-sm inline-block">
                            Dikembalikan
                        </span>
                    @elseif($loan->status === 'ditolak')
                        <span class="bg-red-100 text-red-700 font-bold px-4 py-1.5 rounded-full text-sm inline-block">
                            Ditolak
                        </span>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl p-8 text-center text-gray-500 shadow-sm border border-gray-100">
                Tidak ada riwayat peminjaman pada periode/tahun yang dipilih.
            </div>
            @endforelse
        </div>
    </div>
@endsection