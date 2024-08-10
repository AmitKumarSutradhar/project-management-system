<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectManagementSytemController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','role:admin'])->prefix('admin')->group(function (){
    Route::get('dashboard', [AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::resource('project',ProjectController::class);
    Route::resource('task',TaskController::class);
    Route::resource('user',UserManagementController::class);
    Route::resource('comment',CommentController::class);
});


Route::resource('project',ProjectController::class);
Route::resource('task',TaskController::class);
Route::resource('user',UserManagementController::class);
Route::resource('comment',CommentController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
