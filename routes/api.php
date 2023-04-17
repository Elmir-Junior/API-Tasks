<?php

use App\Http\Controllers\Api\ProfileControlller;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Auth\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [ProfileControlller::class, 'show']);
    Route::put('/profile', [ProfileControlller::class, 'update']);

    Route::apiResources([
        'tasks' => TasksController::class,
    ]);
});
