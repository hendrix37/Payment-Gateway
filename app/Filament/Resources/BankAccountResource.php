<?php

namespace App\Filament\Resources;

use App\Enums\StatusBankColors;
use App\Filament\Resources\BankAccountResource\Pages;
use App\Models\Bank;
use App\Models\BankAccount;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use stdClass;

class BankAccountResource extends Resource
{
    protected static ?string $navigationGroup = 'Content';

    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Bank')
                    ->schema([
                        Select::make('bank_id')
                            ->label('Bank')
                            ->options(Bank::all()->pluck('name', 'id'))
                            ->searchable(),
                    ]),
                Section::make('Identity')
                    ->schema([
                        TextInput::make('account_number'),
                        TextInput::make('identity_owner'),
                        TextInput::make('identity_work'),
                    ]),
                Section::make('Status')
                    ->schema([
                        TextInput::make('status'),
                    ])
                    ->hiddenOn(['create', 'edit']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('bank.name'),
                TextColumn::make('account_number'),
                TextColumn::make('identity_owner'),
                TextColumn::make('identity_work'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => StatusBankColors::$statusColors[$state]),
                // ->resolveUsing(function ($value) {
                //     return strtoupper($value);
                // }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'view' => Pages\ViewBankAccount::route('/{record}'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
