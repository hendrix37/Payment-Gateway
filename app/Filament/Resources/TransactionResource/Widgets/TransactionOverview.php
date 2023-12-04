<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Enums\StatusTypes;
use App\Enums\TransactionTypes;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        // Retrieve successful transactions for each type
        $transaction_top_up_success = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::TOPUP)->count();
        $transaction_pay_success = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::PAY)->count();
        $transaction_withdraw_success = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::WITHDRAW)->count();

        $transaction_top_up_failed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::TOPUP)->count();
        $transaction_pay_failed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::PAY)->count();
        $transaction_withdraw_failed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::WITHDRAW)->count();

        // Retrieve additional data for the chart
        $chartDataTopUpSuccess = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::TOPUP)->pluck('amount')->toArray();
        $chartDataPaySuccess = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::PAY)->pluck('amount')->toArray();
        $chartDataWithdrawSuccess = Transaction::whereStatus(StatusTypes::SUCCESSFUL)->whereType(TransactionTypes::WITHDRAW)->pluck('amount')->toArray();

        $chartDataTopUpFailed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::TOPUP)->pluck('amount')->toArray();
        $chartDataPayFailed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::PAY)->pluck('amount')->toArray();
        $chartDataWithdrawFailed = Transaction::whereStatus(StatusTypes::FAILED)->whereType(TransactionTypes::WITHDRAW)->pluck('amount')->toArray();

        return [
            Stat::make('Top-Up Success', $transaction_top_up_success)
                ->description('Successful Top-Up Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($chartDataTopUpSuccess)
                ->color('success'),

            Stat::make('Payment Success', $transaction_pay_success)
                ->description('Successful Payment Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($chartDataPaySuccess)
                ->color('success'),

            Stat::make('Withdrawal Success', $transaction_withdraw_success)
                ->description('Successful Withdrawal Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($chartDataWithdrawSuccess)
                ->color('success'),


                Stat::make('Top-Up Failed', $transaction_top_up_failed)
                ->description('Failed Top-Up Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart($chartDataTopUpFailed)
                ->color('danger'),
        
            Stat::make('Payment Failed', $transaction_pay_failed)
                ->description('Failed Payment Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart($chartDataPayFailed)
                ->color('danger'),
        
            Stat::make('Withdrawal Failed', $transaction_withdraw_failed)
                ->description('Failed Withdrawal Transactions')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart($chartDataWithdrawFailed)
                ->color('danger'),
        ];
    }
}
