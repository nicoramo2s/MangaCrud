<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\SubCategoriaController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/mangas', [MangaController::class, 'index']);
Route::get('/mangas/{id}', [MangaController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    // Rutas para mangas
    Route::post('/mangas', [MangaController::class, 'store']);
    Route::put('/mangas/{id}', [MangaController::class, 'update']);
    Route::delete('/mangas/{id}', [MangaController::class, 'destroy']);

    // Rutas para categorías
    Route::post('/categorias', [CategoriaController::class, 'store']);
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);

    // Rutas para subcategorías
    Route::post('/subcategorias', [SubCategoriaController::class, 'store']);
    Route::put('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'update']);
    Route::delete('/subcategorias/{subcategoria}', [SubcategoriaController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});