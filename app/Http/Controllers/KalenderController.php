<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    // Menampilkan daftar peminjaman (Gambar bbb)
    public function index()
    {
        $semua_peminjaman = Kalender::all();
        return view('admin.kalender.index', compact('semua_peminjaman'));
    }

    // Menyimpan peminjaman baru (Fungsi Modal TP1)
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'prodi'         => 'required|string|max:100',
            'item_pinjam'   => 'required|string|max:255',
            'waktu_pinjam'  => 'required|string',
        ]);

        Kalender::create([
            'nama_peminjam' => $request->nama_peminjam,
            'prodi'         => $request->prodi,
            'item_pinjam'   => $request->item_pinjam,
            'waktu_pinjam'  => $request->waktu_pinjam,
        ]);

        return redirect()->route('kalender.index')->with('success', 'Data peminjaman berhasil ditambah!');
    }

    // Update data peminjaman (Fungsi Modal EP1)
    public function update(Request $request, $id)
    {
        $kalender = Kalender::findOrFail($id);

        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'prodi'         => 'required|string|max:100',
            'item_pinjam'   => 'required|string|max:255',
            'waktu_pinjam'  => 'required|string',
        ]);

        $kalender->update([
            'nama_peminjam' => $request->nama_peminjam,
            'prodi'         => $request->prodi,
            'item_pinjam'   => $request->item_pinjam,
            'waktu_pinjam'  => $request->waktu_pinjam,
        ]);

        return redirect()->route('kalender.index')->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    // Menghapus data peminjaman
    public function destroy($id)
    {
        Kalender::findOrFail($id)->delete();
        return redirect()->route('kalender.index')->with('success', 'Data peminjaman berhasil dihapus!');
    }

    // Untuk list publik
public function kalenderPublik() {
    $semua_peminjaman = Kalender::all();
    return view('frontend.kalender', compact('semua_peminjaman'));
}

}