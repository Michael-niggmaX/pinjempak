@extends('layouts.main')

@section('content')
    <div class="sticky top-[60px] md:top-[72px] z-30 bg-gray-50/95 backdrop-blur-sm pt-2 pb-4 -mx-4 px-4 md:-mx-8 md:px-8 border-b border-gray-200/50 mb-6">
        
        <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center">
            
            <div class="relative w-full md:w-1/3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." 
                    class="w-full bg-white border border-gray-300 text-sm rounded-xl focus:ring-2 focus:ring-custom-orange focus:border-custom-orange block pl-10 p-2.5 shadow-sm transition-all">
            </div>

            <div class="w-full md:w-1/4">
                <select name="kategori" onchange="this.form.submit()" class="w-full bg-white border border-gray-300 text-sm rounded-xl focus:ring-2 focus:ring-custom-orange focus:border-custom-orange block p-2.5 shadow-sm cursor-pointer transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/4">
                <select name="status" onchange="this.form.submit()" class="w-full bg-white border border-gray-300 text-sm rounded-xl focus:ring-2 focus:ring-custom-orange focus:border-custom-orange block p-2.5 shadow-sm cursor-pointer transition-all">
                    <option value="">Semua Status</option>
                    <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                </select>
            </div>

            <div class="w-full md:w-auto flex gap-2 justify-end">
                <button type="submit" class="w-full md:w-auto bg-custom-orange text-white px-6 py-2.5 rounded-xl font-medium hover:bg-orange-500 transition-colors shadow-sm text-sm">
                    Cari
                </button>
                
                @if(request()->anyFilled(['search', 'status', 'kategori']))
                    <a href="{{ route('home') }}" class="bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl hover:bg-gray-200 transition-colors text-sm flex items-center justify-center" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6 shadow-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        @forelse ($items as $item)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group flex flex-col">
            
            <a href="{{ route('show', $item->id) }}" class="relative block h-48 overflow-hidden bg-gray-100">
                @if($item->gambar_barang)
                    <img src="{{ asset('images/' . $item->gambar_barang) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold shadow-sm {{ $item->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $item->stok > 0 ? 'Tersedia' : 'Habis' }}
                </div>
            </a>
            
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex justify-between items-start mb-2">
                    <a href="{{ route('show', $item->id) }}" class="text-lg font-semibold text-gray-800 hover:text-custom-orange transition-colors line-clamp-1">
                        {{ $item->nama_barang }}
                    </a>
                    
                    @auth
                        @if(Auth::user()->role === 'petugas')
                        <form action="{{ route('destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama_barang }}?');" class="shrink-0 ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
                
                <p class="text-sm text-gray-500 mb-4">{{ $item->kategori ?? 'Umum' }}</p>
                
                <div class="mt-auto flex items-center gap-3 border-t border-gray-100 pt-4">
                    <div class="flex items-center gap-1.5 bg-green-50 px-2.5 py-1 rounded-md border border-green-100">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-xs font-medium text-green-700">Tersedia: {{ $item->stok }}</span>
                    </div>
                    
                    @if($item->stok_rusak > 0)
                    <div class="flex items-center gap-1.5 bg-red-50 px-2.5 py-1 rounded-md border border-red-100">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        <span class="text-xs font-medium text-red-700">Rusak: {{ $item->stok_rusak }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-400">
            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-lg">Barang tidak ditemukan.</p>
        </div>
        @endforelse

    </div>
@endsection