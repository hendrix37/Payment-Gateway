<?php

namespace App\Http\Requests\CustomerTransaction;

use Illuminate\Foundation\Http\FormRequest;

class SaldoRequest extends FormRequest
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
             * The account number for the bank account.
             *
             * @var string
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idowner' => ['required'],
        ];
    }
}