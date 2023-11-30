<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'json_before_value' => $this->json_before_value,
            // 'json_after_value' => $this->json_after_value,
            'action' => $this->action,
            'transaction_id' => $this->transaction_id,
            'status_transaction' => $this->status_transaction,
        ];
    }
}
