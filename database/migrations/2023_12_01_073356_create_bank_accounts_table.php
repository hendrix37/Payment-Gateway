<?php

use App\Enums\StatusTypes;
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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
			$table->foreignId('bank_id')->constrained('banks');
			$table->string('account_number')->nullable();
			$table->string('identity_owner')->nullable();
			$table->string('identity_driver')->nullable();
			$table->enum('status', StatusTypes::toArray());
            
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
        Schema::dropIfExists('bankAccounts');
    }
};
