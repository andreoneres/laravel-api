<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

Route::post("login", [AuthController::class, "login"]);

Route::controller(UserController::class)
    ->middleware("auth:api")
    ->group(function () {
        Route::post("users", "create");
        Route::put("users/{id}", "update");
        Route::get("users/{id}", "findOne");
        Route::get("users", "findAll");
});

