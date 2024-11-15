<?php
use App\Http\Controllers\JobDashboardController;

Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', [JobDashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/clear-logs', [JobDashboardController::class, 'clearLogs'])->name('dashboard.clear-logs');
});
