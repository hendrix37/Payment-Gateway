<?php

namespace App\Console\Commands;

use App\Enums\BankStatusTypes;
use App\Models\Bank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckBankStatus extends Command
{
    protected $signature = 'app:check-bank-status';

    protected $description = 'Check and update bank statuses, fees, and queues from an external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $secret = env('FLIP_SECRET_KEY');
            $authorization = 'Basic ' . base64_encode($secret . ':');

            foreach (Bank::all() as $bank) {
                // Request Bank Info
                $requestBankInfo = Http::withHeaders([
                    'Authorization' => $authorization,
                ])->get(config('flip.base_url_v2') . '/general/banks?code=' . $bank->code);

                $bank_response = $requestBankInfo->object();

                if (!empty($bank_response) && isset($bank_response[0])) {
                    $statusKey = $bank_response[0]->status;

                    // Check if the status key exists in the enum
                    if (BankStatusTypes::isValid($statusKey)) {
                        $bank->update([
                            'status' => BankStatusTypes::getValue($statusKey),
                            'fee' => $bank_response[0]->fee,
                            'queue' => $bank_response[0]->queue,
                        ]);
                        $message = "Updated Status: {$bank->status}, Fee: {$bank->fee}, Queue: {$bank->queue}--- Bank Name: {$bank->name}";

                        Log::notice($message);

                        $this->info($message);
                    } else {
                        $this->error("Invalid bank status key: $statusKey for Bank ID: {$bank->id}");
                    }
                } else {
                    $this->error("No valid response received for Bank ID: {$bank->id}");
                }
            }

            $this->info('Bank statuses, fees, and queues updated successfully.');
        } catch (\Exception $e) {
            Log::error("Error updating bank statuses, fees, and queues: {$e->getMessage()}");
            $this->error('An error occurred while updating bank statuses, fees, and queues.');
        }
    }
}
