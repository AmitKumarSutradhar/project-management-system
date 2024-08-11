<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectManagementSytemController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::get('/dashboard', [ProjectManagementSytemController::class,'userDashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('dashboard', [AdminController::class,'adminDashboard'])->name('dashboard');
    Route::resource('project',ProjectController::class);
    Route::resource('task',TaskController::class);
    Route::resource('user',UserManagementController::class);
    Route::resource('comment',CommentController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
});

//Route::middleware(['auth'])->prefix('user')->group(function (){
//    Route::get('dashboard', [UserController::class,'userDashboard'])->name('user.dashboard');
//    Route::resource('project',ProjectController::class);
//    Route::resource('task',TaskController::class);
//    Route::resource('user',UserManagementController::class);
//    Route::resource('comment',CommentController::class);
//});


//Route::resource('project',ProjectController::class);
//Route::resource('task',TaskController::class);
//Route::resource('user',UserManagementController::class);
//Route::resource('comment',CommentController::class);


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
