<?php

use App\Http\Controllers\AnalysisReportController;
use App\Http\Controllers\ClubProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('club-profiles', ClubProfileController::class)->middleware('role:admin,club manager,scout,coach');
    Route::resource('players', PlayerController::class)->middleware('role:admin,club manager,scout,coach');
    Route::get('reports', [AnalysisReportController::class, 'index'])->name('reports.index');
    Route::get('reports/create', [AnalysisReportController::class, 'create'])->name('reports.create')->middleware('role:admin,club manager,scout');
    Route::post('reports', [AnalysisReportController::class, 'store'])->name('reports.store')->middleware('role:admin,club manager,scout');
    Route::get('reports/{report}', [AnalysisReportController::class, 'show'])->name('reports.show');
    Route::delete('reports/{report}', [AnalysisReportController::class, 'destroy'])->name('reports.destroy')->middleware('role:admin,club manager');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
