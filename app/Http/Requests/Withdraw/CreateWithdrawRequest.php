<?php

namespace App\Http\Requests\Withdraw;

use Illuminate\Foundation\Http\FormRequest;

class CreateWithdrawRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
            'json_request' => ['required', 'string'],
            'account_number' => ['required', 'string'],
            'bank_code' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'remark' => ['nullable', 'string'],
            'idempotency' => ['required', 'string'],
        ];
    }
}
