<?php

namespace App\Http\Requests\DriverTransaction;

use Illuminate\Foundation\Http\FormRequest;

class ListBankAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            /**
             * The account number for the bank account.
             *
             * @var string
             *
             * @example 64ce95d1ac3d33f73b7842821
             */
            'idwork' => ['required'],
        ];
    }
}
