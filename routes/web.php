<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('frontend.portfolio');
})->name('home');

Route::get('/login', [AdminController::class, 'getLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');

Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Profile
    Route::get('profile', [UserController::class, 'index'])->name('profile.index');
    Route::post('profile', [UserController::class, 'update'])->name('profile.update');
    //About

});

Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
