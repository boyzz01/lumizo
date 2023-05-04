<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SponsorController;
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

Route::get('/login', [LoginController::class,'index'] )->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'login'] )->name('admin.login.submit');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::get('/', [DashboardController::class,'index'] )->name('home')->middleware('auth');

Route::get('/verify/{token}', [RegisterController::class,'verif'] )->name('verify');


//crud
Route::get('/sponsor', [SponsorController::class,'index'] )->name('sponsor')->middleware('auth');
Route::post('/sponsor-save', [SponsorController::class,'save'] )->name('sponsor.save')->middleware('auth');
