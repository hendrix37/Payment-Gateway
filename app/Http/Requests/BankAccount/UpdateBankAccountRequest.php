<?php

namespace App\Http\Requests\BankAccount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string'],
            'bank_id' => ['sometimes'],
            'account_number' => ['sometimes', 'string'],
            'identity_owner' => ['sometimes', 'string'],
            'identity_work' => ['sometimes', 'string'],
            'status' => ['sometimes', 'in:success,failed'],
        ];
    }
}
