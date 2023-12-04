<?php

namespace App\Http\Requests\CustomerTransaction;

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
            'bank_account_id' => ['required', 'integer', 'exists:App\Models\BankAccount,id'],
            'doku' => ['required', 'integer', new SufficientBalance(Bank::find($bankAccountId)), 'min:10000'],
            'idowner' => ['required', 'string'],
        ];
    }
}
