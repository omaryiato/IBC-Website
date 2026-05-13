<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\CareerController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\MediaController;

Route::prefix('pages')->group(function () {

    Route::get('/', [PageController::class, 'index']);

    Route::get('{slug}', [PageController::class, 'show']);

    Route::post('/', [PageController::class, 'store']);
});

Route::prefix('sections')->group(function () {

    Route::get('{pageId}', [SectionController::class, 'index']);

    Route::post('/', [SectionController::class, 'store']);
});

Route::prefix('items')->group(function () {

    Route::get('{sectionId}', [ItemController::class, 'index']);

    Route::post('/', [ItemController::class, 'store']);
});

Route::prefix('blogs')->group(function () {

    Route::get('/', [BlogController::class, 'index']);

    Route::get('{slug}', [BlogController::class, 'show']);

    Route::post('/', [BlogController::class, 'store']);
});

Route::prefix('careers')->group(function () {

    Route::get('/', [CareerController::class, 'index']);

    Route::post('/', [CareerController::class, 'store']);
});

Route::post(
    'contact',
    [ContactController::class, 'store']
);

Route::post(
    'media/upload',
    [MediaController::class, 'store']
);
