<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SnowWiperController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/project/{id}', [ProjectController::class, 'index'])
        ->name('project.index');

    Route::get('/project/details/{id}', [ProjectController::class, 'details'])
        ->name('project.details');

    Route::get('/project/chart/{id}', [ProjectController::class, 'chart'])
        ->name('project.chart');

    // Snow Wiper
    Route::get('/snowwiper/getstate', [SnowWiperController::class, 'getState'])->name('snowwiper.getState');
    Route::get('/snowwiper/turnon', [SnowWiperController::class, 'turnOn'])->name('snowwiper.turnOn');
    Route::get('/snowwiper/turnoff', [SnowWiperController::class, 'turnOff'])->name('snowwiper.turnOff');
    Route::get('/snowwiper/pulse', [SnowWiperController::class, 'pulse'])->name('snowwiper.pulse');
    Route::get('/snowwiper/autopulse/{state}', [SnowWiperController::class, 'autoPulse'])->name('snowwiper.autoPulse');

});

require __DIR__.'/auth.php';
