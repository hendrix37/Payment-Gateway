<?php

namespace App\Http\Requests\DriverTransaction;

use Illuminate\Foundation\Http\FormRequest;

class TopUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            /**
             * The id work for the transaction.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idwork' => ['required'],

            /**
             * The amount number for transaction.
             *
             * @var string
             *
             * @example 12000
             */
            'doku' => ['required'],

            /**
             * The additinoal cost number for transaction.
             *
             * @var string
             *
             * @example 2500
             */
            'bPenganan' => ['required'],
        ];
    }
}
