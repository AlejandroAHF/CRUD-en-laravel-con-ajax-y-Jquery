<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaCatalogoClienteController;

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

Route::get('/', [VentaCatalogoClienteController::class, 'list'])->name('clientes.list');
Route::get('/clientes-fetch', [VentaCatalogoClienteController::class, 'fetchTabla'])->name('clientes.fetch');
Route::resource('clientes', VentaCatalogoClienteController::class);

/* Route::get('/', function () {
    return view('welcome');
}); */
