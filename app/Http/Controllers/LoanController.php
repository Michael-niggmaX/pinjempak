<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function create($id)
    {
        $item = Inventory::findOrFail($id);
        return view('pinjam', compact('item'));
    }

        public function store(Request $request, $id)
    {
        $rules = [
            'jumlah' => 'required|integer|min:1',
            'nama_peminjam' => 'required',
            'alasan' => 'required',
            'tanggal_kembali_request' => 'required|date|after_or_equal:today',
        ];

        if (Auth::user()->role === 'siswa') {
            $rules['kelas'] = 'required';
            $rules['jurusan'] = 'required';
        }

        $request->validate($rules);

        $item = Inventory::findOrFail($id);

        if ($request->jumlah > $item->stok) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok yang tersedia!']);
        }

        if (Auth::user()->role === 'siswa') {
            $kelas = $request->kelas;
            $jurusan = $request->jurusan;
        } else {
            $kelas = '-';
            $jurusan = 'Guru';
        }

        Loan::create([
            'user_id' => Auth::id(),
            'inventory_id' => $item->id,
            'jumlah' => $request->jumlah,
            'nama_peminjam' => $request->nama_peminjam,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'alasan' => $request->alasan,
            'tanggal_kembali_request' => $request->tanggal_kembali_request,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Peminjaman berhasil diajukan! Menunggu konfirmasi petugas.');
    }

    public function pending()
    {
        $user = Auth::user();

        if ($user->role === 'petugas') {
            $loans = Loan::whereIn('status', ['pending', 'disetujui', 'pending_kembali'])
                         ->with(['inventory', 'user'])->latest()->get();
        } else {
            $loans = Loan::where('user_id', $user->id)
                         ->whereIn('status', ['pending', 'disetujui', 'pending_kembali'])
                         ->with(['inventory', 'user'])->latest()->get();
        }

        return view('pending', compact('loans'));
    }

    public function show($id)
    {
        $loan = Loan::with('inventory')->findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'petugas' && $loan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('pending-show', compact('loan'));
    }

    public function konfirmasi(Request $request, $id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);

        $request->validate([
            'tanggal_kembali_disetujui' => 'required|date|after_or_equal:today',
            'catatan_admin' => 'nullable|string'
        ]);

        $loan = Loan::findOrFail($id);
        
        if ($loan->status !== 'pending') {
            return back()->withErrors(['msg' => 'Peminjaman ini sudah diproses.']);
        }

        $item = $loan->inventory;

        if ($loan->jumlah > $item->stok) {
            return back()->withErrors(['msg' => 'Stok tidak mencukupi untuk dikonfirmasi.']);
        }

        $item->stok -= $loan->jumlah;
        if ($item->stok == 0) {
            $item->status = 'Dipinjam';
        }
        $item->save();

        $loan->status = 'disetujui';
        $loan->tanggal_kembali_disetujui = $request->tanggal_kembali_disetujui;
        $loan->catatan_admin = $request->catatan_admin;
        $loan->save();

        return redirect()->route('pending')->with('success', 'Peminjaman berhasil dikonfirmasi.');
    }

    public function tolak($id)
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403);
        }

        $loan = Loan::findOrFail($id);
        $loan->status = 'ditolak';
        $loan->save();

        return redirect()->route('pending')->with('success', 'Peminjaman telah ditolak.');
    }

    public function indexKembalikan()
    {
        $loans = Loan::where('user_id', Auth::id())->where('status', 'disetujui')->with(['inventory'])->get();
        return view('kembalikan-list', compact('loans'));
    }

    public function formKembalikan($id)
    {
        $loan = Loan::with('inventory')->findOrFail($id);
        
        if ($loan->user_id !== Auth::id()) abort(403);

        return view('kembalikan-form', compact('loan'));
    }

    public function prosesKembalikan(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        if ($loan->user_id !== Auth::id() || $loan->status !== 'disetujui') abort(403);

        $request->validate([
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $nama_file = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $nama_file = time() . "_kembali_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        $loan->status = 'pending_kembali';
        $loan->foto_bukti = $nama_file; 
        $loan->save();

        return redirect()->route('kembalikan')->with('success', 'Bukti pengembalian dikirim. Menunggu konfirmasi Petugas.');
    }

    public function formRusak($id)
    {
        $loan = Loan::with('inventory')->findOrFail($id);
        if ($loan->user_id !== Auth::id()) abort(403);

        return view('lapor-rusak', compact('loan'));
    }

        public function prosesRusak(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        if ($loan->user_id !== Auth::id() || $loan->status !== 'disetujui') abort(403);

        $request->validate([
            'detail_kerusakan' => 'required',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $item = $loan->inventory;
        $item->stok += $loan->jumlah;
        $nama_file = null;
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        $loan->status = 'dikembalikan';
        $loan->tanggal_kembali = now();
        $loan->kondisi_kembali = 'Rusak';
        $loan->detail_kerusakan = $request->detail_kerusakan;
        $loan->foto_bukti = $nama_file;
        $loan->save();

        return redirect()->route('kembalikan')->with('success', 'Laporan kerusakan berhasil dikirim.');
    }

    public function laporan()
    {
        if (Auth::user()->role !== 'petugas') {
            abort(403, 'Hanya petugas yang bisa mengakses laporan.');
        }

        $loans = Loan::where('kondisi_kembali', 'Rusak')
                     ->with(['inventory', 'user'])
                     ->latest()
                     ->get();

        return view('laporan', compact('loans'));
    }

    public function laporanDetail($id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);
        
        $loan = Loan::with('inventory')->findOrFail($id);
        return view('laporan-detail', compact('loan'));
    }

    public function laporanKonfirmasi($id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);

        $loan = Loan::findOrFail($id);
        
        if ($loan->kondisi_kembali !== 'Rusak') {
            return back()->withErrors(['msg' => 'Laporan ini tidak valid.']);
        }

        $item = $loan->inventory;

        $item->stok -= $loan->jumlah;
        $item->stok_rusak += $loan->jumlah;

        if ($item->stok < 0) {
            $item->stok = 0;
        }

        $item->save();

        $loan->kondisi_kembali = 'Diterima';
        $loan->save();

        return redirect()->route('laporan')->with('success', 'Laporan dikonfirmasi. Stok telah dipindahkan ke Barang Rusak.');
    }

    public function riwayat(Request $request)
    {
        $user = Auth::user();
        
        $startDate = $request->input('start_date', \Carbon\Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', \Carbon\Carbon::now()->format('Y-m-d'));
        $tahun = $request->input('tahun');

        $query = Loan::whereIn('status', ['ditolak', 'dikembalikan']);

        if ($user->role !== 'petugas') {
            $query->where('user_id', $user->id);
        }

        if ($tahun) {
            $query->whereYear('updated_at', $tahun);
        } else {
            $query->whereDate('updated_at', '>=', $startDate)
                  ->whereDate('updated_at', '<=', $endDate);
        }

        $loans = $query->with(['inventory', 'user'])->latest()->get();

        $tahunTersedia = Loan::selectRaw('YEAR(updated_at) as tahun')
                             ->distinct()
                             ->orderBy('tahun', 'desc')
                             ->pluck('tahun');

        return view('riwayat', compact('loans', 'startDate', 'endDate', 'tahun', 'tahunTersedia'));
    }
    
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', \Carbon\Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', \Carbon\Carbon::now()->format('Y-m-d'));
        $tahun = $request->input('tahun');

        $query = Loan::whereIn('status', ['ditolak', 'dikembalikan'])->with(['inventory', 'user']);

        if ($tahun) {
            $query->whereYear('updated_at', $tahun);
        } else {
            $query->whereDate('updated_at', '>=', $startDate)->whereDate('updated_at', '<=', $endDate);
        }

        $loans = $query->latest()->get();

        $filename = 'riwayat_peminjaman_' . date('Y-m-d_H-i') . '.csv';
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Nama Barang', 'Jumlah', 'Nama Peminjam', 'Kelas', 'Jurusan', 'Status', 'Tanggal Selesai'];

        $callback = function() use($loans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $no = 1;
            foreach ($loans as $loan) {
                fputcsv($file, [
                    $no++,
                    $loan->inventory->nama_barang,
                    $loan->jumlah,
                    $loan->nama_peminjam,
                    $loan->kelas,
                    $loan->jurusan,
                    $loan->status,
                    $loan->updated_at->format('d-m-Y')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function konfirmasiKembali($id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);

        $loan = Loan::findOrFail($id);
        if ($loan->status !== 'pending_kembali') return back()->withErrors(['msg' => 'Status tidak valid.']);

        $item = $loan->inventory;
        $item->stok += $loan->jumlah;
        if ($item->stok > 0 && $item->status === 'Dipinjam') {
            $item->status = 'Tersedia';
        }
        $item->save();

        if ($loan->foto_bukti && file_exists(public_path('images/' . $loan->foto_bukti))) {
            unlink(public_path('images/' . $loan->foto_bukti));
        }

        // 3. Update Status
        $loan->status = 'dikembalikan';
        $loan->tanggal_kembali = now();
        $loan->kondisi_kembali = 'Baik';
        $loan->foto_bukti = null;
        $loan->save();

        return redirect()->route('pending')->with('success', 'Pengembalian dikonfirmasi. Stok bertambah dan foto dihapus.');
    }

    public function tolakKembali($id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);

        $loan = Loan::findOrFail($id);
        if ($loan->status !== 'pending_kembali') return back()->withErrors(['msg' => 'Status tidak valid.']);

        if ($loan->foto_bukti && file_exists(public_path('images/' . $loan->foto_bukti))) {
            unlink(public_path('images/' . $loan->foto_bukti));
        }

        $loan->status = 'disetujui';
        $loan->foto_bukti = null;
        $loan->save();

        return redirect()->route('pending')->with('success', 'Pengembalian ditolak. Siswa harus mengunggah bukti baru.');
    }

    public function showKembali($id)
    {
        if (Auth::user()->role !== 'petugas') abort(403);
        $loan = Loan::with('inventory')->findOrFail($id);
        return view('pending-kembali', compact('loan'));
    }
}