<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Essa\APIToolKit\Api\ApiResponse;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    use ApiResponse;

    private $secret;

    private $authorization;

    public function __construct()
    {
        $this->secret = env('FLIP_SECRET_KEY');

        $encoded_auth = base64_encode($this->secret . ":");

        $this->authorization = "Basic $encoded_auth";
    }

    /**
     * Return a success response.
     *
     * @param string|null $title Title of Transaction.
     * @param string|null $type Type of Transaction top_up or pay.
     * @param integer|null $amount amount of transaction.
     *
     */
    public function createBill($title, $type, $amount)
    {
        Log::channel('transaction')->info('Start');

        Log::channel('transaction')->info("Title : $title");

        try {
            $data = [
                'title' => $title,
                'amount' => $amount,
                'type' => 'SINGLE',
                "expired_date" => Carbon::now()->addDay()->format('Y-m-d H:m'),
                'redirect_url' => 'https://farel.com',
                'is_address_required' => 0,
                'is_phone_number_required' => 0
            ];
            Log::channel('transaction')->info("Data Send : " . json_encode($data));

            $response = Http::withHeaders([
                'Authorization' => $this->authorization
            ])->post('https://bigflip.id/big_sandbox_api/v2/pwf/bill', $data);

            $responseData = json_decode($response->body(), true); // Decode JSON response

            Log::channel('transaction')->info("Response : " . $response->body());

            return $responseData; // Return JSON response

        } catch (Exception $th) {
            Log::channel('transaction')->info("Error : " . $th->getMessage());
        }
        Log::channel('transaction')->info("End");
    }
}