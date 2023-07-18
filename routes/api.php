<?php

use App\Http\Controllers\AuthControlller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// posts routes
Route::group(['middleware' => ['auth:sanctum']], function () {
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthControlller::class, 'logout']);

    });

Route::post('/signup', [AuthControlller::class, 'sign_up']);
Route::post('/login', [AuthControlller::class, 'login']);

