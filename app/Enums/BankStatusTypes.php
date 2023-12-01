<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

/**
 * Kelas Enum yang mewakili berbagai status operasional bank.
 *
 * @method static self OPERATIONAL()
 * @method static self DISTURBED()
 * @method static self HEAVILY_DISTURBED()
 */
class BankStatusTypes extends Enum
{
    /**
     * Bank beroperasi, dan pencairan akan diproses sesegera mungkin.
     *
     * @return self
     */
    public const OPERATIONAL = 'OPERATIONAL';

    /**
     * Bank lambat atau mengalami masalah lain. Pencairan masih akan diproses,
     * tetapi dengan kecepatan yang lebih lambat dan mungkin tertunda.
     *
     * @return self
     */
    public const DISTURBED = 'DISTURBED';

    /**
     * Bank mengalami kesalahan, offline, atau menghadapi masalah lain yang menghasilkan sistem yang hampir tidak dapat digunakan.
     * Pencairan ke bank ini tidak dapat diproses dalam waktu singkat, dan mungkin tidak akan diproses pada hari yang sama.
     * Anda dapat meminta pengembalian uang jika ini terjadi.
     *
     * @return self
     */
    public const HEAVILY_DISTURBED = 'HEAVILY_DISTURBED';
}
