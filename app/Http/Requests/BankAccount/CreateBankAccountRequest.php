<?php

namespace App\Http\Requests\BankAccount;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            /**
             * The account number for the bank account.
             *
             * @var string
             *
             * @example 1234567890
             */
            'account_number' => ['required'],

            /**
             * The code representing the bank associated with the account.
             *
             * @var string
             *
             * @example bri
             *
             * @see https://docs.flip.id/?php#destination-bank
             */
            'bank_code' => ['required', 'string', 'exists:App\Models\Bank,code'],

            /**
             * The owner's identity associated with the bank account.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idowner' => ['required', 'string'],
        ];
    }
}
