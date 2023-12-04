<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            /**
             * The Bank Name.
             *
             * @var string
             *
             * @example BANK REPUBLIK INDONESIA (BRI)
             */
            'name' => ['required', 'string'],
            /**
             * The Bank CODE .
             *
             * @var string
             *
             * @example brr
             */
            'code' => ['nullable', 'string'],
        ];
    }
}
