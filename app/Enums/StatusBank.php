<?php

namespace App\Enums;

use Essa\APIToolKit\Enum\Enum;

/**
 * Class StatusBank
 *
 * A class defining various status constants related to bank transactions.
 */
class StatusBank extends Enum
{
    /**
     * Penyelidikan masih dalam proses
     * public const PENDING = 'pending';
     */
    public const PENDING = 'pending';

    /**
     * Proses penyelidikan selesai dan nomor rekening bank valid
     * public const SUCCESS = 'success';
     */
    public const SUCCESS = 'success';

    /**
     * Proses penyelidikan selesai tetapi nomor akun tidak valid atau mungkin nomor akun virtual
     * public const INVALID_ACCOUNT_NUMBER = 'invalid_account_number';
     */
    public const INVALID_ACCOUNT_NUMBER = 'invalid_account_number';

    /**
     * Rekening bank diduga melakukan penipuan. Anda masih dapat melakukan pencairan ke akun ini.
     * public const SUSPECTED_ACCOUNT = 'suspected_account';
     */
    public const SUSPECTED_ACCOUNT = 'suspected_account';

    /**
     * Rekening bank telah dikonfirmasi melakukan penipuan dan karenanya masuk daftar hitam.
     * Anda tidak dapat melakukan pencairan ke akun ini.
     * public const BLACK_LISTED = 'black_listed';
     */
    public const BLACK_LISTED = 'black_listed';

    /**
     * Proses penyelidikan gagal sebelum kami mencapai final status dari penyelidikan,
     * mis. karena batas waktu atau kesalahan lain dari bank.
     * Jika Anda mendapatkan respons ini, silakan coba lagi pertanyaan untuk memicu verifikasi ulang akun.
     * public const FAILED = 'failed';
     */
    public const FAILED = 'failed';

    /**
     * Proses penyelidikan selesai dan akun valid, tetapi ditutup / tidak aktif sehingga tidak dapat menerima uang.
     * Anda tidak dapat melakukan pencairan ke akun ini.
     * public const CLOSED = 'closed';
     */
    public const CLOSED = 'closed';

    // Method to get the icon for a specific status
    public static function getIcon(string $status): string
    {
        $icons = StatusBankIcons::$statusIcons;
        return $icons[$status] ?? 'heroicon-o-lock-closed';
    }
}
