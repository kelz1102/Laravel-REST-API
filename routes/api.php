<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('user', 'user');
    Route::post('logout', 'logout')->middleware('auth:api');
});

Route::controller(PostController::class)->middleware("auth:api")->group(function () {
         Route::post('post', 'store');
         Route::put('post/{id}', 'update');
         Route::delete('post/{id}', 'destroy');
         Route::get('posts', 'index');
});


