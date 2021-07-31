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

    /** Folders Routes **/
    Route::resource('folders', FolderController::class)->except(['create', 'edit', 'update']);

    /** Files Routes **/
    Route::resource('files', FileController::class)->only(['store', 'destroy']);
});
