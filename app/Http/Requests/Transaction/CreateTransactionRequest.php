<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
			'json_request' => ['required', 'string'],
			'json_response_payment_gateway' => ['nullable', 'string'],
			'payement_gateway' => ['required', 'string'],
			'amount' => ['required', 'numeric'],
			'bank_id' => ['nullable', 'integer'],
			'expired_date' => ['required', 'date'],
			'link_payment' => ['nullable', 'string'],
			'identity_owner' => ['nullable', 'string'],
			'identity_driver' => ['nullable', 'string'],
			'status' => ['nullable', 'string'],
			'code_payment_gateway_relation' => ['nullable', 'string'],
			'json_callback' => ['nullable', 'string'],
        ];
    }
}
