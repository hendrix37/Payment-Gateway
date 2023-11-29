<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*===========================
=           banks           =
=============================*/

Route::apiResource('/banks', \App\Http\Controllers\API\BankController::class);

/*=====  End of banks   ======*/

/*===========================
=           transactions           =
=============================*/

Route::apiResource('/transactions', \App\Http\Controllers\API\TransactionController::class);
Route::post('/transaction/pay', [\App\Http\Controllers\API\TransactionController::class, 'pay']);
Route::post('/transaction/top_up', [\App\Http\Controllers\API\TransactionController::class, 'top_up']);

/*=====  End of transactions   ======*/

/*===========================
=           transactionHistories           =
=============================*/

Route::apiResource('/transactionHistories', \App\Http\Controllers\API\TransactionHistoryController::class);

/*=====  End of transactionHistories   ======*/

/*===========================
=           withdraws           =
=============================*/

Route::apiResource('/withdraws', \App\Http\Controllers\API\WithdrawController::class);

/*=====  End of withdraws   ======*/
