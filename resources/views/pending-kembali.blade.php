@extends('layouts.main')

@section('content')
    <div class="flex justify-center mt-6 mb-20"> 
        <div class="bg-white rounded-2xl w-full max-w-3xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-4">Konfirmasi Pengembalian Barang</h2>
            
            @if($errors->any())
                <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-4">{{ $errors->first() }}</div>
            @endif

            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/2">
                    <p class="text-gray-500 text-sm mb-2">Bukti Foto Pengembalian:</p>
                    <div class="bg-gray-100 rounded-xl overflow-hidden border border-gray-200">
                        @if($loan->foto_bukti)
                            <img src="{{ asset('images/' . $loan->foto_bukti) }}" class="w-full h-64 object-contain">
                        @else
                            <div class="h-64 flex items-center justify-center text-gray-400">Tidak ada foto</div>
                        @endif
                    </div>
                </div>

                <div class="w-full md:w-1/2 space-y-3">
                    <div>
                        <p class="text-gray-500 text-sm">Nama Barang</p>
                        <p class="text-lg font-medium">{{ $loan->inventory->nama_barang }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Jumlah Dikembalikan</p>
                        <p class="text-lg font-medium">{{ $loan->jumlah }} Unit</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Nama Peminjam</p>
                        <p class="text-lg font-medium">{{ $loan->nama_peminjam }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end gap-3">
                <form action="{{ route('pending.tolak-kembali', $loan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-xl hover:bg-gray-200">Tolak</button>
                </form>
                <form action="{{ route('pending.konfirmasi-kembali', $loan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-custom-orange text-white px-6 py-2.5 rounded-xl hover:bg-orange-500">Konfirmasi Kembali</button>
                </form>
            </div>
        </div>
    </div>
@endsection