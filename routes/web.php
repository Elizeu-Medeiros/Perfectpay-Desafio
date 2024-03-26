<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas para CRUD de Clientes
    Route::resource('customer', CustomerController::class);

    // Rotas para CRUD de Pagamentos
    Route::resource('payments', PaymentController::class);
});
