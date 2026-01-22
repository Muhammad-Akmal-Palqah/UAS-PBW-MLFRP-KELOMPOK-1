<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{

    public function index()
    {
        $semua_modul = Modul::all();
        return view('admin.modul.index', compact('semua_modul'));
    }

    public function store(Request $request) {
    $request->validate([
        'file_modul' => 'required|mimes:pdf,docx,doc|max:5000',
    ]);

    $path = $request->file('file_modul')->store('modul', 'public');

    Modul::create([
        'nama_modul' => $request->nama_modul,
        'kategori' => $request->kategori,
        'file_path' => $path,
    ]);
    

    return redirect()->back()->with('success', 'Modul berhasil diupload!');
}
    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus file fisik dari storage
        if ($modul->file_path) {
            \Storage::disk('public')->delete($modul->file_path);
        }

        $modul->delete();

        return redirect()->route('modul.index')->with('success', 'Modul berhasil dihapus!');
    }

    public function downloadPublik($id)
{
    $modul = Modul::findOrFail($id);
    $filePath = storage_path('app/public/' . $modul->file_path);

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'File tidak ditemukan.');
}

        // Untuk list publik
public function modulPublik() {
    $semua_modul = Modul::all();
    return view('frontend.modul', compact('semua_modul'));
}


}
