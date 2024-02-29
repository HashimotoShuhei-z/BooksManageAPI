<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
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
Route::get('/books',[BookController::class,'index']);
Route::get('/authors',[AuthorController::class,'index']);

Route::post('/books',[BookController::class,'store']);
Route::post('/authors',[AuthorController::class,'store']);

Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

Route::post('/books/{id}', [BookController::class, 'destroy']);
Route::post('/authors/{id}', [AuthorController::class, 'destroy']);

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */
