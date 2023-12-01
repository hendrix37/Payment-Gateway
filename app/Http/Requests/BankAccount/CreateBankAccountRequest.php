<?php

namespace App\Http\Requests\BankAccount;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
			'bank_id' => ['required'],
			'account_number' => ['required', 'string'],
			'identity_owner' => ['nullable', 'string'],
			'identity_driver' => ['nullable', 'string'],
			'status' => ['required', 'in:success,failed'],
        ];
    }
}
