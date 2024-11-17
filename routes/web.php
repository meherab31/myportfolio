<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\SkillsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BlogController;


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

    Route::prefix('skills')->name('skills.')->group(function () {
        Route::get('/', [SkillsController::class, 'index'])->name('index');

        // Category Routes
        Route::get('/category/create', [SkillsController::class, 'createCategory'])->name('category.create');
        Route::post('/category/store', [SkillsController::class, 'storeCategory'])->name('category.store');
        Route::get('/category/edit/{id}', [SkillsController::class, 'editCategory'])->name('category.edit');
        Route::put('/category/update/{id}', [SkillsController::class, 'updateCategory'])->name('category.update');
        Route::delete('/category/delete/{id}', [SkillsController::class, 'deleteCategory'])->name('category.delete');

        // Skill Routes
        Route::get('/create', [SkillsController::class, 'createSkill'])->name('skill.create');
        Route::post('/store', [SkillsController::class, 'storeSkill'])->name('skill.store');
        Route::get('/edit/{id}', [SkillsController::class, 'editSkill'])->name('skill.edit');
        Route::put('/update/{id}', [SkillsController::class, 'updateSkill'])->name('skill.update');
        Route::delete('/delete/{id}', [SkillsController::class, 'deleteSkill'])->name('skill.delete');
    });

    //Projects Routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    //Blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('/blogs/upload', [BlogController::class, 'upload']);


});

