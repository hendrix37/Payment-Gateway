<?php

use App\Enums\ActionTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('json_before_value')->nullable();
            $table->text('json_after_value')->required();
            $table->enum('action', ActionTypes::toArray());
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->string('status_transaction')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactionHistories');
    }
};
