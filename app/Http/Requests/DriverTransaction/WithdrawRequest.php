<?php

namespace App\Http\Requests\DriverTransaction;

use App\Models\Bank;
use App\Rules\SufficientBalance;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $bankAccountId = $this->input('bank_account_id');

        return [

            /**
             * The amount number for transaction.
             *
             * @var string
             *
             * @example 1
             */
            'bank_account_id' => ['required', 'integer', 'exists:App\Models\BankAccount,id'],

            /**
             * The amount number for transaction.
             *
             * @var string
             *
             * @example 12000
             */
            'doku' => ['required', 'integer', new SufficientBalance(Bank::find($bankAccountId)), 'min:10000'],
            /**
             * The id work for the transaction.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idwork' => ['required', 'string'],
        ];
    }
}
