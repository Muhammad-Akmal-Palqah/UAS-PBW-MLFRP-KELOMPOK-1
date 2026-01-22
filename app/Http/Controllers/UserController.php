<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Tambahkan import Role dari Spatie

class UserController extends Controller
{
    public function index()
    {
        // Tetap menggunakan eager loading jabatan
        $semua_user = User::with('jabatan')->get();
        $semua_jabatan = Jabatan::all();
        // Ambil semua role untuk ditampilkan di dropdown modal
        $roles = Role::all(); 
        
        return view('admin.user.user', compact('semua_user', 'semua_jabatan', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
            'jabatan_id' => 'required',
            'role' => 'required' // Tambahkan validasi untuk input role
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->name . '@email.com', 
            'password' => Hash::make($request->password),
            'jabatan_id' => $request->jabatan_id,
        ]);

        // Memberikan role ke user baru menggunakan fungsi Spatie
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'jabatan_id' => 'required',
            'role' => 'required' // Tambahkan validasi role
        ]);

        $user->name = $request->name;
        $user->jabatan_id = $request->jabatan_id;

        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed|min:6']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sinkronisasi ulang role (menghapus role lama, mengganti dengan yang baru dipilih)
        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Proteksi agar user yang sedang login tidak menghapus dirinya sendiri
        if (auth()->user()->id == $user->id) {
            return redirect()->route('user.index')->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}