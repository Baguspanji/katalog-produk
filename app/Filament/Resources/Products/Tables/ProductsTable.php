<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_link')
                    ->label('Gambar')
                    ->disk('public'),
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->numeric(decimalPlaces: 2)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('affiliate_type')
                    ->label('Afiliasi')
                    ->formatStateUsing(fn ($record): HtmlString => new HtmlString('
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-weight: 500; color: #1f2937;">' . $record->affiliate_type . '</span>
                            <a href="' . $record->affiliate_link . '" target="_blank" style="color: #3b82f6; font-size: 0.875rem;">' . $record->affiliate_link . '</a>
                        </div>
                    '))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('click_count')
                    ->label('Total Klik')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'archived' ? 'Diarsipkan' : 'Ditampilkan')
                    ->color(fn (string $state): string => $state === 'archived' ? 'warning' : 'success')
                    ->sortable(),
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
