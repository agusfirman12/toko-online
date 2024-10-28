<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('is_ready')
                    ->label('status')
                    ->required()
                    ->options([
                        '1' => 'publish',
                        '0' => 'Not publish',
                    ]),
                Forms\Components\FileUpload::make('image')
                    ->label('Product Image')
                    ->image()
                    ->directory('product-images')
                    ->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Product Image')
                    ->square()
                    ->size(50)
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->defaultImageUrl(url("assets/image/no-image.png")),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('weight')
                            ->label('weight (kg)')
                            ->formatStateUsing(fn ($state) => $state . ' kg'),
                Tables\Columns\TextColumn::make('is_ready')
                            ->badge()
                            ->label("status")
                            ->getStateUsing(fn ($record) => $record->is_ready ? 'publish' : 'Not publish')
                            ->colors([
                                'success' => fn ($state) => $state === 'publish',
                                'danger' => fn ($state) => $state === 'Not publish',
                            ]),
                Tables\Columns\TextColumn::make('price')
                        ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
            ])
            ->filters([
                Filter::make('high price')
                    ->query(fn (Builder $query): Builder => $query->orderBy('price', 'desc')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
