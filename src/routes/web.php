<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsuredController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insureds', [InsuredController::class, 'index'])->name('insureds.index');
Route::get('/insureds/create', [InsuredController::class, 'create'])->name('insureds.create');
Route::post('/insureds', [InsuredController::class, 'store'])->name('insureds.store');
