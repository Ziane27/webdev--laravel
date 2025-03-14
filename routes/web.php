<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;

Route::get('/web', function () {
    return view('layouts.StudentView');
});

// Auth
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/user-login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', [AuthController::class, 'indexRegister'])->name('auth.register');
Route::post('/user-register', [AuthController::class, 'userRegister'])->name('auth.userRegister');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware([AuthCheck::class])->group(function (){

//View all Students
Route::get('/', [StudentsController::class, 'index'])->name('std.viewAll');

//Create New Students
Route::post('/create-new', [StudentsController::class, 'createNewSTD'])->name('std.create');
Route::put('/update/{id}', [StudentsController::class, 'updateSTD'])->name('std.update');
Route::delete('/delete/{id}', [StudentsController::class, 'deleteSTD'])->name('std.delete');
});