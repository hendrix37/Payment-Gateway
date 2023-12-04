<?php

namespace App\Rules;

use App\Models\Transaction;
use Illuminate\Contracts\Validation\Rule;

class SufficientBalance implements Rule
{
    protected $bank;

    public function __construct($bank)
    {
        $this->bank = $bank;
    }

    public function passes($attribute, $value)
    {
        $amount = $value;
        $identity_owner = request()->idowner;

        $saldo = Transaction::saldoCustomer($identity_owner);
        $total_transfer = $amount + $this->bank->fee;

        return $saldo >= $total_transfer;
    }

    public function message()
    {
        $amount = request()->doku;
        $text_number_format = number_format($amount);
        $total_transfer = number_format($amount + $this->bank->fee);

        return 'Saldo: '.Transaction::saldoCustomer(request()->idowner).". You need for withdrawal $text_number_format and transfer fee {$this->bank->fee} Total $total_transfer. Your Balance is Low";
    }
}
