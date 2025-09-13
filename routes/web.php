<?php

use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/families', [FamilyController::class, 'index'])->name('family.index');
    Route::get('/families/new', [FamilyController::class, 'create'])->name('family.create');
    Route::post('/families', [FamilyController::class, 'store'])->name('family.store');
    Route::get('/families/{family}', [FamilyController::class, 'show'])->name('family.show');
    Route::get('/families/{family}/edit', [FamilyController::class, 'edit'])->name('family.edit');
    Route::put('/families/{family}', [FamilyController::class, 'update'])->name('family.update');
    Route::delete('/families/{family}', [FamilyController::class, 'destroy'])->name('family.destroy');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
