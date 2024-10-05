<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileCompleteController;
use App\Http\Controllers\Admin\JobPortalController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\InterviewController;


// Routes for admin with authentication check
Route::prefix('portal')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/candidates', [AdminController::class, 'candidates'])->name('candidates');
    Route::get('/profile', [ProfileCompleteController::class, 'index'])->name('profile.index');
    Route::post('/profile-update', [ProfileCompleteController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile-documents', [ProfileCompleteController::class, 'storeDocuments'])->name('profile.documents.store');
    Route::post('/profile-experience', [ProfileCompleteController::class, 'storeExperience'])->name('profile.experience.store');
    Route::delete('/profile-documents/{id}', [ProfileCompleteController::class, 'destroyDocument'])->name('profile.documents.destroy');
    Route::get('/job-listing', [JobPortalController::class, 'jobs_listing'])->name('job.listng');
    Route::get('/job-create', [JobPortalController::class, 'job_create'])->name('job.create');
    Route::post('/job-apply', [ApplicationController::class, 'apply'])->name('job.apply');
    Route::get('/job-applied', [ApplicationController::class, 'job_applied'])->name('job.applied');
    Route::post('/jobs-assign', [ApplicationController::class, 'job_assign'])->name('job.assign');
    Route::get('/job-applications', [ApplicationController::class, 'job_applications'])->name('job.applications');
    Route::post('/job-applications-status', [ApplicationController::class, 'job_applications_status'])->name('job.application.update');
    Route::get('/jobs-view/{id}', [JobPortalController::class, 'job_view'])->name('job.view');
    Route::post('/jobs-store', [JobPortalController::class, 'job_store'])->name('job.store');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout'); 
    Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews.index');
    Route::get('/interviews-scheduled', [InterviewController::class, 'interviews_scheduled'])->name('interviews.scheduled');
    Route::get('/interviews-assigned', [InterviewController::class, 'interviews_assigned'])->name('interview.assigned');
    Route::get('/interviews/create/{applicationId}', [InterviewController::class, 'create'])->name('interviews.create');
    Route::post('/interviews', [InterviewController::class, 'store'])->name('interviews.store');
    Route::post('/interview-update', [InterviewController::class, 'interveiw_update'])->name('interview.update');
    Route::get('/interviews/{id}/edit', [InterviewController::class, 'edit'])->name('interviews.edit');
    Route::put('/interviews/{id}', [InterviewController::class, 'update'])->name('interviews.update');
    Route::delete('/interviews/{id}', [InterviewController::class, 'destroy'])->name('interviews.destroy');
    Route::post('/interview/start/{interview}', [InterviewController::class, 'startInterview'])->name('interview.start');
    Route::get('/test-hireflix-api', [InterviewController::class, 'testHireflixApi']);



});

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'login_check'])->name('login.check');
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::post('/user-store', [AdminController::class, 'user_store'])->name('user.store');

