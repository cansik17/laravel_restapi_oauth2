<?php

use App\Http\Controllers\Api\ArticleController;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');


// List articles
Route::get('articles', [ArticleController::class, 'index']);

// List single article
Route::get('articles/{id}', [ArticleController::class, 'show']);

// Create new article
Route::post('articles', [ArticleController::class, 'store']);

// Update article
Route::put('articles/{id}', [ArticleController::class, 'update']);

// Delete article
Route::delete('articles/{id}', [ArticleController::class, 'destroy']);
