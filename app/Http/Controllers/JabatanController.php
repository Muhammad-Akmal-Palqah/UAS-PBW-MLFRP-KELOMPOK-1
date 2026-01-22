<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $semua_jabatan = Jabatan::all();
        // Mengarahkan ke folder resources/views/admin/jabatan/index.blade.php
        return view('admin.jabatan.index', compact('semua_jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
        ]);

        Jabatan::create($request->all());

        return back()->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_jabatan' => 'required|string|max:255',
    ]);

    $jabatan = Jabatan::findOrFail($id);
    $jabatan->update($request->all());

    return redirect()->route('jabatan.index')->with('success', 'Data diperbarui!');
}

public function destroy($id)
{
    $jabatan = Jabatan::findOrFail($id);
    $jabatan->delete();

    return redirect()->route('jabatan.index')->with('success', 'Data dihapus!');
}
}