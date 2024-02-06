<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('test', [AuthController::class, 'test']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user_details', [UserController::class, 'getUser']);


    // store 

    Route::post('add-store', [StoreController::class, 'newStore']);
    Route::get('view-store', [StoreController::class, 'getStore']);
});
