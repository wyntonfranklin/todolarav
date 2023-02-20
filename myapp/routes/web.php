<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
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

// dashboard router function with controller for customers
Route::get('/customers',[CustomersController::class,'index'])->name('customers.index');

// dashboard router function with controller multiple put, get
Route::match(['get','post'],'/customers/create',[CustomersController::class,'create'])->name('customers.create');

// dashboard router function with controller store
Route::post('/customers/store',[CustomersController::class,'store']);


// dashboard router function with controller employees
Route::get('/employees',[EmployeesController::class,'index'])->name('employees.index');

// dashboard router create
Route::get('/employees/create',[EmployeesController::class,'create'])->name('employees.create');

// dashboard router function with controller employee store
Route::post('/employees/store',[EmployeesController::class,'store'])->name('employees.store');
