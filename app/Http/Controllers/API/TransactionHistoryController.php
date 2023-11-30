<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionHistory\CreateTransactionHistoryRequest;
use App\Http\Requests\TransactionHistory\UpdateTransactionHistoryRequest;
use App\Http\Resources\TransactionHistory\TransactionHistoryResource;
use App\Models\TransactionHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionHistoryController extends Controller
{
    public function __construct()
    {

    }

    public function index(): AnonymousResourceCollection
    {
        $transactionHistories = TransactionHistory::useFilters()->dynamicPaginate();

        return TransactionHistoryResource::collection($transactionHistories);
    }

    public function store(CreateTransactionHistoryRequest $request): JsonResponse
    {
        $transactionHistory = TransactionHistory::create($request->validated());

        return $this->responseCreated('TransactionHistory created successfully', new TransactionHistoryResource($transactionHistory));
    }

    public function show(TransactionHistory $transactionHistory): JsonResponse
    {
        return $this->responseSuccess(null, new TransactionHistoryResource($transactionHistory));
    }

    public function update(UpdateTransactionHistoryRequest $request, TransactionHistory $transactionHistory): JsonResponse
    {
        $transactionHistory->update($request->validated());

        return $this->responseSuccess('TransactionHistory updated Successfully', new TransactionHistoryResource($transactionHistory));
    }

    public function destroy(TransactionHistory $transactionHistory): JsonResponse
    {
        $transactionHistory->delete();

        return $this->responseDeleted();
    }
}
