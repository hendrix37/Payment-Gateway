<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

class StatusBankColors extends Enum
{
    public static $statusColors = [
        StatusBank::PENDING => 'warning',
        StatusBank::SUCCESS => 'success',
        StatusBank::INVALID_ACCOUNT_NUMBER => 'info',
        StatusBank::SUSPECTED_ACCOUNT => 'danger',
        StatusBank::BLACK_LISTED => 'danger',
        StatusBank::FAILED => 'danger',
        StatusBank::CLOSED => 'success',
    ];
}
