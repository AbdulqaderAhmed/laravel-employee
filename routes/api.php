<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(EmployeesController::class)->group(function () {
    Route::get('/employe', 'index');
    Route::post('/employe', 'store');
    Route::get('/employe/{id}', 'show');
    Route::put('/employe/{id}', 'update');
    Route::delete('/employe/{id}', 'destroy');
});
