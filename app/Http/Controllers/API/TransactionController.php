<?php

namespace App\Http\Controllers\API;

use App\Enums\ActionTypes;
use App\Enums\StatusTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function callback_accept_payment(Request $request)
    {
        $response = request()->data;

        $data = json_decode($response);

        Log::info("accept payment :  $data->id " . json_encode($request->all()));

        DB::beginTransaction();
        try {

            $data_update = [
                'json_callback' => $response,
            ];

            if ($data->status == 'SUCCESSFUL') {
                $data_update['status'] = StatusTypes::SUCCESSFUL;
            } elseif ($data->status == 'CANCELLED') {
                $data_update['status'] = StatusTypes::CANCELLED;
            } elseif ($data->status == 'FAILED') {
                $data_update['status'] = StatusTypes::FAILED;
            }
            
            $bank = Bank::where('code', $data->sender_bank)->first();

            $data_update['bank_id'] = $bank->id;

            $transaction = Transaction::where('code_payment_gateway_relation', $data->bill_link_id)->first();

            if ($transaction) {
                $update = Transaction::where('id', $transaction->id)->update($data_update);

                if ($update) {
                    // Create a new transaction history record
                    TransactionHistory::create([
                        'json_before_value' => json_encode($transaction),
                        'json_after_value' => json_encode($data_update), // Assuming $data_update is the updated data
                        'action' => ActionTypes::UPDATED, // You may need to specify the action type (e.g., update, create, delete)
                        'transaction_id' => $transaction->id,
                        'status_transaction' => $data_update['status'], // Adjust accordingly based on your transaction model
                    ]);
                }
            }

            DB::commit();

            return $this->responseSuccess($update);

        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function callback_transaction(Request $request)
    {
        $response = request()->data;

        $data = json_decode($response);

        Log::info("Transaction ID $data->id : " . json_encode($request->all()));

        DB::beginTransaction();
        try {


            $data_update = [
                'json_callback' => $response,
            ];

            if ($data->status != 'SUCCESSFUL') {
                $data_update['status'] = StatusTypes::SUCCESSFUL;
            } elseif ($data->status != 'CANCELLED') {
                $data_update['status'] = StatusTypes::CANCELLED;
            } elseif ($data->status != 'FAILED') {
                $data_update['status'] = StatusTypes::FAILED;
            }

            $transaction = Transaction::where('code_payment_gateway_relation', $data->id)->first();

            if ($transaction) {
                $update = Transaction::where('id', $transaction->id)->update($data_update);

                if ($update) {
                    // Create a new transaction history record
                    TransactionHistory::create([
                        'json_before_value' => json_encode($transaction),
                        'json_after_value' => json_encode($data_update), // Assuming $data_update is the updated data
                        'action' => ActionTypes::UPDATED, // You may need to specify the action type (e.g., update, create, delete)
                        'transaction_id' => $transaction->id,
                        'status_transaction' => $data_update['status'], // Adjust accordingly based on your transaction model
                    ]);
                }
            }

            DB::commit();

            return $this->responseSuccess($update);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
    }

    public function callback_inquiry(Request $request)
    {
        $response = request()->data;

        $data = json_decode($response);

        Log::info("inquiry : $data->account_number | $data->status" . json_encode($request->all()));

        DB::beginTransaction();

        try {

            $data_update = [
                'json_callback' => $response,
            ];

            if ($data->status != 'SUCCESSFUL') {
                $data_update['status'] = StatusTypes::SUCCESSFUL;
            } elseif ($data->status != 'CANCELLED') {
                $data_update['status'] = StatusTypes::CANCELLED;
            } elseif ($data->status != 'FAILED') {
                $data_update['status'] = StatusTypes::FAILED;
            }

            $transaction = Transaction::where('code_payment_gateway_relation', $data->id)->first();

            if ($transaction) {
                $update = Transaction::where('id', $transaction->id)->update($data_update);

                if ($update) {
                    // Create a new transaction history record
                    TransactionHistory::create([
                        'json_before_value' => json_encode($transaction),
                        'json_after_value' => json_encode($data_update), // Assuming $data_update is the updated data
                        'action' => ActionTypes::UPDATED, // You may need to specify the action type (e.g., update, create, delete)
                        'transaction_id' => $transaction->id,
                        'status_transaction' => $data_update['status'], // Adjust accordingly based on your transaction model
                    ]);
                }
            }

            DB::commit();

            return $this->responseSuccess($update);
        } catch (Exception $th) {
            //throw $th;
            DB::rollBack();
        }
    }
}
