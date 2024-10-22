<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;

// Route to create a post for a particular website
Route::post('/websites/{website}/posts', [PostController::class, 'store']);


// Route to subscribe a user to a particular website
Route::post('/websites/{website}/subscribe', [SubscriptionController::class, 'subscribe']);