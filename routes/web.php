<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [ProjectController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.detail');
    Route::post('/project/{project}', [ProjectController::class, 'update'])->name('project.update');
    Route::get('/project/delete/{project}', [ProjectController::class, 'destroy'])->name('project.delete');

    Route::post('/task', [TaskController::class, 'store']);
    Route::get('/task/{task}', [TaskController::class, 'show']);
    Route::post('/task/{task}', [TaskController::class, 'update']);
    Route::delete('/task/{task}', [TaskController::class, 'destroy']);
});

require __DIR__.'/auth.php';
