<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ExpensesController;



Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::resource('login', LoginController::class)
    ->only(['index', 'store']);


Route::resource('register', RegisterController::class)
    ->only(['index', 'store']);

Route::resource('expenses', ExpensesController::class)
    ->only(['index', 'store']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
