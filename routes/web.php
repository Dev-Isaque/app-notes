<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// auth routes - user not logged
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get("/login", [AuthController::class, 'login']);
    Route::post("/loginSubmit", [AuthController::class, 'loginSubmit']);
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/store', [AuthController::class,'store'])->name('store');
});

// app routes - user logged
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/edit', [MainController::class,'edit'])->name('edit');
    Route::put('/update', [MainController::class,'update'])->name('update');

    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class,'newNoteSubmit'])->name('newNoteSubmit');

    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('editNote');
    Route::post('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class,'deleteNoteConfirm'])->name('deleteConfirm');

    Route::get("/logout", [AuthController::class, 'logout'])->name('logout');
});
