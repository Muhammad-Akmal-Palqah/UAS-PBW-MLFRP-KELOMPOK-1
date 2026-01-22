<?php

namespace App\Http\Controllers;

use App\Models\HallOfFame; // Pastikan Model ini sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HallOfFameController extends Controller
{
    // 1. Menampilkan Semua Data Tokoh (Halaman fff)
    public function index()
    {
        $semua_tokoh = HallOfFame::all();
        return view('admin.halloffame.index', compact('semua_tokoh'));
    }

    // 2. Menyimpan Data Tokoh Baru (Fungsi Modal TT1)
    public function store(Request $request)
    {
        $request->validate([
            'nama_tokoh' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable'
        ]);

        // Proses Upload Foto ke folder storage/app/public/tokoh
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('tokoh', 'public');
        }

        HallOfFame::create([
            'nama_tokoh' => $request->nama_tokoh,
            'foto' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('halloffame.index')->with('success', 'Tokoh berhasil ditambahkan!');
    }

    // 3. Menampilkan Detail Tokoh (Halaman dt1)
    public function show($id)
    {
        $tokoh = HallOfFame::findOrFail($id);
        return view('admin.halloffame.show', compact('tokoh'));
    }

    // 4. Update Data Tokoh (Fungsi Modal ET1)
    public function update(Request $request, $id)
    {
        $tokoh = HallOfFame::findOrFail($id);

        $request->validate([
            'nama_tokoh' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika user upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama agar tidak memenuhi memori
            if ($tokoh->foto) {
                Storage::disk('public')->delete($tokoh->foto);
            }
            // Simpan foto baru
            $path = $request->file('foto')->store('tokoh', 'public');
            $tokoh->foto = $path;
        }

        $tokoh->nama_tokoh = $request->nama_tokoh;
        $tokoh->deskripsi = $request->deskripsi;
        $tokoh->save();

        return redirect()->route('halloffame.index')->with('success', 'Data berhasil diperbarui!');
    }

    // 5. Menghapus Data Tokoh
    public function destroy($id)
    {
        $tokoh = HallOfFame::findOrFail($id);
        
        // Hapus file foto dari folder storage
        if ($tokoh->foto) {
            Storage::disk('public')->delete($tokoh->foto);
        }
        
        $tokoh->delete();

        return redirect()->route('halloffame.index')->with('success', 'Tokoh berhasil dihapus!');
    }

    // Untuk list publik
public function indexPublik() {
    $semua_tokoh = HallOfFame::all();
    return view('frontend.hall', compact('semua_tokoh'));
}

// Untuk detail publik
public function showPublik($id) {
    $tokoh = HallOfFame::findOrFail($id);
    return view('frontend.show', compact('tokoh'));
}
}