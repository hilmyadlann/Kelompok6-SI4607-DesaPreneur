<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\AdminUmkmController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PengurusController;
use App\Http\Middleware\PengurusMiddleware;
use App\Http\Controllers\KecamatanDesaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardLandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Models\Product;
use App\Models\Category;

Route::get('/', [HomeController::class, 'index'])->name('landing-page');
Route::get('/category/{category}', [HomeController::class, 'showProductsByCategory'])->name('landing.category');
Route::get('/umkms/by-desa', [HomeController::class, 'showUmkmsByDesa'])->name('umkms.by-desa');
Route::get('/umkms/{umkm}', [HomeController::class, 'show'])->name('umkms.detail');
Route::get('/products-guest/{product}', [HomeController::class, 'showProduct'])->name('products.showguest');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/umkms-guest/{umkm}', [HomeController::class, 'show'])->name('umkms.detail');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardLandingController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{category}', [DashboardLandingController::class, 'showProductsByCategory'])->name('dashboard.category');
    Route::get('/dashboard-by-desa', [DashboardLandingController::class, 'showUmkmsByDesa'])->name('dashboard.by-desa');
    Route::get('/products/{product}', [DashboardLandingController::class, 'showProduct'])->name('products.show');
    Route::get('/umkms-user/{umkm}', [DashboardLandingController::class, 'show'])->name('umkms.userdetail');
});

Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'authenticate');
    Route::post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products-up/upload', [ProductController::class, 'showUploadForm'])->name('products.form');
    Route::get('/products-tes/upload', [ProductController::class, 'upload'])->name('products.upload');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminUmkmController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/umkm/{umkm}/setujui', [AdminUmkmController::class, 'setujui'])->name('admin.umkm.setujui');
    Route::delete('/admin/umkm/{umkm}/tolak', [AdminUmkmController::class, 'tolak'])->name('admin.umkm.tolak');

    // Tambahkan rute untuk detail UMKM admin di sini
    Route::get('/admin/umkm/{umkm}/lihat', [AdminUmkmController::class, 'lihat'])->name('admin.umkm.lihat');
    Route::get('/admin/umkm/{umkm}', [AdminUmkmController::class, 'show'])->name('admin.umkm.show');  // Route untuk tombol "Lihat Detail UMKM"
    Route::delete('/admin/umkm/{umkm}/hapus', [AdminUmkmController::class, 'hapus'])->name('admin.umkm.hapus');

    // Tambahkan rute untuk indeks UMKM admin di sini
    Route::get('/admin/umkm', [AdminUmkmController::class, 'umkmIndex'])->name('admin.umkm.index');
    
    // Gabungkan kedua metode dalam satu rute
    Route::get('/admin/form-umkm', [KecamatanDesaController::class, 'index'])->name('admin.form-umkm.index');
    Route::post('/admin/form-umkm', [KecamatanDesaController::class, 'store'])->name('admin.form-umkm.store');
    Route::delete('/admin/form-umkm/{kecamatan}', [KecamatanDesaController::class, 'destroy'])->name('admin.form-umkm.destroy');
    Route::delete('/admin/form-umkm/desa/{desa}', [KecamatanDesaController::class, 'destroyDesa'])->name('admin.form-umkm.destroyDesa');
});
Route::middleware(['auth', PengurusMiddleware::class])->group(function () {
    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.dashboard');
    Route::get('/pengurus/umkm', [PengurusController::class, 'umkm'])->name('pengurus.umkm');
    Route::get('/pengurus/statistik', [PengurusController::class, 'statistik'])->name('pengurus.statistik');
});

Route::get('/umkm/create', [UMKMController::class, 'create'])->name('umkms.create');
Route::get('/getDesaByKecamatan/{kecamatanId}', [UMKMController::class, 'getDesaByKecamatan']);
Route::post('/umkms', [UMKMController::class, 'store'])->name('umkms.store');
Route::get('/desas/{kecamatan}', [UMKMController::class, 'getDesasByKecamatan'])->name('desas.by-kecamatan');

// Rute untuk mengatur toko
Route::get('/toko/{umkm}', [UMKMController::class, 'toko'])->name('toko');
Route::put('/toko/{umkm}', [UMKMController::class, 'update'])->name('toko.update');
Route::put('/umkms/{umkm}', [UMKMController::class, 'update'])->name('umkms.update');

Route::get('/products/{category}', [DashboardLandingController::class, 'showByCategory'])->name('products.category'); 

// Rute tambahan manda
Route::get('/umkm/{umkm}', [UMKMController::class, 'show'])->name('umkm.show');
Route::put('umkms/{id}', 'UMKMController@update')->name('umkms.update');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

//tambahan manda
Route::post('/product/{id}/like', [LikeController::class, 'likeProduct'])->middleware('auth')->name('product.like');
Route::get('/product/{id}', [LikeController::class, 'getProductLikes'])->name('product.detail');
Route::post('/product/{id}/like', [LikeController::class, 'likeProduct'])->middleware('auth')->name('product.like');
Route::get('/favorites', [LikeController::class, 'getUserFavorites'])->middleware('auth')->name('favorites');
Route::delete('/favorites/{product}', [LikeController::class, 'destroy'])->name('favorites.destroy');
Route::delete('/products/{id}', 'ProductController@destroy');
Route::post('/favorites/remove', 'LikeController@removeFromFavorites');

Route::post('/products/{product}/like', [ProductController::class, 'like'])->name('products.like');

// Route untuk button Lihat Produk UMKM pada Dashboard Admin
Route::get('/umkm/produk/{umkm_id}', [UMKMController::class, 'showProducts'])->name('umkm.produk');

// Route untuk button Lihat Produk UMKM pada Dashboard Admin
Route::get('/umkm/produk/{umkm_id}', [UMKMController::class, 'showProducts'])->name('umkm.produk');

//tambahan manda

Route::get('/product/{id}', [LikeController::class, 'getProductLikes'])->name('product.detail');
Route::post('/product/{id}/like', [LikeController::class, 'likeProduct'])->middleware('auth')->name('product.like');
Route::get('/favorites', [LikeController::class, 'getUserFavorites'])->middleware('auth')->name('favorites');
Route::delete('/favorites/{product}', [LikeController::class, 'destroy'])->name('favorites.destroy');
Route::delete('/products/{id}', 'ProductController@destroy');
Route::post('/favorites/remove', 'LikeController@removeFromFavorites');

Route::post('/products/{product}/like', [LikeController::class, 'likeProduct'])->name('products.like');

//melihat most like product
Route::get('/umkms/products/mostLiked', [ProductController::class, 'mostLiked'])->name('umkms.products.mostLiked');
Route::get('/umkms/products/mostLiked/{id}', [LikeController::class, 'getMostLikedProducts'])->name('umkms.products.mostLiked');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/recommendation/{id}', [ProductController::class, 'recommendationDetail'])->name('recommendation-detail');

//route untuk melihat umkm aktif di dashboard admin
Route::get('/admin/umkm-aktif', [UMKMController::class, 'indexAktif'])->name('admin.umkm-aktif.index');

Route::get('/products/{id}/editnew', [ProductController::class, 'editNew'])->name('products.editnew');

// route untuk melihat detail produk pada dashboard admin
Route::get('/products/{product}/details', [ProductController::class, 'details'])->name('products.details');