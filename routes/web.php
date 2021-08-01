<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;

/** Auth Routes **/
Auth::routes();

Route::middleware('auth')->group(function () {
    /** Home Routes **/
    Route::get('/{id?}', [HomeController::class, 'index'])->name('home');
    Route::get('items/search', [HomeController::class, 'search'])->name('search');

    /** Folders Routes **/
    Route::resource('folders', FolderController::class)->only(['store', 'destroy']);

    /** Files Routes **/
    Route::resource('files', FileController::class)->only(['store', 'destroy']);
});
