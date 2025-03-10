<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProjectController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProjectController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('projects', ProjectController::class)->middleware(['auth']);

Route::get('/projects/{project}/upload', [ImageUploadController::class, 'showForm'])->name('image.form');
Route::post('/projects/{project}/upload', [ImageUploadController::class, 'upload'])->name('image.upload');
Route::get ('/projects/{project}/images', [ImageUploadController::class, 'listImages'])->name('images.list');

Route::get('/project-upload', function () {
    return view('project-upload');
})->middleware(['auth', 'verified'])->name('project-upload');

Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

require __DIR__.'/auth.php';
