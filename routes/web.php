<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EducationController;


Route::get('/', function () {
    return view('frontend.portfolio');
})->name('home');

Route::get('/login', [AdminController::class, 'getLogin'])->name('login');
Route::post('/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
//Admin Panel
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Profile
    Route::get('profile', [UserController::class, 'index'])->name('profile.index');
    Route::post('profile', [UserController::class, 'update'])->name('profile.update');
    //About
    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    //Experience
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::post('/experiences/store', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::put('/experiences/update/{id}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('experiences/{id}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    //Educations
    Route::get('/educations', [EducationController::class, 'index'])->name('educations.index');
    Route::post('/educations/store', [EducationController::class, 'store'])->name('educations.store');
    Route::put('/educations/update/{id}', [EducationController::class, 'update'])->name('educations.update');
    Route::delete('educations/{id}', [EducationController::class, 'destroy'])->name('educations.destroy');
});

