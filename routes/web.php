<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index']);
Route::post('/youtube', [IndexController::class, 'downloadYoutube'])->name('downloadYoutube');
