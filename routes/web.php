<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/// Admin route
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/update', [AdminController::class, 'adminUpdate'])->name('admin.update');
    Route::get('/admin/password/update', [AdminController::class, 'updateAdminPasswordViews'])->name('admin.password.update');
    Route::post('/admin/password/update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});


Route::middleware(['auth', 'role:vendor'])->group(function (){
    Route::get('vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
});


Route::view('/admin/login', 'admin.admin_login')->name('admin.login');



require __DIR__.'/auth.php';
