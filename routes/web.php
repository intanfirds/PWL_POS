<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class,'index']);

    Route::group(['prefix' => 'user'], function () {
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
    });

    Route::group(['prefix' => 'level'], function () {
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
    });

    Route::group(['prefix' => 'kategori'], function () {
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
    });

    Route::group(['prefix' => 'barang'], function () {
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
    });

    Route::group(['prefix' => 'stock'], function () {
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
    });
});



?>