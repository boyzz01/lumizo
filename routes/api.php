<?php

use App\Http\Controllers\ApiController;
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

Route::get('sponsor', [ApiController::class, 'getSponsor']);
Route::get('banner', [ApiController::class, 'getBanner']);
Route::get('artikel', [ApiController::class, 'getArtikel']);
Route::get('artikel/{id}', [ApiController::class, 'getDetailArtikel']);

Route::get('katalog/{id}', [ApiController::class, 'getDetailKatalog']);
Route::get('katalog/kategori/{jenis}', [ApiController::class, 'getKatalogbyJenis']);

Route::get('katalog', [ApiController::class, 'getKatalog']);



Route::post('/login', [ApiController::class, 'check_user']);
Route::post('/cek_verif', [ApiController::class, 'check_verif']);
Route::post('/register', [ApiController::class, 'addUser']);