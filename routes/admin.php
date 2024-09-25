<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileCompleteController;
use App\Http\Controllers\Admin\JobPortalController;


// Routes for admin with authentication check
Route::prefix('portal')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/profile', [ProfileCompleteController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileCompleteController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/documents', [ProfileCompleteController::class, 'storeDocuments'])->name('profile.documents.store');
    Route::delete('/profile/documents/{id}', [ProfileCompleteController::class, 'destroyDocument'])->name('profile.documents.destroy');
    Route::get('/jobs-listing', [JobPortalController::class, 'jobs_listing'])->name('job.listng');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout'); 
});

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'login_check'])->name('login.check');
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::post('/user-store', [AdminController::class, 'user_store'])->name('user.store');

