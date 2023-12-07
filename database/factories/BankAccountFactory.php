<?php

namespace Database\Factories;

use App\Enums\StatusBank;
use App\Models\Bank;
use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountFactory extends Factory
{
    // protected $model = BankAccount::class;

    public function definition(): array
    {
        return [
            'bank_id' => Bank::inRandomOrder()->value('id'),
            'account_number' => $this->faker->randomNumber(9),
            'identity_owner' => $this->faker->firstName(),
            'identity_work' => $this->faker->firstName(),
            'status' => $this->faker->randomElement(StatusBank::getAll()),
        ];
    }
}
