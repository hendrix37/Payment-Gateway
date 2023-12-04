<?php

namespace App\Http\Requests\DriverTransaction;

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
             * The ID of the driver.
             *
             * @var string
             *
             * @example 65021f344ecc865c068d84df
             */
            'iddriver' => ['required', 'string'],

            /**
             * The ID of the job driver related to the driver.
             *
             * @var string
             *
             * @example 654e89edd3227bf93f9246b3
             */
            'iddriverjob' => ['required', 'string'],

            /**
             * The ID of the driver initiating the payment.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'iddriver' => ['required', 'string'],

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
