<?php

use App\Http\Controllers\API\CustomerTransactionController;
use App\Http\Controllers\API\DriverTransactionController;
use App\Http\Controllers\API\TransactionController;
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

// Route::post('/transaction/pay', [\App\Http\Controllers\API\TransactionController::class, 'pay']);
// Route::post('/transaction/top_up', [\App\Http\Controllers\API\TransactionController::class, 'top_up']);

Route::prefix('driver')->group(function () {
    Route::post('saldo', [DriverTransactionController::class, 'saldo'])->name('get-saldo.driver');
    Route::post('top-up', [DriverTransactionController::class, 'top_up'])->name('top-up.driver');
    Route::post('pay', [DriverTransactionController::class, 'pay'])->name('pay.driver');
    Route::post('withdraw', [DriverTransactionController::class, 'withdraw'])->name('withdraw.driver');
    Route::post('history', [DriverTransactionController::class, 'history'])->name('history.driver');
    Route::post('add-bank-account', [DriverTransactionController::class, 'add_bank_account'])->name('add-bank-account.driver');
});

Route::prefix('customer')->group(function () {
    Route::post('saldo', [CustomerTransactionController::class, 'saldo'])->name('get-saldo.customer');
    Route::post('top-up', [CustomerTransactionController::class, 'top_up'])->name('top-up.customer');
    Route::post('pay', [CustomerTransactionController::class, 'pay'])->name('pay.customer');
    Route::post('withdraw', [CustomerTransactionController::class, 'withdraw'])->name('withdraw.customer');
    Route::post('history', [CustomerTransactionController::class, 'history'])->name('history.customer');
    Route::post('add-bank-account', [CustomerTransactionController::class, 'add_bank_account'])->name('add-bank-account.customer');
});

Route::prefix('callback')->group(function () {
    Route::post('accept-payment', [TransactionController::class, 'callback_accept_payment'])->name('accept_payment.callback');
    Route::post('transaction', [TransactionController::class, 'callback_transaksi'])->name('transaction.callback');
    Route::post('inquiry', [TransactionController::class, 'callback_inquiry'])->name('inquiry.callback');
});

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

/*===========================
=           bankAccounts           =
=============================*/

Route::apiResource('/bankAccounts', \App\Http\Controllers\API\BankAccountController::class);

/*=====  End of bankAccounts   ======*/
