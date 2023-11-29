<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $transactions = Transaction::useFilters()->dynamicPaginate();

        return TransactionResource::collection($transactions);
    }

    public function store(CreateTransactionRequest $request): JsonResponse
    {
        $transaction = Transaction::create($request->validated());

        return $this->responseCreated('Transaction created successfully', new TransactionResource($transaction));
    }

    public function show(Transaction $transaction): JsonResponse
    {
        return $this->responseSuccess(null, new TransactionResource($transaction));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $transaction->update($request->validated());

        return $this->responseSuccess('Transaction updated Successfully', new TransactionResource($transaction));
    }

    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return $this->responseDeleted();
    }

    public function pay(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $transaction_count = Transaction::count() + 1;

            $transaction_count_today = DB::table('transactions')
                ->whereDate('created_at', now()->toDateString())
                ->count() + 1;

            $type = 'pay';

            $title = "PAY/$transaction_count/$transaction_count_today/" . Carbon::now()->format('YmdHis');

            $amount = $request->doku;
            $identity_owner = $request->idowner;
            $identity_driver = $request->idwork;
            $biaya_penanganan = $request->bPenganan;
            $total_amount = $amount + $biaya_penanganan;


            $saldo = DB::table('transactions')
                ->where('identity_owner', $identity_owner)
                ->selectRaw('SUM(CASE WHEN type = "top_up" THEN amount ELSE -amount END) as saldo')
                ->value('saldo');

            $flip = new Controller;

            $response_flip = $flip->createBill($title, $type, $total_amount);

            $data = [
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

            Transaction::create($data);

            DB::commit();

            $saldo = DB::table('transactions')
                ->where('identity_owner', $identity_owner)
                ->selectRaw('SUM(CASE WHEN type = "top_up" THEN amount ELSE -amount END) as saldo')
                ->value('saldo');

            $data = [
                "amount" => $amount,
                "saldo" => $saldo
            ];
            return $this->responseSuccess('Pay Transaction Success', $data);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'Pay Transaction Error');
        }
    }

    public function top_up(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $transaction_count = Transaction::count() + 1;

            $transaction_count_today = DB::table('transactions')
                ->whereDate('created_at', now()->toDateString())
                ->count() + 1;

            $type = 'top_up';

            $title = "TOPUP/$transaction_count/$transaction_count_today/" . Carbon::now()->format('YmdHis');

            $amount = $request->doku;
            $identity_owner = $request->idowner;
            $identity_driver = $request->idwork;
            $biaya_penanganan = $request->bPenganan;
            $total_amount = $amount + $biaya_penanganan;
            $flip = new Controller;

            $response_flip = $flip->createBill($title, $type, $total_amount);

            $data = [
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

            Transaction::create($data);

            DB::commit();


            $saldo = DB::table('transactions')
                ->where('identity_owner', $identity_owner)
                ->selectRaw('SUM(CASE WHEN type = "top_up" THEN amount ELSE -amount END) as saldo')
                ->value('saldo');

            $data = [
                "amount" => $amount,
                "saldo" => $saldo
            ];
            return $this->responseSuccess('Pay Transaction Success', $data);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();

            return $this->responseBadRequest($th->getMessage(), 'Pay Transaction Error');
        }
    }
}
