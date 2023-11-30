<?php

namespace App\Http\Requests\Withdraw;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWithdrawRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string'],
            'json_request' => ['sometimes', 'string'],
            'account_number' => ['sometimes', 'string'],
            'bank_code' => ['sometimes', 'string'],
            'amount' => ['sometimes', 'numeric'],
            'remark' => ['sometimes', 'string'],
            'idempotency' => ['sometimes', 'string'],
        ];
    }
}
