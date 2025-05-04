<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
});

require __DIR__.'/auth.php';
