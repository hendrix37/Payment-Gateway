<?php

namespace App\Http\Resources\Withdraw;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'json_request' => $this->json_request,
            'account_number' => $this->account_number,
            'bank_code' => $this->bank_code,
            'amount' => $this->amount,
            'remark' => $this->remark,
            'idempotency' => $this->idempotency,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
