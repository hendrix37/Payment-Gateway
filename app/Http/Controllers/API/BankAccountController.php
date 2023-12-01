<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\UpdateBankAccountRequest;
use App\Http\Requests\BankAccount\CreateBankAccountRequest;
use App\Http\Resources\BankAccount\BankAccountResource;
use App\Models\BankAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BankAccountController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $bankAccounts = BankAccount::useFilters()->dynamicPaginate();

        return BankAccountResource::collection($bankAccounts);
    }

    public function store(CreateBankAccountRequest $request): JsonResponse
    {
        $bankAccount = BankAccount::create($request->validated());

        return $this->responseCreated('BankAccount created successfully', new BankAccountResource($bankAccount));
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
