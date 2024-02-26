<?php

/* use App\Http\Controllers\Auth\AuthController; */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\SkateController;

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

Route::resource('teams', TeamController::class)
    ->only(['index','store', 'show','update','destroy']);

Route::resource('skates', SkateController::class)
    ->only(['index','store', 'show','update','destroy']);

    /* 
Route::post('register', [AuthController::class, 'register']);
 */