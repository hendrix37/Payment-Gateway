<?php

namespace App\Http\Controllers\API;

use App\Enums\ActionTypes;
use App\Enums\StatusBank;
use App\Enums\StatusTypes;
use App\Enums\TransactionTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\CreateBankAccountRequest;
use App\Http\Requests\CustomerTransaction\SaldoRequest;
use App\Http\Requests\CustomerTransaction\TopUpRequest;
use App\Http\Resources\BankAccount\BankAccountResource;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Essa\APIToolKit\Filters\DTO\FiltersDTO;
use Exception;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class CustomerTransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saldo(SaldoRequest $request)
    {
        $saldo = Transaction::saldoCustomer($request->idowner);

        $data = [
            'saldo' => $saldo,
            'idowner' => $request->idowner,
        ];

        return $this->responseSuccess('Get Saldo', $data);
    }

    public function top_up(TopUpRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $transaction_count = Transaction::count() + 1;

            $transaction_count_today = DB::table('transactions')
                ->whereDate('created_at', now()->toDateString())
                ->count() + 1;

            $type = TransactionTypes::TOPUP;

            $title = "$type/$transaction_count/$transaction_count_today/" . Carbon::now()->format('YmdHis');

            $amount = $request->doku;
            $identity_owner = $request->idowner;
            $identity_driver = $request->idwork;
            $biaya_penanganan = $request->bPenganan;
            $total_amount = $amount + $biaya_penanganan;

            $flip = new Controller;

            $response_flip = $flip->createBill($title, $total_amount);

            $data = [
                'transaction_number' => $title,
                'json_request' => json_encode($request->all()),
                'json_response_payment_gateway' => json_encode($response_flip),
                'payement_gateway' => 'flip',
                'amount' => $amount,
                'additional_cost' => $biaya_penanganan,
                'expired_date' => Carbon::now()->addDay(),
                'link_payment' => $response_flip['link_url'],
                'identity_owner' => $identity_owner,
                'identity_driver' => $identity_driver,
                'status' => 'PENDING',
                'type' => $type,
                'code_payment_gateway_relation' => $response_flip['link_id'],
            ];

            $transaction = Transaction::create($data);

            TransactionHistory::create([
                'json_before_value' => null,
                'json_after_value' => json_encode($transaction), // Assuming $data_update is the updated data
                'action' => ActionTypes::CREATED, // You may need to specify the action type (e.g., update, create, delete)
                'transaction_id' => $transaction->id,
                'status_transaction' => $data['status'], // Adjust accordingly based on your transaction model
            ]);

            DB::commit();

            $saldo = Transaction::saldoCustomer($identity_owner);

            $data = [
                'link_payment' => $response_flip['link_url'],
                'amount' => $amount,
                'saldo' => $saldo,
            ];

            return $this->responseSuccess('Top Up Transaction Success', $data);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'Top Up Transaction Error');
        }
    }

    public function pay(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $transaction_count = Transaction::count() + 1;

            $transaction_count_today = DB::table('transactions')
                ->whereDate('created_at', now()->toDateString())
                ->count() + 1;

            $type = TransactionTypes::PAY;

            $title = "$type/$transaction_count/$transaction_count_today/" . Carbon::now()->format('YmdHis');

            $amount = $request->doku;
            $identity_owner = $request->idowner;
            $identity_driver = $request->idwork;
            $biaya_penanganan = $request->bPenganan;
            $total_amount = $amount + $biaya_penanganan;

            $data = [
                'transaction_number' => $title,
                'json_request' => json_encode($request->all()),
                'payement_gateway' => 'self',
                'amount' => $amount,
                'additional_cost' => $biaya_penanganan,
                'expired_date' => Carbon::now()->addDay(),
                'identity_owner' => $identity_owner,
                'identity_driver' => $identity_driver,
                'status' => StatusTypes::SUCCESSFUL,
                'type' => $type,
            ];

            $transaction = Transaction::create($data);

            TransactionHistory::create([
                'json_before_value' => null,
                'json_after_value' => json_encode($transaction), // Assuming $data_update is the updated data
                'action' => ActionTypes::CREATED, // You may need to specify the action type (e.g., update, create, delete)
                'transaction_id' => $transaction->id,
                'status_transaction' => $data['status'], // Adjust accordingly based on your transaction model
            ]);

            DB::commit();

            $saldo = Transaction::saldoCustomer($identity_owner);

            $data = [
                'amount' => $amount,
                'saldo' => $saldo,
            ];

            return $this->responseSuccess('Pay Transaction Success', $data);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'Pay Transaction Error');
        }
    }

    // public function withdraw(Request $request): JsonResponse
    // {
    //     DB::beginTransaction();
    //     try {

    //         $transaction_count = Transaction::count() + 1;

    //         $transaction_count_today = DB::table('transactions')
    //             ->whereDate('created_at', now()->toDateString())
    //             ->count() + 1;

    //         $type = TransactionTypes::PAY;

    //         $title = "$type/$transaction_count/$transaction_count_today/" . Carbon::now()->format('YmdHis');

    //         $amount = $request->doku;
    //         $identity_owner = $request->idowner;
    //         $identity_driver = $request->idwork;
    //         $biaya_penanganan = $request->bPenganan;
    //         $total_amount = $amount + $biaya_penanganan;

    //         $flip = new Controller;

    //         $response_flip = $flip->createBill($title, $total_amount);

    //         $data = [
    //             'transaction_number' => $title,
    //             'json_request' => json_encode($request->all()),
    //             'payement_gateway' => 'self',
    //             'amount' => $amount,
    //             'additional_cost' => $biaya_penanganan,
    //             'expired_date' => Carbon::now()->addDay(),
    //             'identity_owner' => $identity_owner,
    //             'identity_driver' => $identity_driver,
    //             'status' => StatusTypes::SUCCESSFUL,
    //             'type' => $type,
    //         ];

    //         $transaction = Transaction::create($data);

    //         TransactionHistory::create([
    //             'json_before_value' => null,
    //             'json_after_value' => json_encode($transaction), // Assuming $data_update is the updated data
    //             'action' => ActionTypes::CREATED, // You may need to specify the action type (e.g., update, create, delete)
    //             'transaction_id' => $transaction->id,
    //             'status_transaction' => $data['status'], // Adjust accordingly based on your transaction model
    //         ]);

    //         DB::commit();

    //         $saldo = Transaction::saldoCustomer($identity_owner);

    //         $data = [
    //             "amount" => $amount,
    //             "saldo" => $saldo
    //         ];

    //         return $this->responseSuccess('Pay Transaction Success', $data);
    //     } catch (Exception $th) {
    //         //throw $th;
    //         DB::rollBack();

    //         return $this->responseBadRequest($th->getMessage(), 'Pay Transaction Error');
    //     }
    // }
    public function history(Request $request)
    {
        // $transaction = Transaction::with('histories')
        //     ->where('identity_owner', $request->idowner)
        //     ->get();
        $filtersDTO = new FiltersDTO(
            sorts: '-created_at', // Sort by created_at in ascending order
            filters: ['name' => 'Car'], // Filter by name
            includes: ['unitOccupant', 'by'], // Include sluggableTestModel relation
            search: '2023' // Search for the year 2023
        );

        // Pass the custom FiltersDTO to the useFilters scope method
        $records = Transaction::with([
            'histories',
        ])
            ->where('identity_owner', $request->idowner)
            ->useFilters(filteredDTO: $filtersDTO)
            ->get();

        return TransactionResource::collection($records);
    }

    // public function add_bank_account(): JsonResponse
    // {
    //     return $this->responseSuccess();
    // }

    public function add_bank_account(CreateBankAccountRequest $request): JsonResponse
    {
        $check = BankAccount::where([
            ['account_number', $request->account_number],
            ['identity_owner', $request->identity_owner],
            ['status', StatusBank::SUCCESS],
        ])->exists();

        if ($check) {
            return $this->responseBadRequest(null, 'Bank Account has been created');
        }

        Log::info('start Check account Number');
        Log::info('request data : ' . json_encode($request->all()));
        // Request Bank Info
        $requestBankInfo = Http::withHeaders([
            'Authorization' => $this->getAuthorization(),
            // 'Content-Type' => 'application/x-www-form-urlencoded',
        ])->get(config('flip.base_url_v2') . '/general/banks?code=' . $request->bank_code);

        $bank = $requestBankInfo->object();

        Log::info('requestBankInfo : ' . json_encode($bank));

        if ($bank[0]->status != 'OPERATIONAL') {
            return back()->withInput()->with('error', 'SORRY, BANK ' . $bank[0]->status);
        }

        $bank_collect = Bank::where('code', $request->bank_code)->first();

        $data = [
            'bank_id' => $bank_collect->id,
            'account_number' => $request->account_number,
            'identity_owner' => $request->identity_owner,
            'status' => StatusBank::PENDING,
        ];

        DB::beginTransaction();
        try {

            $bankAccount = BankAccount::create($data);

            // Request Bank Account Inquiry
            $dataRequest = Http::withHeaders([
                'Authorization' => $this->getAuthorization(),
            ])->post(config('flip.base_url_v2') . '/disbursement/bank-account-inquiry', [
                'bank_code' => $request->bank_code,
                'account_number' => $request->account_number,
                'inquiry_key' => $bankAccount->uuid,
            ]);

            $response = $dataRequest->object();

            Log::info('response bank check : ' . json_encode($response));

            DB::commit();

            return $this->responseCreated('Bank Account created successfully', new BankAccountResource($bankAccount));
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'BankAccount created Error');
        }
    }
}
