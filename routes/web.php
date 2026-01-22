<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'index'])->name('home');

Route::get('/autos/nieuw', [CarController::class, 'create'])->name('cars.create');
Route::post('/autos', [CarController::class, 'store'])->name('cars.store');

Route::delete('/autos/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');