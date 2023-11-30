<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

class TransactionTypes extends Enum
{
    /**
     * Transaksi untuk menambah saldo.
     * public const TOPUP = 'top_up';
     */
    public const TOPUP = 'top_up';

    /**
     * Transaksi pembayaran.
     * public const PAY = 'pay';
     */
    public const PAY = 'pay';

    /**
     * Transaksi penarikan dana.
     * public const WITHDRAW = 'withdraw';
     */
    public const WITHDRAW = 'withdraw';
}
