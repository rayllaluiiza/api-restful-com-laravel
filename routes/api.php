<?php

use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ResumeController;
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

Route::apiResource('/receitas', RevenueController::class);
Route::get('/receitas/{ano}/{mes}', [RevenueController::class, 'listingByMonth']);

Route::apiResource('/despesas', ExpenseController::class);
Route::get('/despesas/{ano}/{mes}', [ExpenseController::class, 'listingByMonth']);

Route::get('/resumo/{ano}/{mes}', [ResumeController::class, 'showResume']);
