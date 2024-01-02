<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ImgurController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/movies/{period}/{page?}', [MovieController::class, 'getMovies']);
Route::get('/movie/{id}', [MovieController::class, 'getMovieDetails']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'getUser']);
        Route::get('/all', [UserController::class, 'getAllUsers']);
        Route::put('/login', [UserController::class, 'updateLogin']);
        Route::put('/avatar', [UserController::class, 'updateAvatar']);
    });

    Route::post('/imgur/upload-image', [ImgurController::class, 'store']);

    Route::resource('friend-requests', FriendRequestController::class);
});
