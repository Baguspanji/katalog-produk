<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Helpers\ImageHelper;
use App\Models\AffiliateStore;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(Category::pluck('name', 'id'))
                            ->required(),
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->nullable(),
                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->nullable(),
                        Select::make('affiliate_type')
                            ->label('Tipe Afiliasi')
                            ->options(
                                AffiliateStore::pluck('name', 'name')
                                    ->prepend('Official', 'Official')
                                    ->all()
                            )
                            ->required(),
                        TextInput::make('affiliate_link')
                            ->label('Link Afiliasi')
                            ->url()
                            ->nullable()
                            ->maxLength(255),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'show' => 'Ditampilkan',
                                'archived' => 'Diarsipkan',
                            ])
                            ->default('show'),
                    ])->columnSpan(2),
                FileUpload::make('image_link')
                    ->image()
                    ->panelLayout('grid')
                    ->maxSize(2048) // 2MB
                    ->directory('products')
                    ->label('Gambar Produk')
                    ->disk('public')
                    ->nullable()
                    ->saveUploadedFileUsing(function ($file) {
                        $path = $file->store('temp', 'local');
                        return ImageHelper::compressAndConvertToWebp(
                            $path,
                            disk: 'public',
                            directory: 'products',
                            quality: 80
                        );
                    })->columnSpan(1),
            ])
            ->columns(3);
    }
}
