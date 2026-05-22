<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SubscriptionController;

Route::apiResource('users', UserController::class);
Route::apiResource('services', ServiceController::class);
Route::patch('services/{service}/activate', [
    ServiceController::class, 
    'activate',
]);
Route::patch('services/{service}/deactivate', [
    ServiceController::class, 
    'deactivate',
]);