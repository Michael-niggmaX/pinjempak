@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center py-6">
        <div class="bg-white rounded-3xl p-10 w-full max-w-3xl shadow-xl border border-gray-600">
            <h2 class="text-4xl text-center mb-8 font-normal">Kembalikan Barang</h2>
            
            <form action="{{ route('proses-kembalikan', $loan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-xl mb-2">Nama Barang:</label>
                    <input type="text" value="{{ $loan->inventory->nama_barang }}" readonly
                        class="w-full rounded-2xl border-none p-4 text-lg bg-gray-200 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Jumlah Dikembalikan:</label>
                    <input type="text" value="{{ $loan->jumlah }} Unit" readonly
                        class="w-full rounded-2xl border-none p-4 text-lg bg-gray-200 outline-none">
                </div>

                <div class="mb-8">
                    <label class="block text-xl mb-2">Upload Bukti Foto:</label>
                    <p class="text-sm text-gray-500 mb-2">Pastikan barang dalam kondisi baik sebelum difoto.</p>
                    
                    <div class="relative w-48 h-32">
                        <div id="preview-container" class="bg-gray-100 w-full h-full rounded-2xl flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 hover:border-custom-orange transition-colors">
                            <span id="preview-text" class="text-gray-500 text-sm">#foto bukti</span>
                            <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        </div>
                        <input type="file" name="foto_bukti" id="foto_bukti" accept="image/*" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                    </div>
                    
                    @error('foto_bukti')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center gap-6">
                    <a href="{{ route('kembalikan') }}" class="bg-white text-black text-xl px-10 py-3 rounded-full shadow hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="bg-custom-orange text-black text-xl px-10 py-3 rounded-full shadow hover:opacity-90">
                        Kembalikan
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
                const imageElement = document.getElementById('preview-image');
                const textElement = document.getElementById('preview-text');
                imageElement.src = reader.result;
                imageElement.classList.remove('hidden');
                textElement.classList.add('hidden');
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection