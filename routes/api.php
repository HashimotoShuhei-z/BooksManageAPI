<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
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

Route::post('/login', [LoginController::class, 'index'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    //Tokenが間違っていた場合の処理はどこに書く？
    Route::get('/user', [LoginController::class, 'user']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */
