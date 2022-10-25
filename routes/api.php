<?php

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
Route::post("users", [UserController::class, "create"]);

Route::put("users/{id}", [UserController::class, "update"]);

Route::get("users/{id}", [UserController::class, "findOne"]);

Route::get("users", [UserController::class, "findAll"]);

