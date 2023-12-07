<?php

namespace App\Filament\Resources\WithdrawResource\Pages;

use App\Filament\Resources\WithdrawResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWithdraw extends CreateRecord
{
    protected static string $resource = WithdrawResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
