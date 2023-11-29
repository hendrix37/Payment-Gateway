<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
			$table->text('json_before_value')->nullable();
			$table->string('json_after_value')->required();
			$table->enum('action', ['cerated', 'updated', 'deleted']);
			$table->foreignId('transaction_id')->constrained('transactions');
			$table->string('status_transaction')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionHistories');
    }
};