<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SnowWiperController;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/dashboard/view/{mode}', [DashboardController::class, 'view'])->name('dashboard.view');
    Route::get('/dashboard/sites/{type}', [DashboardController::class, 'sites'])->name('dashboard.sites');

    // Profile
    Route::view('profile', 'profile')->name('profile');

    // Project
    Route::get('/project/{id}', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/details/{id}', [ProjectController::class, 'details'])->name('project.details');
    Route::get('/project/chart/{id}', [ProjectController::class, 'chart'])->name('project.chart');

    Route::get('/project/gmcamera', [ProjectController::class, 'gmcamera'])->name('project.gmcamera');
    Route::get('/project/camera/{id}', [ProjectController::class, 'camera'])->name('project.camera');

    Route::get('/project/compare', [ProjectController::class, 'compare'])->name('project.compare');
    Route::get('/project/alert', [ProjectController::class, 'alert'])->name('project.alert');
    Route::get('/project/analysis', [ProjectController::class, 'analysis'])->name('project.analysis');
    Route::get('/project/map', [ProjectController::class, 'map'])->name('project.map');
    Route::get('/project/ottawasnow', [ProjectController::class, 'ottawasnow'])->name('project.ottawasnow');

    // Export
    Route::get('/export', [ExportController::class, 'index'])->name('export.index');
    Route::get('/export/daily', [ExportController::class, 'daily'])->name('export.daily');
    Route::get('/export/combiner', [ExportController::class, 'combiner'])->name('export.combiner');

    // Snow Wiper
    Route::get('/snowwiper/getstate', [SnowWiperController::class, 'getState'])->name('snowwiper.getState');
    Route::get('/snowwiper/turnon', [SnowWiperController::class, 'turnOn'])->name('snowwiper.turnOn');
    Route::get('/snowwiper/turnoff', [SnowWiperController::class, 'turnOff'])->name('snowwiper.turnOff');
    Route::get('/snowwiper/pulse', [SnowWiperController::class, 'pulse'])->name('snowwiper.pulse');
    Route::get('/snowwiper/autopulse/{state}', [SnowWiperController::class, 'autoPulse'])->name('snowwiper.autoPulse');

    // Report
    Route::get('/report/daily', [ReportController::class, 'daily'])->name('report.daily');
    Route::get('/report/monthly', [ReportController::class, 'monthly'])->name('report.monthly');
    Route::get('/report/budget/{id?}', [ReportController::class, 'budget'])->name('report.budget');
});

require __DIR__.'/auth.php';
