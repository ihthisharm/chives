<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ItemController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::resource('/payslips', PayslipController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/customers', CustomerController::class);
Route::resource('/tables', TableController::class);
Route::resource('/items', ItemController::class);

Route::put('/users/{user}/fire', [UserController::class, 'fire'])->name('fire');
Route::get('/users/{user}/payslips', [UserController::class, 'payslips'])->name('payslips');
Route::put('/customers/{customer}/clear', [CustomerController::class, 'clear'])->name('clear');
