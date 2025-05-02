<?php

use App\Http\Controllers\ActivoController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/activos', [App\Http\Controllers\ActivoController::class, 'index'])->name('activos.index');
Route::get('/activos/create', [App\Http\Controllers\ActivoController::class, 'create'])->name('activos.create');
Route::post('/activos/store', [App\Http\Controllers\ActivoController::class, 'store'])->name('activos.store');
Route::get('/activos/edit{id}', [App\Http\Controllers\ActivoController::class, 'edit'])->name('activos.edit');
Route::put('/activos/update{id}', [App\Http\Controllers\ActivoController::class, 'update'])->name('activos.update');
Route::get('/activos/baja{id}', [App\Http\Controllers\BajaController::class, 'create'])->name('bajas.create');
Route::post('/activos/baja{id}', [App\Http\Controllers\BajaController::class, 'store'])->name('bajas.store');