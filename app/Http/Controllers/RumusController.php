<?php

namespace App\Http\Controllers;

use App\Models\Rumus;
use Illuminate\Http\Request;

class RumusController extends Controller
{
    public function index() {
        $semua_rumus = Rumus::all();
        return view('admin.rumus.index', compact('semua_rumus'));
    }

    public function store(Request $request) {
        Rumus::create($request->all());
        return redirect()->route('rumus.index')->with('success', 'Rumus ditambahkan!');
    }

    public function show($id) {
        $rumus = Rumus::findOrFail($id);
        return view('admin.rumus.show', compact('rumus'));
    }

    public function update(Request $request, $id) {
        $rumus = Rumus::findOrFail($id);
        $rumus->update($request->all());
        return redirect()->route('rumus.index')->with('success', 'Rumus diperbarui!');
    }

    public function destroy($id) {
        Rumus::findOrFail($id)->delete();
        return redirect()->route('rumus.index')->with('success', 'Rumus dihapus!');
    }

    // Untuk list publik
public function rumusPublik() {
    $semua_rumus = Rumus::all();
    return view('frontend.rumus', compact('semua_rumus'));
}

// Untuk detail publik
public function drsPublik($id) {
    $rumus = Rumus::findOrFail($id);
    return view('frontend.drs', compact('rumus'));
}
}