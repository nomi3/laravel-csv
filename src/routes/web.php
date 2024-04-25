<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsuredController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insured', [InsuredController::class, 'index'])->name('insured.index');
