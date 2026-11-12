@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center py-6">
        <div class="bg-white rounded-3xl p-10 w-full max-w-3xl shadow-xl border border-gray-100">
            <h2 class="text-4xl text-center mb-8 font-normal">Laporkan Kerusakan</h2>
            
            <form action="{{ route('proses-rusak', $loan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-xl mb-2">Nama Barang:</label>
                    <input type="text" value="{{ $loan->inventory->nama_barang }}" readonly
                        class="w-1/2 rounded-2xl border-none p-4 text-lg bg-gray-200 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Jumlah:</label>
                    <input type="text" value="{{ $loan->jumlah }}" readonly
                        class="w-1/2 rounded-2xl border-none p-4 text-lg bg-gray-200 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-xl mb-2">Detail Kerusakan:</label>
                    <textarea name="detail_kerusakan" rows="3" required 
    class="w-full rounded-xl border border-gray-300 p-4 text-lg focus:ring-2 focus:ring-red-500 focus:border-transparent outline-none transition-all shadow-sm bg-white" 
    placeholder="Jelaskan bagian mana yang rusak..."></textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-xl mb-2">Upload Bukti:</label>
                    <div class="relative w-40 h-24">
                        <div id="preview-container" class="bg-gray-100 w-full h-full rounded-2xl flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 hover:border-custom-orange transition-colors">
                            <span id="preview-text" class="text-gray-500 text-sm">#foto bukti</span>
                            <img id="preview-image" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        </div>
                        <input type="file" name="foto_bukti" accept="image/*" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                    </div>
                </div>

                <div class="flex justify-center gap-6">
                    <a href="{{ route('kembalikan') }}" class="bg-white text-black text-xl px-10 py-3 rounded-full shadow hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="bg-red-500 text-white text-xl px-10 py-3 rounded-full shadow hover:bg-red-600">
                        Lapor Rusak
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