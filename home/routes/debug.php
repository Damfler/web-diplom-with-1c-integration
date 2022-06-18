<?php

use App\Http\Controllers\UpdateForApiController;
use Illuminate\Support\Facades\Route;

Route::get('/debug', [UpdateForApiController::class, 'ourStorage'])->name('debug');