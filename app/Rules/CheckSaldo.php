<?php

namespace App\Rules;

use App\Models\Transaction;
use Illuminate\Contracts\Validation\Rule;

class CheckSaldo implements Rule
{
    public function passes($attribute, $value)
    {
        $amount = $value;
        $identity_owner = request()->idowner;

        $saldo = Transaction::saldoCustomer($identity_owner);
        $total_transfer = $amount;

        return $saldo >= $total_transfer;
    }

    public function message()
    {
        $amount = request()->doku;
        $text_number_format = number_format($amount);

        return 'Saldo: '.Transaction::saldoCustomer(request()->idowner).". You need for Pay $text_number_format. Your Balance is Low";
    }
}
