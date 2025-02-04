<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TariffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::resource('orders', OrderController::class);
Route::resource('tariffs', TariffController::class);
