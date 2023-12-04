<?php

namespace Database\Factories;

use App\Enums\StatusBank;
use App\Enums\TransactionTypes;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawFactory extends Factory
{
    public function definition(): array
    {
        $bank_account = BankAccount::has('bank')->where('status', StatusBank::SUCCESS)->inRandomOrder()->first();
        $transaction = Transaction::where('type', TransactionTypes::WITHDRAW)->inRandomOrder()->first();

        return [
            'json_request' => $this->faker->text(),
            'account_number' => $bank_account->account_number,
            'bank_code' => $bank_account->bank->code,
            'amount' => $this->faker->randomFloat(null, 10000, 100000),
            'remark' => $this->faker->text(),
            'idempotency' => $transaction->uuid,
            'transaction_id' => \App\Models\Transaction::where('type', TransactionTypes::WITHDRAW)->inRandomOrder()->value('id'),
        ];
    }
}
