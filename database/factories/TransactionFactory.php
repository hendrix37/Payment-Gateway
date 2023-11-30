<?php

namespace Database\Factories;

use App\Enums\StatusTypes;
use App\Enums\TransactionTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transaction_number' => $this->faker->text(),
            'json_request' => $this->faker->text(),
            'json_response_payment_gateway' => $this->faker->firstName(),
            'payement_gateway' => $this->faker->firstName(),
            'amount' => $this->faker->randomFloat(0, 10000, 100000),
            'bank_id' => createOrRandomFactory(\App\Models\Bank::class),
            'expired_date' => $this->faker->dateTime(),
            'link_payment' => $this->faker->firstName(),
            'identity_owner' => $this->faker->firstName(),
            'identity_driver' => $this->faker->firstName(),
            'status' => $this->faker->randomElement(StatusTypes::getAll()),
            'type' => $this->faker->randomElement(TransactionTypes::getAll()),
            'code_payment_gateway_relation' => $this->faker->firstName(),
            'json_callback' => $this->faker->text(),
        ];
    }
}
