<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
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


Route::resource('/', DashboardController::class)->middleware('auth');
Route::resource('/dashboard', DashboardController::class)->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authentication']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('forgot-password', [AuthController::class, 'indexForgotPassword'])->name('forgot-password.index');


Route::resource('stand', StandController::class)->middleware('auth');
Route::resource('supplier', SupplierController::class)->middleware('auth');
Route::resource('satuan', SatuanController::class)->middleware('auth');
Route::resource('jenis-barang', JenisBarangController::class)->middleware('auth');
Route::resource('produk', ProdukController::class)->middleware('auth');
Route::resource('barang-masuk', BarangMasukController::class)->middleware('auth');
Route::resource('kasir', PenjualanController::class)->middleware('auth');
Route::resource('users', UsersController::class)->middleware(['auth', 'must-admin']);
