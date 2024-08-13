<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectManagementSytemController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\User\UserProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserTaskController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth','user_type:admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('dashboard', [AdminController::class,'adminDashboard'])->name('dashboard');
    Route::resource('project',ProjectController::class);
    Route::resource('task',TaskController::class);
    Route::resource('user',UserManagementController::class);
    Route::resource('comment',CommentController::class);
    Route::resource('role',RoleController::class);
    Route::get('/permission/show-all-permission',[PermissionController::class,'showAllPermission'])->name('permission.all');
    Route::post('/permission/assign-permission',[PermissionController::class,'assignPermissionToRole'])->name('permission.assign');
    Route::resource('permission',PermissionController::class);
});

Route::middleware(['auth','user_type:user'])->prefix('user')->name('user.')->group(function (){
    Route::get('dashboard', [UserController::class,'userDashboard'])->name('dashboard');
    Route::resource('project',UserProjectController::class);
    Route::resource('task',UserTaskController::class);
    Route::resource('comment',UserCommentController::class);
});


//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
