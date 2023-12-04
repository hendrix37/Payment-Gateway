<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $secret = env('FLIP_SECRET_KEY');

        $encoded_auth = base64_encode($secret.':');

        $authorization = "Basic $encoded_auth";

        $requestBankInfo = Http::withHeaders([
            'Authorization' => $authorization,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->get(config('flip.base_url_v2').'/general/banks');

        $banks = $requestBankInfo->object();
        foreach ($banks as $key => $bank) {
            Bank::factory()->create([
                'name' => $bank->name,
                'code' => $bank->bank_code,
                'fee' => $bank->fee,
                'queue' => $bank->queue,
                'status' => $bank->status,
            ]);
        }
    }
}
