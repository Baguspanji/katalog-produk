<?php

namespace App\Filament\Resources\AffiliateStores\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class AffiliateStoresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_url')
                    ->label('Logo')
                    ->disk('public'),
                ImageColumn::make('logo_favicon_url')
                    ->label('Favicon')
                    ->disk('public'),
                TextColumn::make('name')
                    ->label('Nama Toko')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('url')
                    ->label('URL Toko')
                    ->formatStateUsing(fn ($record): HtmlString => new HtmlString('
                        <a href="' . $record->url . '" target="_blank" style="color: #3b82f6; font-size: 0.875rem;">' . $record->url . '</a>
                    ')),
                // TextColumn::make('commission_rate')
                //     ->label('Tingkat Komisi (%)')
                //     ->numeric(decimalPlaces: 2)
                //     ->sortable(),
                TextColumn::make('products_count')
                    ->label('Total Produk')
                    ->counts('products')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
