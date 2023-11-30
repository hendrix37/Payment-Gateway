<?php

use App\Enums\StatusTypes;
use App\Enums\TransactionTypes;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('transaction_number')->required();
            $table->text('json_request')->required();
            $table->text('json_response_payment_gateway')->nullable();
            $table->string('payement_gateway')->required();
            $table->double('amount')->required();
            $table->double('additional_cost')->nullable();
            $table->foreignId('bank_id')->nullable()->constrained('banks')->cascadeOnDelete();
            $table->timestamp('expired_date')->required();
            $table->string('link_payment')->nullable();
            $table->string('identity_owner')->nullable();
            $table->string('identity_driver')->nullable();
            $table->enum('status', StatusTypes::getAll())->nullable();
            $table->enum('type', TransactionTypes::getAll())->nullable();
            $table->text('code_payment_gateway_relation')->nullable();
            $table->text('json_callback')->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
