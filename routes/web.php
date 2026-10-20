<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// WILAYAH USER BIASA (Masyarakat)
// ==========================================
Route::middleware('auth')->group(function () {
    // 1. Dashboard User
    Route::get('/dashboard', function () {
        // Cegah Admin masuk ke dashboard user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Ambil pengaduan HANYA milik user yang login
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('complaints')); // Memanggil resources/views/dashboard.blade.php
    })->name('dashboard');

    // 2. Rute CRUD Pengaduan
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');

    // 3. Rute Profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// WILAYAH ADMIN (Dilindungi Middleware 'admin')
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 1. Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 
    // Memanggil method dashboard() di AdminController
    
    // 2. Aksi Admin
    Route::put('/complaints/{id}', [AdminController::class, 'update'])->name('admin.update');
});

require __DIR__.'/auth.php';