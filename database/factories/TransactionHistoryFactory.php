<?php

namespace Database\Factories;

use App\Enums\ActionTypes;
use App\Enums\StatusTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHistoryFactory extends Factory
{
    public function definition(): array
    {
        $action = $this->faker->randomElement(['cerated', 'updated', 'deleted']);

        if ($status = StatusTypes::isValid('PENDING')) {
            $action = ActionTypes::CREATED;
        } elseif ($status = StatusTypes::isValid('SUCCESSFUL')) {
            $action = ActionTypes::UPDATED;
        }

        return [
            'json_before_value' => $this->faker->text(),
            'json_after_value' => $this->faker->firstName(),
            'action' => $action,
            'transaction_id' => \App\Models\Transaction::inRandomOrder()->value('id'),
            'status_transaction' => $status,

        ];
    }
}
