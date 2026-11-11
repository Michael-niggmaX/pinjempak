<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function cekAdmin()
    {
        if (auth()->user()->role !== 'petugas') {
            abort(403, 'Hanya Petugas yang bisa mengakses halaman ini.');
        }
    }

    public function index()
    {
        $this->cekAdmin();
        $users = User::where('role', '!=', 'petugas')->latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->cekAdmin();
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->cekAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:siswa,guru',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $this->cekAdmin();
        $user = User::findOrFail($id);
        
        if ($user->role === 'petugas') {
            return back()->withErrors(['msg' => 'Tidak bisa menghapus sesama Petugas.']);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}