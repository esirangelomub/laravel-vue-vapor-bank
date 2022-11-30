<?php

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

Route::group(['prefix' => 'v1'], function()
{
    Route::post('token', [\App\Http\Controllers\AuthController::class, 'token']);
    Route::post('user', [\App\Http\Controllers\UserController::class, 'store']);
    Route::post('account', [\App\Http\Controllers\AccountController::class, 'store']);
    Route::resource('user', \App\Http\Controllers\UserController::class)
        ->except(['store'])
        ->middleware(['auth:sanctum', 'ability:customer-all, admin-all']);
    Route::resource('account', \App\Http\Controllers\AccountController::class)
        ->except(['store'])
        ->middleware(['auth:sanctum', 'ability:customer-all, admin-all']);
    Route::resource('income', \App\Http\Controllers\IncomeController::class)
        ->middleware(['auth:sanctum', 'ability:customer-all, admin-all']);
    Route::resource('expense', \App\Http\Controllers\ExpenseController::class)
        ->middleware(['auth:sanctum', 'ability:customer-all, admin-all']);
    Route::post('upload', [\App\Http\Controllers\FileManagerController::class, 'upload'])
        ->middleware(['auth:sanctum', 'ability:customer-all, admin-all']);
});
