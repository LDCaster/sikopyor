<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;


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


Route::resource('/', DashboardController::class);

Route::resource('stand', StandController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('jenis-barang', JenisBarangController::class);
Route::resource('produk', ProdukController::class);
Route::resource('users', usersController::class);
