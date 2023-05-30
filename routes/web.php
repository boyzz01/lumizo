<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoCatalogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LunnizomController;
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

Route::get('/', [DashboardController::class,'index'] )->name('home')->middleware('admin');

Route::get('/verify/{token}', [RegisterController::class,'verif'] )->name('verify');


//crud
Route::get('/sponsor', [SponsorController::class,'index'] )->name('sponsor')->middleware('admin');
Route::post('/sponsor-save', [SponsorController::class,'save'] )->name('sponsor.save')->middleware('admin');

Route::get('/articles', [ArticlesController::class, 'index'])->name('artikel')->middleware('admin');;
Route::post('/articles', [ArticlesController::class, 'store'])->name('artikel.store')->middleware('admin');
Route::resource('banners', BannerController::class)->middleware('admin');
Route::resource('lunnizom', LunnizomController::class)->middleware('admin');
Route::post('catalog/foto', [FotoCatalogController::class, 'store'])->name('catalog.storeFoto');
Route::get('catalog/foto/{id}', [FotoCatalogController::class, 'show'])->name('catalog.showFoto');
Route::delete('catalog/foto/{id}', [FotoCatalogController::class, 'destroy'])->name('catalog.destroyFoto');
