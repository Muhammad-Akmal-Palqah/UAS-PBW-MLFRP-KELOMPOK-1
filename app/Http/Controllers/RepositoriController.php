<?php

namespace App\Http\Controllers;

use App\Models\Repositori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepositoriController extends Controller
{
    // Menampilkan ke Admin
    public function index()
    {
        $semua_jurnal = Repositori::latest()->get();
        return view('admin.repositori.index', compact('semua_jurnal'));
    }

    // Menampilkan ke Publik (Frontend)
    public function repositoriPublik() 
    {
        $semua_jurnal = Repositori::latest()->get();
        return view('frontend.repositori', compact('semua_jurnal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'penulis'     => 'required|string',
            'keyword'     => 'required|string|max:255',
            'file_jurnal' => 'required|mimes:pdf|max:10000',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_jurnal')) {
            // Simpan file ke folder: storage/app/public/jurnal
            $path = $request->file('file_jurnal')->store('jurnal', 'public');
            $data['file_jurnal'] = $path;
        }

        Repositori::create($data);
        return redirect()->back()->with('success', 'Jurnal berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jurnal = Repositori::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'penulis' => 'required|string',
            'keyword' => 'required|string|max:255',
            'file_jurnal' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_jurnal')) {
            // Hapus file lama
            if ($jurnal->file_jurnal) {
                Storage::disk('public')->delete($jurnal->file_jurnal);
            }
            $data['file_jurnal'] = $request->file('file_jurnal')->store('jurnal', 'public');
        }

        $jurnal->update($data);
        return redirect()->back()->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurnal = Repositori::findOrFail($id);
        if ($jurnal->file_jurnal) {
            Storage::disk('public')->delete($jurnal->file_jurnal);
        }
        $jurnal->delete();
        return redirect()->back()->with('success', 'Jurnal berhasil dihapus!');
    }
}