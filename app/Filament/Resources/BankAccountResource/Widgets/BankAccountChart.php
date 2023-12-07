<?php

namespace App\Filament\Resources\BankAccountResource\Widgets;

use App\Models\Bank;
use Filament\Widgets\ChartWidget;

class BankAccountChart extends ChartWidget
{
    protected static ?string $heading = 'Bank Account By Category Bank';

    protected int|string|array $columnSpan = 'full';

    protected static bool $isLazy = true;

    protected function getData(): array
    {
        $banks = Bank::pluck('name', 'id');
        $bankNames = $banks->all();

        $countBankAccountsByBank = Bank::withCount('bank_accounts')->get()->pluck('bank_accounts_count', 'id')->all();

        // Assuming you have a BankAccount model and a relationship between Bank and BankAccount
        $counts = array_map(function ($bankId) use ($countBankAccountsByBank) {
            return $countBankAccountsByBank[$bankId] ?? 0;
        }, array_keys($bankNames));

        // Dynamically generate random background colors based on count
        $backgroundColor = array_map(function ($count) {
            $hue = mt_rand(0, 360); // Hue value between 0 and 360
            $saturation = mt_rand(70, 100); // Saturation value between 70 and 100
            $lightness = mt_rand(40, 60); // Lightness value between 40 and 60

            return "hsl($hue, $saturation%, $lightness%)";
        }, $counts);

        // Dynamically generate random border colors with similar hues
        $borderColor = array_map(function ($background) {
            [$hue, $saturation, $lightness] = sscanf($background, 'hsl(%d, %d%%, %d%%)');
            $hue = ($hue + 180) % 360; // Shift hue by 180 degrees for complementary colors

            return "hsl($hue, $saturation%, $lightness%)";
        }, $backgroundColor);

        return [
            'datasets' => [
                [
                    'label' => 'Bank Accounts',
                    'data' => $counts,
                    'backgroundColor' => $backgroundColor,
                    'borderColor' => $borderColor,
                    'borderWidth' => 10,
                ],
            ],
            'labels' => array_values($bankNames),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
