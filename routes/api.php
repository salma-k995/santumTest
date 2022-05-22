<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;

use App\Http\Controllers\AuthController;
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


Route::group(['prefix' => 'visitor'], function () {
  Route::get('me', [VisitorController::class, 'me'])->middleware('auth:sanctum', 'abilities:visitors');
});

Route::group(['prefix' => 'admin'], function () {
  Route::delete('delete/{id}', [AdminController::class, 'delete'])->middleware('auth:sanctum' ,'abilities:admins');
  Route::get('retrieve', [AdminController::class, 'retrieve'])->middleware('auth:sanctum', 'abilities:admins');
});

Route::group(['prefix' => 'auth'], function () {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);
  Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
