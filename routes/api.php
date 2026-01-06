<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;


Route::get('/user-type', [UserTypeController::class, 'index']);

Route::apiResource('/users', UserController::class);
Route::get('/users/softDelete/{id}', [UserController::class, 'softDelete']);
Route::get('/users/restoreUser/{id}', [UserController::class, 'restoreUser']);

Route::apiResource('/customers', CustomerController::class);
