<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SubscriptionController;

Route::apiResource('services', ServiceController::class);
Route::patch('services/{service}/activate', [
    ServiceController::class, 
    'activate',
]);
Route::patch('services/{service}/deactivate', [
    ServiceController::class, 
    'deactivate',
]);

Route::get(
    'services/status/{status}',
    [ServiceController::class, 'getByStatus']
);

Route::apiResource('subscriptions', SubscriptionController::class);
Route::patch(
    'subscriptions/{subscription}/change-status',
    [SubscriptionController::class, 'changeStatus']
);