<?php

namespace App\Http\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
            'name' => ['required', 'string'],
            'code' => ['nullable', 'string'],
        ];
    }
}
