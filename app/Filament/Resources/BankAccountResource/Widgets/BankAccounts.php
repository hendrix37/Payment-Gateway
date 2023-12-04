<?php

namespace App\Filament\Resources\BankAccountResource\Widgets;

use App\Enums\StatusBankColors;
use App\Filament\Resources\BankAccountResource;
use App\Filament\Resources\BankResource;
use App\Models\Bank;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

class BankAccounts extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(BankResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('index')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        if ($livewire->getTableRecordsPerPage() == 'all') {

                            return (string) (
                                $rowLoop->iteration

                            );
                        } else {

                            return (string) (
                                $rowLoop->iteration +
                                ($livewire->getTableRecordsPerPage() * (
                                    $livewire->getTablePage() - 1
                                ))
                            );
                        }
                    }
                )->label('No'),
                TextColumn::make('name'),
                TextColumn::make('bank_accounts_count')->counts('bank_accounts')->label('Bank Accounts')
            ])
            ->defaultSort('bank_accounts_count', 'desc');;
    }
}
