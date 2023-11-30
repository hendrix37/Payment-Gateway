<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bank\UpdateBankRequest;
use App\Http\Requests\Bank\CreateBankRequest;
use App\Http\Resources\Bank\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DriverTransactionController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $banks = Bank::useFilters()->dynamicPaginate();

        return BankResource::collection($banks);
    }

    public function store(CreateBankRequest $request): JsonResponse
    {
        $bank = Bank::create($request->validated());

        return $this->responseCreated('Bank created successfully', new BankResource($bank));
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
