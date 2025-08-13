<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

// Redirección principal al listado de animales
Route::redirect('/', '/animales')->name('home');
Route::resource('animales', AnimalController::class)->parameters([
    'animales' => 'animal' // Esto indica que usará {animal} como parámetro
]);
// Rutas de recursos para animales
Route::resource('animales', AnimalController::class)->names([
    'index' => 'animales.index',
    'create' => 'animales.create',
    'store' => 'animales.store',
    'show' => 'animales.show',
    'edit' => 'animales.edit',
    'update' => 'animales.update',
    'destroy' => 'animales.destroy'
]);

// Si necesitas rutas adicionales para animales
Route::prefix('animales')->group(function () {
    // Ejemplo: Ruta para búsqueda
    // Route::get('/buscar', [AnimalController::class, 'buscar'])->name('animales.buscar');
});
