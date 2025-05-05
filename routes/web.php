<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

// Route Login & Logout
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register.form');
Route::post('/register', [AuthController::class, 'store_user'])->name('register.store');

// Semua route di bawah sini butuh login
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Home / dashboard
    Route::get('/', [WelcomeController::class, 'index'])->name('home');

    // User
    Route::middleware(['authorize:ADS'])->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/create_ajax', [UserController::class, 'create_ajax'])->name('user.create_ajax');
        Route::post('/ajax', [UserController::class, 'store_ajax'])->name('user.store_ajax');
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax'])->name('user.edit_ajax');
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax'])->name('user.update_ajax');
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax'])->name('user.confirm_ajax');
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax'])->name('user.delete_ajax');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/import', [UserController::class, 'import'])->name('user.import');
        Route::post('/import_ajax', [UserController::class, 'import_ajax'])->name('user.import_ajax');
        Route::get('/export_excel', [UserController::class, 'export_excel'])->name('user.export_excel');
        Route::get('/export_pdf', [UserController::class, 'export_pdf'])->name('user.export_pdf');
    });

    // Kategori
    Route::middleware(['authorize:ADS,MNG,STF'])->prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/list', [KategoriController::class, 'list'])->name('kategori.list');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax'])->name('kategori.create_ajax');
        Route::post('/ajax', [KategoriController::class, 'store_ajax'])->name('kategori.store_ajax');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax'])->name('kategori.edit_ajax');
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax'])->name('kategori.update_ajax');
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax'])->name('kategori.confirm_ajax');
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax'])->name('kategori.delete_ajax');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/import', [KategoriController::class, 'import'])->name('kategori.import');
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax'])->name('kategori.import_ajax');
        Route::get('/export_excel', [KategoriController::class, 'export_excel'])->name('kategori.export_excel');
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf'])->name('kategori.export_pdf');
    });

    // Barang
    Route::middleware(['authorize:ADS,MNG,STF'])->prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/list', [BarangController::class, 'list'])->name('barang.list');
        Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/create_ajax', [BarangController::class, 'create_ajax'])->name('barang.create_ajax');
        Route::post('/ajax', [BarangController::class, 'store_ajax'])->name('barang.store_ajax');
        Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
        Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax'])->name('barang.edit_ajax');
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax'])->name('barang.update_ajax');
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax'])->name('barang.confirm_ajax');
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax'])->name('barang.delete_ajax');
        Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
        Route::get('/import', [BarangController::class, 'import'])->name('barang.import');
        Route::post('/import_ajax', [BarangController::class, 'import_ajax'])->name('barang.import_ajax');
        Route::get('/export_excel', [BarangController::class, 'export_excel'])->name('barang.export_excel');
        Route::get('/export_pdf', [BarangController::class, 'export_pdf'])->name('barang.export_pdf');
    });

    // Stock
    Route::middleware(['authorize:ADS,MNG,STF,PLG,OFG'])->prefix('stock')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('stock.index');
        Route::get('/list', [StockController::class, 'list'])->name('stock.list');
        Route::get('/create', [StockController::class, 'create'])->name('stock.create');
        Route::post('/', [StockController::class, 'store'])->name('stock.store');
        Route::get('/create_ajax', [StockController::class, 'create_ajax'])->name('stock.create_ajax');
        Route::post('/ajax', [StockController::class, 'store_ajax'])->name('stock.store_ajax');
        Route::get('/{id}', [StockController::class, 'show'])->name('stock.show');
        Route::get('/{id}/edit', [StockController::class, 'edit'])->name('stock.edit');
        Route::put('/{id}', [StockController::class, 'update'])->name('stock.update');
        Route::get('/{id}/edit_ajax', [StockController::class, 'edit_ajax'])->name('stock.edit_ajax');
        Route::put('/{id}/update_ajax', [StockController::class, 'update_ajax'])->name('stock.update_ajax');
        Route::get('/{id}/delete_ajax', [StockController::class, 'confirm_ajax'])->name('stock.confirm_ajax');
        Route::delete('/{id}/delete_ajax', [StockController::class, 'delete_ajax'])->name('stock.delete_ajax');
        Route::delete('/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
        Route::get('/import', [StockController::class, 'import'])->name('stock.import');
        Route::post('/import_ajax', [StockController::class, 'import_ajax'])->name('stock.import_ajax');
        Route::get('/export_excel', [StockController::class, 'export_excel'])->name('stock.export_excel');
        Route::get('/export_pdf', [StockController::class, 'export_pdf'])->name('stock.export_pdf');
    });

    // Level
    Route::middleware(['authorize:ADS'])->prefix('level')->group(function () {
        Route::get('/', [LevelController::class, 'index'])->name('level.index');
        Route::get('/list', [LevelController::class, 'list'])->name('level.list');
        Route::get('/create', [LevelController::class, 'create'])->name('level.create');
        Route::post('/', [LevelController::class, 'store'])->name('level.store');
        Route::get('/create_ajax', [LevelController::class, 'create_ajax'])->name('level.create_ajax');
        Route::post('/ajax', [LevelController::class, 'store_ajax'])->name('level.store_ajax');
        Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('level.edit');
        Route::put('/{id}', [LevelController::class, 'update'])->name('level.update');
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax'])->name('level.edit_ajax');
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax'])->name('level.update_ajax');
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax'])->name('level.confirm_ajax');
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax'])->name('level.delete_ajax');
        Route::delete('/{id}', [LevelController::class, 'destroy'])->name('level.destroy');
        Route::get('/import', [LevelController::class, 'import'])->name('level.import');
        Route::post('/import_ajax', [LevelController::class, 'import_ajax'])->name('level.import_ajax');
        Route::get('/export_excel', [LevelController::class, 'export_excel'])->name('level.export_excel');
        Route::get('/export_pdf', [LevelController::class, 'export_pdf'])->name('level.export_pdf');
    });

});
