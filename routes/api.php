<?php

use App\Http\Controllers\LaunchersController;
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


Route::get('/', function () {
    return "REST Back-end Challenge 20201209 Running";
});
Route::get('/launchers', [LaunchersController::class, 'index']);
Route::get('/launchers/{launchId}', [LaunchersController::class, 'show']);
Route::put('/launchers/{launchId}', [LaunchersController::class, 'update']);
Route::delete('/launchers/{launchId}', [LaunchersController::class, 'destroy']);
