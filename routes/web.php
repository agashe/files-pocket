<?php

use Illuminate\Support\Facades\Route;

/** Auth Routes **/
Auth::routes();

Route::middleware('auth')->group(function () {
    /** Home Routes **/
    Route::get('/', [HomeController::class, 'index'])->name('home');

    /** Folders Routes **/
    Route::resource('folders', FolderController::class)->except(['create', 'edit', 'update']);

    /** Files Routes **/
    Route::resource('files', FileController::class)->only(['store', 'destroy']);
});
