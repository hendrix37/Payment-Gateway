<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string'],
            'json_request' => ['sometimes', 'string'],
            'json_response_payment_gateway' => ['sometimes', 'string'],
            'payement_gateway' => ['sometimes', 'string'],
            'amount' => ['sometimes', 'numeric'],
            'bank_id' => ['sometimes'],
            'expired_date' => ['sometimes', 'date'],
            'link_payment' => ['sometimes', 'string'],
            'identity_owner' => ['nullable', 'string'],
            'identity_driver' => ['nullable', 'string'],
            'status' => ['sometimes', 'string'],
            'code_payment_gateway_relation' => ['sometimes', 'string'],
            'json_callback' => ['sometimes', 'string'],
        ];
    }
}
