<?php

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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('json_request')->required();
            $table->string('account_number')->required();
            $table->string('bank_code')->required();
            $table->double('amount');
            $table->text('remark')->nullable();
            $table->string('idempotency')->required();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
