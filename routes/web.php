<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\master\UserController;
use App\Http\Controllers\master\CustomersController;
use App\Http\Controllers\master\EmployeesController;

Route::get('/landing', function () {
    return view('landing');
});

Route::middleware(['auth', 'verified'])->get('/', [HomeController::class, 'index'])->name('index');
Route::middleware(['auth', 'verified'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('users/reset/{id}', [UserController::class, 'resetPassword'])->name('users.reset');
    Route::put('users/password/{id}', [UserController::class, 'updatePassword'])->name('users.password');
    Route::get('profil/edit/{id}', [UserController::class, 'editProfil'])->name('profil.edit');
    Route::patch('profil/update/{id}', [UserController::class, 'updateProfil'])->name('profil.update');
});

Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('customer', CustomersController::class);
    Route::resource('employees', EmployeesController::class);
});

require __DIR__.'/auth.php';
