<?php

namespace App\Http\Requests\TransactionHistory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string'],
            'json_before_value' => ['sometimes', 'string'],
            'json_after_value' => ['sometimes', 'string'],
            'action' => ['sometimes', 'in:cerated,updated,deleted'],
            'transaction_id' => ['sometimes'],
            'status_transaction' => ['sometimes', 'string'],
        ];
    }
}
