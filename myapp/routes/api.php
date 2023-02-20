<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

// route with controller
Route::get('/tutorials', [DashboardController::class, 'api']);

// route with controller
Route::get('/employees', [HomeController::class, 'getEmployees']);

// route with controller
Route::post('/projects', [HomeController::class, 'storeProject']);
// route with controller
Route::get('/projects', [HomeController::class, 'getProjects']);
// route with controller delete
Route::delete('/projects/{id}', [HomeController::class, 'deleteProject']);
