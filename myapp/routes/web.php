<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// dashboard router function with controller
Route::get('/dashboard',[DashboardController::class,'index']);

// dashboard router function with controller
Route::get('/dashboard/add',[DashboardController::class,'add']);

// dashboard router function with controller
Route::get('/dashboard/tutorials',[DashboardController::class,'tutorials']);

// dashboard router function with controller
//Route::get('/dashboard/tutorials/{id}',[DashboardController::class,'view'])->name('tutorials.view');

// dashboard router function with controller
Route::get('/dashboard/table',[DashboardController::class,'table']);

// dashboard router function with controller
Route::get('/dashboard/api',[DashboardController::class,'view']);


