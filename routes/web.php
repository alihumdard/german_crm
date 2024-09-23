<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;


Route::get('/', [WebController::class, 'index'])->name('page.home');

include __DIR__ . '/admin.php';