@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center py-6">
        <div class="bg-white rounded-3xl p-10 w-full max-w-3xl shadow-xl border border-gray-600">
            <h2 class="text-4xl text-center mb-8 font-normal">Edit Barang</h2>
            
            <form action="{{ route('update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-xl mb-2">Ganti foto:</label>
                    <div class="relative w-40 h-24">
                        <div id="preview-container" class="bg-gray-100 w-full h-full rounded-2xl flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 hover:border-custom-orange transition-colors">
                            @if($item->gambar_barang)
                                <img id="preview-image" src="{{ asset('images/' . $item->gambar_barang) }}" alt="Preview" class="w-full h-full object-cover">
                                <span id="preview-text" class="text-gray-500 text-sm hidden">#foto barang</span>
                            @else
                                <span id="preview-text" class="text-gray-500 text-sm">#foto barang</span>
                                <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <input type="file" name="gambar_barang" id="gambar_barang" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                    </div>
                    @error('gambar_barang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Nama barang:</label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" 
                        class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm" required>
                </div>

                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xl mb-2">Kategori:</label>
                        <select name="kategori" class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm cursor-pointer bg-white" required>
                            <option value="Elektronik" {{ old('kategori', $item->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                            <option value="Alat" {{ old('kategori', $item->kategori) == 'Alat' ? 'selected' : '' }}>Alat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xl mb-2">Stok Tersedia:</label>
                        <input type="number" name="stok" value="{{ old('stok', $item->stok) }}" min="0"
                            class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-xl mb-2">Stok Rusak:</label>
                    <input type="number" name="stok_rusak" value="{{ old('stok_rusak', $item->stok_rusak ?? 0) }}" min="0"
                        class="w-1/2 rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Status:</label>
                                        <select name="status" class="w-1/2 rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm cursor-pointer bg-white" required>
                        <option value="Tersedia" {{ old('status', $item->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Dipinjam" {{ old('status', $item->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Rusak" {{ old('status', $item->status) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-xl mb-2">Deskripsi:</label>
                    <textarea name="deskripsi" rows="3" class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-custom-orange focus:border-transparent outline-none transition-all shadow-sm">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                </div>

                <div class="flex justify-center gap-6">
                    <a href="{{ route('show', $item->id) }}" class="bg-white text-black text-xl px-10 py-3 rounded-full shadow hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="bg-custom-orange text-black text-xl px-10 py-3 rounded-full shadow hover:opacity-90">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
            
            reader.onload = function(){
                const dataURL = reader.result;
                const imageElement = document.getElementById('preview-image');
                const textElement = document.getElementById('preview-text');
                
                imageElement.src = dataURL;
                imageElement.classList.remove('hidden');
                if(textElement) textElement.classList.add('hidden');
            };
            
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection