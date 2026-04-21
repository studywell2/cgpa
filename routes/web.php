<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CGPAController;

Route::get('/', [CGPAController::class, 'index']);
Route::get('/about', [CGPAController::class, 'about']);
Route::get('/help', [CGPAController::class, 'help']);
Route::post('/calculate', [CGPAController::class, 'calculate']);
