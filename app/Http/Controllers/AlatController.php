<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    // Menampilkan daftar alat (Gambar aaa)
    public function index()
    {
        $semua_alat = Alat::all();
        return view('admin.alat.index', compact('semua_alat'));
    }

    // Menyimpan alat baru (Fungsi Modal TKA1)
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable'
        ]);

        // Upload gambar ke storage/app/public/alat
        $path = $request->file('gambar')->store('alat', 'public');

        Alat::create([
            'nama_barang' => $request->nama_barang,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambah!');
    }

    // Menampilkan detail alat (Gambar dka1)
    public function show($id)
    {
        $alat = Alat::findOrFail($id);
        return view('admin.alat.show', compact('alat'));
    }

    // Update data alat (Fungsi Modal EKA1)
    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($alat->gambar);
            // Simpan gambar baru
            $path = $request->file('gambar')->store('alat', 'public');
            $alat->gambar = $path;
        }

        $alat->nama_barang = $request->nama_barang;
        $alat->deskripsi = $request->deskripsi;
        $alat->save();

        return redirect()->route('alat.index')->with('success', 'Data alat diperbarui!');
    }

    // Menghapus data alat
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        Storage::disk('public')->delete($alat->gambar);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }

        // Untuk list publik
public function alatPublik() {
    $semua_alat = Alat::all();
    return view('frontend.alat', compact('semua_alat'));
}

// Untuk detail publik
public function dasPublik($id) {
    $alat = Alat::findOrFail($id);
    return view('frontend.das', compact('alat'));
}
}