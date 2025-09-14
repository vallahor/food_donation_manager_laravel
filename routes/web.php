<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FoodPackageController;
use App\Http\Controllers\ItemController;
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

    Route::get('/packages', [FoodPackageController::class, 'index'])->name('package.index');
    Route::get('/packages/new', [FoodPackageController::class, 'create'])->name('package.create');
    Route::post('/packages', [FoodPackageController::class, 'store'])->name('package.store');
    Route::get('/packages/{food_package}', [FoodPackageController::class, 'show'])->name('package.show');
    Route::get('/packages/{food_package}/edit', [FoodPackageController::class, 'edit'])->name('package.edit');
    Route::put('/packages/{food_package}', [FoodPackageController::class, 'update'])->name('package.update');
    Route::delete('/packages/{food_package}', [FoodPackageController::class, 'destroy'])->name('package.destroy');

    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/items/new', [ItemController::class, 'create'])->name('item.create');
    Route::post('/items', [ItemController::class, 'store'])->name('item.store');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('item.destroy');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
