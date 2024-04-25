<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsuredController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(InsuredController::class)->prefix('insureds')->name('insureds.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
});
