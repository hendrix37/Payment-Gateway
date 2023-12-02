<?php

namespace App\Http\Requests\CustomerTransaction;

use Illuminate\Foundation\Http\FormRequest;

class TopUpRequest extends FormRequest
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
             * The id owner for the transaction.
             *
             * @var string
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idowner' => ['required'],

            /**
             * The amount number for transaction.
             *
             * @var string
             * @example 12000
             */
            'doku' => ['required'],
            
            /**
             * The additinoal cost number for transaction.
             *
             * @var string
             * @example 2500
             */
            'bPenganan' => ['required'],
        ];
    }
}
