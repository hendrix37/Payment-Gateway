<?php

namespace Database\Factories;

use App\Enums\StatusBank;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->firstName(),
            'bank_id' => createOrRandomFactory(\App\Models\Bank::class),
            'account_number' => $this->faker->firstName(),
            'identity_owner' => $this->faker->firstName(),
            'identity_driver' => $this->faker->firstName(),
            'status' => $this->faker->randomElement(StatusBank::getAll()),
        ];
    }
}
