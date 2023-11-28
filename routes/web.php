<?php

use App\Http\Controllers\TransferController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {

    $secret = 'JDJ5JDEzJERyWHJTR0VNWnFJSDRVWlV5Q3hoL3VjOGRneGtVV0p3ZTgvUXVFMDMxUEs5MWQvUE9nRXlD';
    $encoded_auth = base64_encode($secret . ":");
    // dd(Carbon::now()->addDay()->format('Y-m-d H:i'));
    $data = [
        'title' => 'xxxxx',
        'amount' => 10000,
        'type' => 'SINGLE',
        // "expired_date" => "2023-11-28 13:50",
        "expired_date" => Carbon::now()->addDay()->format('Y-m-d H:m'),
        'redirect_url' => 'https://farel.com',
        'is_address_required' => 0,
        'is_phone_number_required' => 0
    ];
    $response = Http::withHeaders([
        // 'Content-Type' => 'application/x-www-form-urlencoded',
        'Authorization' => "Basic $encoded_auth"
    ])->post('https://bigflip.id/big_sandbox_api/v2/pwf/bill', $data);

    dd(json_decode($response->body()));
});


Route::prefix('transfer')->group(function () {
    Route::get('/', [TransferController::class, 'index'])->name('transfer.index');
    Route::get('/create', [TransferController::class, 'create'])->name('transfer.create');
    Route::post('/create', [TransferController::class, 'store'])->name('transfer.store');
    Route::post('/callback', [TransferController::class, 'callback']);
    Route::get('/bank', [TransferController::class, 'bank'])->name('transfer.bank');
    Route::get('/inquiry', [TransferController::class, 'inquiry'])->name('transfer.inquiry');
    Route::post('/inquiry', [TransferController::class, 'storeInquiry'])->name('transfer.storeInquiry');
});
