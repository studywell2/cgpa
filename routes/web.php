<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CGPAController;

Route::get('/', [CGPAController::class, 'index']);
Route::get('/about', [CGPAController::class, 'about']);
Route::get('/help', [CGPAController::class, 'help']);
Route::post('/calculate', [CGPAController::class, 'calculate']);
Route::get('/grades', [CGPAController::class, 'grades']);
Route::get('/analytics', [CGPAController::class, 'analytics']);
Route::get('/pdf', [CGPAController::class, 'pdf']);
