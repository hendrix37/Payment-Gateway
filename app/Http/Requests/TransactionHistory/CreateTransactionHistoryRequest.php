<?php

namespace App\Http\Requests\TransactionHistory;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
			'json_before_value' => ['nullable', 'string'],
			'json_after_value' => ['required', 'string'],
			'action' => ['required', 'in:cerated,updated,deleted'],
			'transaction_id' => ['required'],
			'status_transaction' => ['nullable', 'string'],
        ];
    }
}
