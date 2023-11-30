<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['sometimes', 'string'],
            'name' => ['sometimes', 'string'],
            'code' => ['sometimes', 'string'],
        ];
    }
}
