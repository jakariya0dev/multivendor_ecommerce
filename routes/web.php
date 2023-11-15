<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

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
    Route::post('/admin/update', [AdminController::class, 'adminProfileUpdate'])->name('admin.update');
    Route::get('/admin/password/update', [AdminController::class, 'viewsForUpdateAdminPassword'])->name('admin.password.update');
    Route::post('/admin/password/update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    Route::resource('brands', BrandController::class);
    Route::resource('category', CategoryController::class);
});


Route::middleware(['auth', 'role:vendor'])->group(function (){
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'vendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/update', [VendorController::class, 'vendorUpdate'])->name('vendor.update');
    Route::get('/vendor/password/update', [VendorController::class, 'updateVendorPasswordViews'])->name('vendor.password.update');
    Route::post('/vendor/password/update', [VendorController::class, 'vendorPasswordUpdate'])->name('vendor.password.update');
});


Route::view('/admin/login', 'admin.admin_login')->name('admin.login');
Route::view('/vendor/login', 'vendor.vendor_login')->name('vendor.login');
Route::view('/user/login', 'frontend.user.user_login')->name('user.login');
Route::view('/user/signup', 'frontend.user.user_signup')->name('user.signup');
Route::post('/user/signup', [UserController::class, 'storeNewUser'])->name('user.signup');

Route::get('/user/account', [UserController::class, 'userAccount'])->name('user.account');
Route::get('/user/password/reset', [UserController::class, 'resetUserPassword'])->name('user.password.reset');


require __DIR__.'/auth.php';
