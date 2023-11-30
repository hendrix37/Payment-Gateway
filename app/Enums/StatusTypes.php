<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

/**
 * Enum class representing various transaction statuses.
 *
 * @method static self PENDING()
 * @method static self SUCCESSFUL()
 * @method static self CANCELLED()
 * @method static self FAILED()
 */
class StatusTypes extends Enum
{
    /**
     * Status transaksi dalam proses.
     *
     * @return self
     */
    public const PENDING = 'PENDING';

    /**
     * Status transaksi berhasil.
     *
     * @return self
     */
    public const SUCCESSFUL = 'SUCCESSFUL';

    /**
     * Status transaksi dibatalkan.
     *
     * @return self
     */
    public const CANCELLED = 'CANCELLED';

    /**
     * Status transaksi gagal.
     *
     * @return self
     */
    public const FAILED = 'FAILED';
}
