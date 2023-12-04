<?php

namespace Database\Seeders;

use App\Enums\StatusTypes;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Transaction::factory(90)->create([
            'status' => StatusTypes::SUCCESSFUL,
        ]);


        Transaction::factory(30)->create([
            'status' => StatusTypes::PENDING,
        ]);


        Transaction::factory(20)->create([
            'status' => StatusTypes::FAILED,
        ]);
    }
}
