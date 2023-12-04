<?php

namespace App\Http\Controllers\API;

use App\Enums\BankStatusTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bank\CreateBankRequest;
use App\Http\Requests\Bank\UpdateBankRequest;
use App\Http\Resources\Bank\BankResource;
use App\Models\Bank;
use Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BankController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): AnonymousResourceCollection
    {
        $banks = Bank::where('status', BankStatusTypes::OPERATIONAL)
            ->useFilters()
            ->dynamicPaginate();

        return BankResource::collection($banks);
    }

    public function store(CreateBankRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        // Modify the 'code' attribute, e.g., by adding a prefix
        $requestBankInfo = Http::withHeaders([
            'Authorization' => $this->authorization,
        ])->get(config('flip.base_url_v2').'/general/banks?code='.$validatedData['code']);

        $bank_response = $requestBankInfo->object();

        if ($bank_response->message != 'BANK_NOT_FOUND') {

            $validatedData['status'] = 'MOD_'.$validatedData['code'];
            $validatedData['queue'] = 'MOD_'.$validatedData['code'];
            $validatedData['fee'] = 'MOD_'.$validatedData['code'];

            $bank = Bank::create($request->validated());

            return $this->responseCreated('Bank created successfully', new BankResource($bank));
        } else {
            return $this->responseBadRequest($bank_response->message, "No valid response received for Bank ID: {$validatedData['code']}");
        }
    }

    public function show(Bank $bank): JsonResponse
    {
        return $this->responseSuccess(null, new BankResource($bank));
    }

    public function update(UpdateBankRequest $request, Bank $bank): JsonResponse
    {
        $bank->update($request->validated());

        return $this->responseSuccess('Bank updated Successfully', new BankResource($bank));
    }

    public function destroy(Bank $bank): JsonResponse
    {
        $bank->delete();

        return $this->responseDeleted();
    }
}
