<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Withdraw;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BankSeeder::class,
            TransactionSeeder::class,
            TransactionHistorySeeder::class,
            WithdrawSeeder::class,
        ]);
    }
}
