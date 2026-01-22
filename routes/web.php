<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HallOfFameController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\RepositoriController;
use App\Http\Controllers\RumusController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ModulController;
use App\Models\User;
use App\Models\Jabatan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. ROUTE PUBLIC (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/layanan-publik', function () {
    return view('frontend.index');
})->name('publik.index');

Route::get('/publik-hall', [HallOfFameController::class, 'indexPublik'])->name('publik.halloffame');
Route::get('/publik-hall/{id}', [HallOfFameController::class, 'showPublik'])->name('publik.halloffame.show');
Route::get('/publik-alat', [AlatController::class, 'alatPublik'])->name('publik.katalog.alat');
Route::get('/publik-alat/{id}', [AlatController::class, 'dasPublik'])->name('publik.katalog.show');
Route::get('/publik-kalender', [KalenderController::class, 'kalenderPublik'])->name('publik.kalender');
Route::get('/publik-rumus', [RumusController::class, 'rumusPublik'])->name('publik.rumus');
Route::get('/publik-rumus/{id}', [RumusController::class, 'drsPublik'])->name('publik.rumus.show');
Route::get('/publik-repositori', [RepositoriController::class, 'repositoriPublik'])->name('publik.repositori');
Route::get('/publik-event', [EventController::class, 'eventPublik'])->name('publik.event');
Route::get('/publik-modul', [ModulController::class, 'modulPublik'])->name('publik.modul');
Route::get('/download-modul/{id}', [ModulController::class, 'downloadPublik'])->name('publik.modul.download');


// --- 2. ROUTE BACK-END (Wajib Login) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard (Superadmin & Admin Biasa bisa akses)
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'jml_user' => User::count(),
            'jml_jabatan' => Jabatan::count(),
        ]);
    })->name('dashboard');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- 3. ROUTE KHUSUS SUPERADMIN (Spatie Role) ---
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('admin/jabatan', JabatanController::class)->names([
            'index' => 'jabatan.index',
            'store' => 'jabatan.store',
            'update' => 'jabatan.update',
            'destroy' => 'jabatan.destroy',
        ]);

        Route::resource('admin/user', UserController::class)->names([
            'index' => 'user.index',
            'store' => 'user.store',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ]);
    });

    // --- 4. ROUTE UMUM ADMIN (Bisa diakses Admin Biasa & Superadmin) ---
    Route::resource('admin/alat', AlatController::class)->names([
        'index' => 'alat.index', 'store' => 'alat.store', 'show' => 'alat.show', 'update' => 'alat.update', 'destroy' => 'alat.destroy'
    ]);

    Route::resource('admin/halloffame', HallOfFameController::class)->names([
        'index' => 'halloffame.index', 'store' => 'halloffame.store', 'show' => 'halloffame.show', 'update' => 'halloffame.update', 'destroy' => 'halloffame.destroy'
    ]);

    Route::resource('admin/modul', ModulController::class)->names([
        'index' => 'modul.index', 'store' => 'modul.store', 'destroy' => 'modul.destroy'
    ]);

    Route::resource('admin/event', EventController::class)->names([
        'index' => 'event.index', 'store' => 'event.store', 'update' => 'event.update', 'destroy' => 'event.destroy'
    ]);

    Route::resource('admin/rumus', RumusController::class)->names([
        'index' => 'rumus.index', 'store' => 'rumus.store', 'update' => 'rumus.update', 'destroy' => 'rumus.destroy'
    ]);

    Route::resource('admin/repositori', RepositoriController::class)->names([
        'index' => 'repositori.index', 'store' => 'repositori.store', 'update' => 'repositori.update', 'destroy' => 'repositori.destroy'
    ]);

    Route::resource('admin/kalender', KalenderController::class)->names([
        'index' => 'kalender.index', 'store' => 'kalender.store', 'update' => 'kalender.update', 'destroy' => 'kalender.destroy'
    ]);
});

require __DIR__.'/auth.php';