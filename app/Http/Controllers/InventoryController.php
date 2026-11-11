<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
{
    $query = Inventory::query();

    if ($request->filled('search')) {
        $query->where('nama_barang', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $items = $query->get();

    $kategoris = Inventory::whereNotNull('kategori')
                    ->where('kategori', '!=', '')
                    ->pluck('kategori')
                    ->map(function ($item) {
                        return ucwords(trim($item)); 
                    })
                    ->unique()
                    ->sort() 
                    ->values();

    return view('home', compact('items', 'kategoris'));
}

public function create()
{
    if (!in_array(auth()->user()->role, ['petugas'])) {
        abort(403, 'Anda tidak memiliki akses.');
    }
    return view('create');
}

public function store(Request $request)
{
    if (!in_array(auth()->user()->role, ['petugas'])) {
        abort(403, 'Anda tidak memiliki akses.');
    }
        $request->validate([
            'nama_barang' => 'required',
            'status'      => 'required',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
            $data['gambar_barang'] = $nama_file;
    }

    Inventory::create($data);

    return redirect()->route('home')->with('success', 'Barang berhasil ditambahkan!');
}
public function destroy($id)
{
    if (auth()->user()->role !== 'petugas') {
        abort(403, 'Anda tidak memiliki akses.');
    }

    $item = Inventory::findOrFail($id);
    
    if ($item->gambar_barang && file_exists(public_path('images/' . $item->gambar_barang))) {
        unlink(public_path('images/' . $item->gambar_barang));
    }

    $item->delete();

    return redirect()->route('home')->with('success', 'Barang berhasil dihapus!');
}
    public function show($id)
    {
        $item = Inventory::findOrFail($id);
        return view('show', compact('item'));
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'petugas') {
            abort(403, 'Hanya petugas yang bisa mengedit.');
        }
        $item = Inventory::findOrFail($id);
        return view('edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'petugas') {
            abort(403, 'Hanya petugas yang bisa mengedit.');
        }

        $request->validate([
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'stok'        => 'required|integer|min:0',
            'status'      => 'required',
            'deskripsi'   => 'nullable',
            'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $item = Inventory::findOrFail($id);
        
        $data = $request->except('gambar_barang');

        if ($request->hasFile('gambar_barang')) {
            if ($item->gambar_barang && file_exists(public_path('images/' . $item->gambar_barang))) {
                unlink(public_path('images/' . $item->gambar_barang));
            }
            
            $file = $request->file('gambar_barang');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
            
            $data['gambar_barang'] = $nama_file;
        }

        $item->update($data);

        return redirect()->route('show', $item->id)->with('success', 'Barang berhasil diupdate!');
    }
}