<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;

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

Route::post('register', [AuthorController::class, 'register']);
Route::post('login', [AuthorController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function() {

    Route::get('profile', [AuthorController::class, 'profile']);
    Route::get('logout', [AuthorController::class, 'logout']);

    Route::post('create/book', [BookController::class, 'createBook']);
    Route::get('list/books', [BookController::class, 'listBooks']);
    Route::get('single/book/{id}', [BookController::class, 'singleBook']);
    Route::post('update/book/{id}', [BookController::class, 'updateBook']);
    Route::get('delete/book/{id}', [BookController::class, 'deleteBook']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
