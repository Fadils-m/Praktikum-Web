<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

Route::get('/', [DonasiController::class, 'index']);
Route::get('/donasi/create', [DonasiController::class, 'create']);
Route::post('/donasi', [DonasiController::class, 'store']);

Route::get('/donasi/{id}/edit', [DonasiController::class, 'edit']);
Route::post('/donasi/{id}/update', [DonasiController::class, 'update']);

Route::get('/donasi/{id}/delete', [DonasiController::class, 'destroy']);