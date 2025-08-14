<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ExpensesController;


Route::get('/', function () {
    
    if(session('user_id')){
        return redirect()->route('user.expenses.index', ['user' => session('user_id')]);
    }
    return redirect()->route('login.index');
});

Route::resource('login', LoginController::class)
    ->only(['index', 'store']);

Route::resource('register', RegisterController::class)
    ->only(['index', 'store', 'edit', 'update', 'show']);

Route::resource('user.expenses', ExpensesController::class)
    ->scoped();

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
