<?php

use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\TransferController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Traits\PaymentGatewayFlip;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    $string = 'hendrix' . env('APP_KEY');
    $base64_encode = base64_encode($string);
    $base64_decode = base64_decode($base64_encode);
    dd($base64_encode, $base64_decode);
});
Route::get('/', [TransactionController::class, 'test']);


// Route::prefix('transfer')->group(function () {
//     Route::get('/', [TransferController::class, 'index'])->name('transfer.index');
//     Route::get('/create', [TransferController::class, 'create'])->name('transfer.create');
//     Route::post('/create', [TransferController::class, 'store'])->name('transfer.store');
//     Route::post('/callback', [TransferController::class, 'callback']);
//     Route::get('/bank', [TransferController::class, 'bank'])->name('transfer.bank');
//     Route::get('/inquiry', [TransferController::class, 'inquiry'])->name('transfer.inquiry');
//     Route::post('/inquiry', [TransferController::class, 'storeInquiry'])->name('transfer.storeInquiry');
// });
