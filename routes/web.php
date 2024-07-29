<?php

use App\Http\Controllers\TickerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/crypto', [TickerController::class, 'index']);




