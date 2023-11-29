<?php

namespace Database\Seeders;

use App\Models\TransactionHistory;
use Illuminate\Database\Seeder;

class TransactionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        TransactionHistory::factory(10)->create();
    }
}
