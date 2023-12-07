<?php

namespace App\Http\Resources\BankAccount;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'bank_id' => $this->bank_id,
            'account_number' => $this->account_number,
            'identity_owner' => $this->identity_owner,
            'identity_work' => $this->identity_work,
            'status' => $this->status,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
