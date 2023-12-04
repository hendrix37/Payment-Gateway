<?php

namespace App\Http\Requests\CustomerTransaction;

use App\Rules\CheckSaldo;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * The ID of the work.
             *
             * @var string
             *
             * @example 65021f344ecc865c068d84df
             */
            'idwork' => ['required', 'string'],

            /**
             * The ID of the job owner related to the work.
             *
             * @var string
             *
             * @example 654e89edd3227bf93f9246b3
             */
            'idownerjob' => ['required', 'string'],

            /**
             * The ID of the owner initiating the payment.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idowner' => ['required', 'string'],

            /**
             * The payment amount.
             *
             * @var int
             *
             * @example 10000
             */
            'doku' => ['required', 'integer', new CheckSaldo()],

            /**
             * The additional charge for fee.
             *
             * @var int
             *
             * @example 2500
             */
            'bPenganan' => ['required', 'integer'],
        ];
    }
}
