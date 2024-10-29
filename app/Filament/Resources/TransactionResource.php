<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use App\Filament\Resources\TransactionResource\Pages;
use Filament\Forms\Components\Tabs\Tab;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_code')
                    ->label('transaction code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('username'),
                Tables\Columns\TextColumn::make('price_total')
                    ->label('total price')
                    ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('transaction_detile.transaction_total')
                    ->label('quantity'),
                Tables\Columns\TextColumn::make('transaction_detile.product.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('tanggal transaksi')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
