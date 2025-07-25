<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 🔐 Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// 📬 Posts CRUD
Route::apiResource('posts', PostController::class);

// 📝 Comments routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
});

// ❤️ Likes routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts/{post}/likes', [LikeController::class, 'getLikes']);
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);
});