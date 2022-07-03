<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
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



Route::controller(EmployeesController::class)->group(function () {
    Route::get('/employe', 'index');
    Route::get('/employe/{id}', 'show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/employe', 'store');
        Route::put('/employe/{id}', 'update');
        Route::delete('/employe/{id}', 'destroy');
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

//authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
