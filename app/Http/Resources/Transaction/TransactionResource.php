<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            // 'id' => $this->id,
            // 'uuid' => $this->uuid,
            // 'json_request' => $this->json_request,
            // 'json_response_payment_gateway' => $this->json_response_payment_gateway,
            // 'payement_gateway' => $this->payement_gateway,
            'amount' => $this->amount,
            // 'bank_id' => $this->bank_id,
            'expired_date' => dateTimeFormat($this->expired_date),
            'link_payment' => $this->link_payment,
            'identity_owner' => $this->identity_owner,
            'identity_work' => $this->identity_work,
            'status' => $this->status,
            // 'code_payment_gateway_relation' => $this->code_payment_gateway_relation,
            // 'json_callback' => $this->json_callback,
            'history' => HistoryResource::collection($this->histories), // contoh atribut relasi

        ];
    }
}
