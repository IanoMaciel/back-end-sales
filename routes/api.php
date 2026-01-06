<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;


Route::get('/user-type', [UserTypeController::class, 'index']);
Route::apiResource('/users', UserController::class);
