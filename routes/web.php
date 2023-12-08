<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
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
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('banner', BannerController::class);

    Route::post('product/thumbnail/update', [ProductController::class, 'updateThumbnail'])->name('update.product.thumbnail');
    Route::post('product/images/update/{id}', [ProductController::class, 'updateProductImage'])->name('update.product.image');
    Route::get('product/images/delete/{id}', [ProductController::class, 'deleteProductImage'])->name('delete.product.image');
    Route::get('product/status/update/{id}/{status}', [ProductController::class, 'updateProductStatus'])->name('product.status.update');
    Route::get('product/delete/{product}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::resource('product', ProductController::class);

    Route::get('/subcategory/category/{id}', [SubCategoryController::class, 'subCategoriesByCategoryId']);

    Route::get('vendor/list/all',[VendorController::class, 'allVendors'])->name('vendor.all');
    Route::get('vendor/details/{id}',[VendorController::class, 'detailsOfVendor'])->name('vendor.details');
    Route::get('vendor/list/active',[VendorController::class, 'activeVendors'])->name('vendor.active');
    Route::get('vendor/list/inactive',[VendorController::class, 'inactiveVendors'])->name('vendor.inactive');
    Route::post('vendor/status/update/{id}',[VendorController::class, 'vendorStatusUpdate'])->name('vendor.status.update');
});


Route::middleware(['auth', 'role:vendor'])->group(function (){
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'vendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/update', [VendorController::class, 'vendorUpdate'])->name('vendor.update');
    Route::get('/vendor/password/update', [VendorController::class, 'updateVendorPasswordViews'])->name('vendor.password.update');
    Route::post('/vendor/password/update', [VendorController::class, 'vendorPasswordUpdate'])->name('vendor.password.update');

    Route::get('/sub-category/category/{id}', [VendorProductController::class, 'subCategoriesByCategoryId']);
    Route::post('vendor-product/thumbnail/update', [VendorProductController::class, 'updateThumbnail'])->name('update.vendor-product.thumbnail');
    Route::post('vendor-product/images/update/{id}', [VendorProductController::class, 'updateProductImage'])->name('update.vendor-product.image');
    Route::get('vendor-product/images/delete/{id}', [VendorProductController::class, 'deleteProductImage'])->name('delete.vendor-product.image');
    Route::get('/vendor-product/status/update/{id}/{status}', [VendorProductController::class, 'updateProductStatus'])->name('vendor-product.status.update');
    Route::get('/vendor-product/delete/{product}', [VendorProductController::class, 'deleteProduct'])->name('vendor-product.delete');
    Route::get('/sub-category/category/{id}', [VendorProductController::class, 'subCategoriesByCategoryId']);
    Route::resource('vendor-product', VendorProductController::class);
});

Route::get('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');
Route::post('/vendor/register', [VendorController::class, 'newVendorStore'])->name('vendor.register');

Route::view('/user/signup', 'frontend.user.user_signup')->name('user.signup');
Route::post('/user/signup', [UserController::class, 'storeNewUser'])->name('user.signup');

Route::get('/user/account', [UserController::class, 'userAccount'])->name('user.account');
Route::get('/user/password/reset', [UserController::class, 'resetUserPassword'])->name('user.password.reset');

Route::middleware(RedirectIfAuthenticated::class)->group(function (){
    Route::view('/vendor/login', 'vendor.vendor_login')->name('vendor.login');
    Route::view('/user/login', 'frontend.user.user_login')->name('user.login');
    Route::view('/admin/login', 'admin.admin_login')->name('admin.login');
});

// Frontend
// Product
Route::get('/product/{id}/{slug}', [IndexController::class, 'productDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor.details');
Route::get('/vendor/list', [IndexController::class, 'allVendorList'])->name('vendor.list');
Route::get('/category/{id}/{slug}', [IndexController::class, 'categoryWiseProduct']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'subCategoryWiseProduct']);

require __DIR__.'/auth.php';
