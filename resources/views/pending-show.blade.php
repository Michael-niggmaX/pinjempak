@extends('layouts.main')

@section('content')
    <div class="flex justify-center mt-2 md:mt-6 mb-10 md:mb-20"> 
        <div class="bg-white rounded-2xl w-full max-w-4xl p-6 md:p-8 shadow-sm border border-gray-100 flex flex-col min-h-[600px]">
            
            <div> 
                <h2 class="text-2xl md:text-3xl font-semibold mb-6 border-b pb-4 text-gray-800">Detail Peminjaman</h2>
                
                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded relative mb-6">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="flex flex-col md:flex-row gap-6 md:gap-8">
                    <div class="w-full md:w-1/3">
                        <p class="text-lg mb-2 font-medium text-gray-800">Item: {{ $loan->inventory->nama_barang }}</p>
                        <div class="bg-gray-100 w-full h-48 rounded-xl overflow-hidden flex items-center justify-center border border-gray-200">
                            @if($loan->inventory->gambar_barang)
                                <img src="{{ asset('images/' . $loan->inventory->gambar_barang) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Jumlah Pinjam</p>
                                <p class="text-lg font-medium">{{ $loan->jumlah }} Unit</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Nama Peminjam</p>
                                <p class="text-lg font-medium">{{ $loan->nama_peminjam }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Kelas</p>
                                <p class="text-lg">{{ $loan->kelas }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-xs md:text-sm">Jurusan</p>
                                <p class="text-lg">{{ $loan->jurusan === 'Guru' ? '-' : $loan->jurusan }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-500 text-xs md:text-sm">Rencana Tanggal Kembali</p>
                            <p class="text-lg font-medium text-custom-orange">{{ \Carbon\Carbon::parse($loan->tanggal_kembali_request)->format('d M Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm">Alasan Peminjaman</p>
                            <p class="text-base bg-gray-50 p-3 rounded-lg border border-gray-100 mt-1">{{ $loan->alasan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-auto pt-8 flex flex-col md:flex-row justify-end w-full">
                @if($loan->status === 'pending')
                    @if(Auth::user()->role === 'petugas')
                        
                        <div class="w-full md:w-2/3 bg-gray-50 p-4 rounded-xl border border-gray-200 flex flex-col gap-4">
                            
                            <div class="flex flex-col md:flex-row gap-3">
                                <div class="flex flex-col flex-1">
                                    <label class="text-xs font-semibold text-gray-600 mb-1">Tgl Disetujui:</label>
                                    <input type="date" name="tanggal_kembali_disetujui" form="form-konfirmasi"
                                        value="{{ $loan->tanggal_kembali_request }}" 
                                        min="{{ date('Y-m-d') }}" required
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-custom-orange bg-white">
                                </div>
                                <div class="flex flex-col flex-1">
                                    <label class="text-xs font-semibold text-gray-600 mb-1">Catatan (Opsional):</label>
                                    <input type="text" name="catatan_admin" form="form-konfirmasi" placeholder="Misal: Maksimal 2 hari" 
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-custom-orange bg-white">
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row justify-end gap-3 pt-2">
                                <form action="{{ route('pending.tolak', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin menolak peminjaman ini?');" class="w-full md:w-auto m-0">
                                    @csrf
                                    <button type="submit" class="w-full bg-white text-gray-700 text-base font-medium px-6 py-2.5 rounded-xl hover:bg-gray-100 transition-colors border border-gray-300">
                                        Tolak
                                    </button>
                                </form>

                                <form id="form-konfirmasi" action="{{ route('pending.konfirmasi', $loan->id) }}" method="POST" class="w-full md:w-auto m-0">
                                    @csrf
                                    <button type="submit" class="w-full bg-custom-orange text-white text-base font-medium px-8 py-2.5 rounded-xl hover:bg-orange-500 transition-colors shadow-sm">
                                        Konfirmasi
                                    </button>
                                </form>
                            </div>

                        </div>

                    @else
                        <a href="{{ route('pending') }}" class="w-full md:w-auto bg-gray-100 text-center text-gray-700 text-base font-medium px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors border border-gray-200">
                            Kembali
                        </a>
                    @endif
                @else
                    <a href="{{ route('pending') }}" class="w-full md:w-auto bg-gray-100 text-center text-gray-700 text-base font-medium px-8 py-3 rounded-xl hover:bg-gray-200 transition-colors border border-gray-200">
                        Kembali
                    </a>
                @endif
            </div>

        </div>
    </div>
@endsection