<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);


Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth:sanctum');
Route::apiResource('/user', UserController::class)->middleware('auth:sanctum')->only('index');
Route::post('/user/{id}/update', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::middleware('auth.admin')->group(function () {
    Route::apiResource('/admin', AdminController::class);
    Route::get('/admin/deleteUser/{id}', [UserController::class, 'destroy']);
    Route::post('/admin/createUser', [UserController::class, 'store']);
});
