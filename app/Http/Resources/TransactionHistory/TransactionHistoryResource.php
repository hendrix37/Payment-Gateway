<?php

namespace App\Http\Resources\TransactionHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionHistoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
			'json_before_value' => $this->json_before_value,
			'json_after_value' => $this->json_after_value,
			'action' => $this->action,
			'transaction_id' => $this->transaction_id,
			'status_transaction' => $this->status_transaction,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
