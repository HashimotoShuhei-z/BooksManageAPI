<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::post('user/login', [LoginController::class, 'userLogin']);

Route::post('admin/login', [LoginController::class, 'adminLogin']);

//2つのグループでエンドポイントが被るとエラー出る
//<対処法>被ってるEPをまとめて記述するorエンドポイントを分ける

Route::prefix('admin')->middleware('auth:sanctum', 'abilities:admin')->group(function () {

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/authors', [AuthorController::class, 'index']);

    Route::post('/books', [BookController::class, 'store']);
    Route::post('/authors', [AuthorController::class, 'store']);

    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);

    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);

    Route::post('/books/{id}', [BookController::class, 'destroy']);
    Route::post('/authors/{id}', [AuthorController::class, 'destroy']);

});

Route::prefix('user')->middleware('auth:sanctum', 'abilities:user')->group(function () {

    Route::get('/user', [LoginController::class, 'user']);

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/authors', [AuthorController::class, 'index']);

    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);

});
