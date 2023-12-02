<?php

namespace App\Http\Controllers\API;

use App\Enums\StatusBank;
use App\Enums\StatusTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\UpdateBankAccountRequest;
use App\Http\Requests\BankAccount\CreateBankAccountRequest;
use App\Http\Requests\BankAccount\ListBankAccountRequest;
use App\Http\Resources\BankAccount\BankAccountResource;
use App\Models\Bank;
use App\Models\BankAccount;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BankAccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(ListBankAccountRequest $request): AnonymousResourceCollection
    {
        if (!empty($request->idowner)) {
            $bankAccounts = BankAccount::useFilters()->dynamicPaginate();
        } else {
            $bankAccounts = BankAccount::useFilters()->dynamicPaginate();
        }

        return BankAccountResource::collection($bankAccounts);
    }

    public function store(CreateBankAccountRequest $request): JsonResponse
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

        // Request Bank Account Inquiry

        $dataRequest = Http::withHeaders([
            'Authorization' => $this->getAuthorization(),
        ])->post(config('flip.base_url_v2') . '/disbursement/bank-account-inquiry', [
            'bank_code' => $request->bank_code,
            'account_number' => $request->account_number,
        ]);

        $response = $dataRequest->object();

        Log::info('response bank check : ' . json_encode($response));

        $bank_collect = Bank::where('code', $request->bank_code)->first();

        $status = null;
        foreach (StatusTypes::toArray() as $key => $value) {


            if ($key == $response->status) {
                $status = $value;
            }
        }

        $data = [
            'bank_id' => $bank_collect->id,
            'account_number' => $request->account_number,
            'identity_owner' => $request->identity_owner,
            'status' => $status,
        ];

        DB::beginTransaction();
        try {

            $bankAccount = BankAccount::create($data);

            DB::commit();

            return $this->responseCreated('Bank Account created successfully', new BankAccountResource($bankAccount));
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'BankAccount created Error');
        }
    }

    public function show(BankAccount $bankAccount): JsonResponse
    {
        return $this->responseSuccess(null, new BankAccountResource($bankAccount));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount): JsonResponse
    {
        $bankAccount->update($request->validated());

        return $this->responseSuccess('BankAccount updated Successfully', new BankAccountResource($bankAccount));
    }

    public function destroy(BankAccount $bankAccount): JsonResponse
    {
        $bankAccount->delete();

        return $this->responseDeleted();
    }
}
